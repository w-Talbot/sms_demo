<?php

namespace App\SMSLogic;

use App\Activity;
use App\Alert;
use IU\PHPCap\RedCapProject;
use IU\PHPCap\PhpCapException;
use App\StudyConfiguration;
use Illuminate\Support\Facades\DB;
use App\SMSLogic\AlertRecurrenceLogic;
use App\Textlocal\Textlocal;
use \Exception;



class PHCSMS {



public function sendSMS($sms_alert_id , $textlocal_api, $participant_phone_number, $text_message ){

    $status =  true;

    try {
        $Textlocal = new Textlocal(false, false, $textlocal_api);

        $numbers = array($participant_phone_number);
        $sender = 'PHC';
        $message = $text_message;

        $response = $Textlocal->sendSms($numbers, $message, $sender);

    }catch (\Exception $e){
        $note = 'FAILED::sendSMS This failed to send Alert_ID: ' . $sms_alert_id . ' please check Textlocal API: ' . $textlocal_api . ' . ';
        $this->updateActivityHistory($sms_alert_id, null, null, $note, $e);
        $status = false;

    }

return $status;
}

public function getAllStudyCriteria(){

    //This retrieves the study access information (api, url, and variables to look for)
    $tmpData = DB::select('SELECT * FROM studies');

    return $tmpData;
}

public function dateEqualsSMSTrigger($date_to_check, $date_diffrence):bool{

    $origin = new \DateTime('today');
    $target = new \DateTime($date_to_check);

    //signed value ex: -12
//    $interval = $origin->diff($target)->format("%r%a");

    //unsigned value ex: 12
    $interval = $origin->diff($target)->format("%a");

    if(intval($interval) === intval($date_diffrence)){
        return true;
    }else{
        return false;
    }
}

public function checkForNewSMSAlerts(){

    $study_criteria = $this->getAllStudyCriteria();

    if(!empty($study_criteria)){
        //Loop through all studies in database:
        foreach($study_criteria as $study){

            //Turn the data into a new format (from STD::Class to an Array) as $tmp_array
            $data = $study;
            $tmp_array = array();
            foreach ($data as $key => $value){
                $tmp_array[$key] = $value;
            }

            //Store the current projects REDCap API details to check it for any records that should send SMS:
            $textlocal_api_token  = trim($tmp_array['textlocal_api']);
            $redcap_api_token  = trim($tmp_array['redcap_api']);
            $apiUrl = trim($tmp_array['url']);

            $phone_var = $tmp_array['phone_variable'];
            $phone_event = $tmp_array['phone_event'];
            $phone_number = '';


            $details_to_check = json_decode($tmp_array['sms_invitations']);
            $details = array();

            //Store the specific invitation criteria in an array to check
            foreach ($details_to_check  as $key => $value){
                $details[$key] = $value;
            }

            try {
                //Get all data from REDcap project, stored in $projects and $records
                $project = new RedCapProject($apiUrl, $redcap_api_token);
                $projectInfo = $project->exportProjectInfo();
                $records = $project->exportRecords();
                $record_id_var = array_key_first($records[0]); //gets the record id variable name: is 'record_id' by default but is sometimes changed
                $record_id = '';


                //Loop through all records in project to see if they meet the criteria (stored in $details) for sending SMS:
                foreach ($records as $record) {

                    if($record[$record_id_var] == $record_id){
                        //SAME record, do nothing
                    }else{
                        //NEW Record check all Invitations:
                        $record_id = $record[$record_id_var]; //Update to working record id

                        //Get phone number
                        foreach($records as $tmp){
                            if($tmp[$record_id_var] === $record_id){
                                if($tmp['redcap_event_name'] === $phone_event){
                                    $phone_number = $tmp[$phone_var];
                                    $phone_number = $this->phoneFormatter($phone_number);
                                    break;
                                }
                            }
                        }

                        //While looping through each record, need to check against stored details

                        $i = 0;
                        for($x=0; $x < sizeof($details); $x++) {


                            if(!isset($details['message_' . $x])){
                                $i++;
                                continue;
                            }

                            $date_event = 'date_event_' . strval($i);
                            $date_var = 'date_var_' . strval($i);
                            $form_event = 'form_event_' . strval($i);
                            $form_var = 'form_var_' . strval($i);
                            $sms_timer_var = 'sms_timer_' . strval($i);
                            $num_days_var = 'num_days_' . strval($i);
                            $recurrence_var = 'recurrence_' . strval($i);
                            $message_var = 'message_' . strval($i);
                            $i++;

                            //  Get DATE and FORM values for each invitation from REDCap
                            foreach($records as $tmp){
                                if($tmp[$record_id_var] === $record_id){
                                    if($tmp['redcap_event_name'] === $details[$date_event]){
                                        $date_to_calc = $tmp[$details[$date_var]];
                                    }
                                    if($tmp['redcap_event_name'] === $details[$form_event]){
                                        $form_complete = $tmp[$details[$form_var]];
                                    }
                                }
                            }


                            // Check to see if form has been completed, if yes do nothing, if no check the date diff using dateEqualsSMSTRigger function
                            if((int)$form_complete === 2){
                                //Form is complete do nothing
                                continue;
                            }else{

                                //Check if this is within the specified date to send the SMS
                                $time_elapsed = $details[$sms_timer_var];

                                if($this->dateEqualsSMSTrigger($date_to_calc, $time_elapsed)) {

                                    //Has alert already been created for this record id? -> check all alerts
                                    $all_alerts = $this->getAllSMSAlerts();
                                    if (!empty($all_alerts)){

                                        $create_new_alert = false;
                                        //loop thorugh alerts to see if record ID, study ID, event, and variable all match?
                                        foreach ($all_alerts as $alert) {

                                            //Check if the exact alert already exists
                                            if($alert->record_id === $record_id && $alert->form_event === $details[$form_event] && $alert->form_variable === $details[$form_var]){
                                                // yes, it  exists, stop checking, don't create new.
                                                $create_new_alert = false;
                                                break;
                                            }else{
                                                //no, doesn't seem to exist yet, keep checking until all have been looped.
                                                $create_new_alert = true;
                                            }
                                        }
                                        if($create_new_alert){
                                            //Alert did not exist, create alert
                                            $alert = new AlertRecurrenceLogic();
                                            $alert->createNewAlert(
                                                $study->id,
                                                $record_id_var,
                                                $record_id ,
                                                $date_to_calc,
                                                $time_elapsed,
                                                $details[$recurrence_var],
                                                $details[$num_days_var],
                                                $details[$form_event],
                                                $details[$form_var],
                                                $details[$message_var]
                                            );

                                        }
                                    } else {
                                        //NO alerts exist so create alert
                                        $alert = new AlertRecurrenceLogic();
                                        $alert->createNewAlert(
                                            $study->id,
                                            $record_id_var,
                                            $record_id ,
                                            $date_to_calc,
                                            $time_elapsed,
                                            $details[$recurrence_var],
                                            $details[$num_days_var],
                                            $details[$form_event],
                                            $details[$form_var],
                                            $details[$message_var]
                                        );
                                    }
                                }else{
                                    //Not in date range, do nothing.
                                    continue;
                                }
                            }
                        }
                    }
                }

            }catch (\Exception $e){
                $note =  'Failed::checkForNewSMS() Check TextlocalAPI:' . $textlocal_api_token . ' REDCap API: ' . $redcap_api_token . ' REDCapURL: ' . $apiUrl . '' ;
                $this->updateActivityHistory(null, null, null, $note, $e);
                continue;
            }

        }

    }
}

public function checkForSMSToSend(){

    //check if any new SMS alerts need to be created first:
    $this->checkForNewSMSAlerts();

    //Get list of all known alerts to send:
    $alertdata = $this->getAllSMSAlerts();

    if(!empty($alertdata)){
        //Store values in temporary array to loop through later
        $tmp_alert_array = array();
        foreach ($alertdata as $key => $value){
            $tmp_alert_array[$key] = $value;
        }

        foreach ($tmp_alert_array as $array) {

            try{
                $valid = false;

                //Check if we've EVER sent this alert
                if ($array->last_sent === null) {
                    //Never been sent: Now check if today is the day to send:
                    if ($this->dateEqualsSMSTrigger($array->calc_date, $array->send_after_num_days_elapsed)) {
                        //today is the day to send:
                        $valid = true;

                    }
                }

                //Check if it has valid dates to send (if enough time has passed since it was last sent)
                if ($array->last_sent !== null && $this->dateEqualsSMSTrigger($array->last_sent, $array->send_every_num_days)) {
                    // VALID.
                    $valid = true;
                }

                //Check if the most recent SMS sent "today"
                if ($array->last_sent !== null && $this->dateEqualsSMSTrigger($array->last_sent, 0)) {
                    //An SMS was already sent today: NOT VALID.
                    $valid = false;
                    continue;
                }


                //If valid dates, check REDCap to make sure it still meets the criteria to send:
                if ($valid) {

                    //GET Study specifics from phc_sms_db.studies
                    $helper = new AlertRecurrenceLogic();
                    $tmp_study_get = $helper->getStudyAlertInfo($array->study_id);
                    $tmp_study = $tmp_study_get[0];


                    //$array is the stored alert values, $tmp_array is the stored study details values
                    $record_d_variable_name = $array->record_id_variable_name;
                    $record_id = $array->record_id;
                    $alert_form_event = $array->form_event;
                    $alert_form_variable = $array->form_variable;
                    $alert_message = $array->alert_message;

                    $textLocalAPI = $tmp_study->textlocal_api;
                    $REDCapAPI = $tmp_study->redcap_api;
                    $REDCapURL = $tmp_study->url;
                    $phone_event = $tmp_study->phone_event;
                    $phone_variable = $tmp_study->phone_variable;


                    $project = new RedCapProject($REDCapURL, $REDCapAPI);
                    $records = $project->exportRecords();
                    $send_sms = false;

                    //Loop through all records, where record ID matches and store relevant data and check if form is completed:
                    foreach ($records as $record) {

                        if ($record[$record_d_variable_name] === $record_id) {
                            //check if form is still incomplete (0 or 1 = incomplete  2 = complete )
                            if ($record['redcap_event_name'] === $alert_form_event && $record[$alert_form_variable] !== 2) {
                                //Form is incomplete send a reminder text:
                                $send_sms = true;
                            }
                            //Retrieve the phone number from the correct record and store it:
                            if ($record['redcap_event_name'] === $phone_event && $record[$phone_variable] !== '') {
                                $phone_number = $record[$phone_variable];
                                $phone_number = $this->phoneFormatter($phone_number);
                            }
                        }
                    }

                    if ($send_sms) {

                        $stop = 0;
                        //send SMS
                        $sms = $this->sendSMS( $array->study_id, $textLocalAPI, $phone_number, $alert_message);

                        //Check if sms sent:
                        if($sms){
                            //SMS was sent: Update specific alert with new date and number of times sent:
                            $helper->updateStudyAlertInfo($array->alert_id);
                            //Update activity log:
                            $note = 'SMS for alert ID: ' . $array->alert_id . ' was successfully sent.';
                            $this->updateActivityHistory($array->alert_id, null, $record_id, $note, null );
                        }else{
                            //SMS was not sent: log this
                            $note = 'SMS FAILED TO SEND for alert ID: ' . $array->alert_id . ' .';
                            $this->updateActivityHistory($array->alert_id, null, $record_id, $note, null );

                            //TESTING WITH SMS OFF:
//                            $helper->updateStudyAlertInfo($array->alert_id);
                            //END TESTING
                        }

                    }
                }

            }catch(\Exception $e){
                $note =  'Failed::checkForSMSToSend()'  ;
                $this->updateActivityHistory(null, null, null, $note, $e);
            }
        }

    }
}

//borrowed this piece of code from REDCap
public function phoneFormatter($phoneNumber){

    $prefix = '44';
    $invalid = '';

    // Remove all non-numerals
    $phoneNumber = preg_replace("/[^0-9]/", "", $phoneNumber);

    //check if enough digits for number
    if (strlen($phoneNumber) < 11) {
        // Not enough digits: invalid number
        $note = 'FAILED::phoneFormatter(). Please check the phone number';
        $this->updateActivityHistory(null, null, null, $note, null);
        return $invalid;
    }

    $first_digit = (int)substr($phoneNumber, 0, 1);

    if (strlen($phoneNumber) === 11 && $first_digit === 0 ) {

        $tmp_phone_number = substr($phoneNumber, 1, 10);
        $phoneNumber = $prefix . $tmp_phone_number;
        $stop = 0;

    }

    //If number is greater
    if (strlen($phoneNumber) > 12){

        $first_two_digits = substr($phoneNumber, 0, 2);

        if((int)$first_two_digits === 44 ){

            $third_digit = substr($phoneNumber, 2, 1);

            if((int)$third_digit === 0){

                $tmp_phone_number = substr($phoneNumber, 3, 10);
                $phoneNumber = $prefix . $tmp_phone_number;
                if((int)strlen($phoneNumber) !== 12){
                    $phoneNumber = $invalid;
                }
            }else{
                $phoneNumber = $invalid;
            }
        }else{
            $phoneNumber = $invalid;
        }
    }

    return $phoneNumber;

}

    public function updateActivityHistory($sms_alert_id, $sms_study_id, $redcap_record_id, $error_note, $error_message){

        $activity_array = [
            'sms_alert_id' => $sms_alert_id,
            'sms_study_id' => $sms_study_id,
            'redcap_record_id' => $redcap_record_id,
            'error_note' => $error_note,
            'error_message' => $error_message


        ];

        Activity::create($activity_array);

    }

    public function getAllSMSAlerts(){
        $tmpData = DB::select('SELECT * FROM alerts');
        return $tmpData;
    }
}
