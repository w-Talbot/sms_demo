<?php

namespace App\SMSLogic;

use IU\PHPCap\RedCapProject;
use IU\PHPCap\PhpCapException;
use App\StudyConfiguration;
use Illuminate\Support\Facades\DB;
use App\SMSLogic\AlertRecurrenceLogic;


class PHCSMS {



public function sendSMS($textlocal_api, $participant_phone_number, $text_message ){





    $apiKey = urlencode($textlocal_api);

    // Message details
    $numbers = array($participant_phone_number);
    $sender = urlencode('PHC');
    $message = rawurlencode($text_message);

    $numbers = implode(',', $numbers);

    // Prepare data for POST request
    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

    // Send the POST request with cURL
//    $ch = curl_init('https://api.txtlocal.com/send/');
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $response = curl_exec($ch);
//    curl_close($ch);

    // Process your response here
//    echo $response;


}

public function getAllStudyData(){

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

    if($interval === $date_diffrence){
        return true;
    }else{
        return false;
    }
}

public function checkForNEWAlerts(){

    $tabledata = $this->getAllStudyData();

    //Loop through all studies in database:
    foreach($tabledata as $study){

        //Turn the data into a new format (from STD::Class to an Array) as $tmp_array
        $data = $study;
        $tmp_array = array();
        foreach ($data as $key => $value){
            $tmp_array[$key] = $value;
        }

        //Store the current projects REDCap API details to check it for any records that should send SMS:
        $textlocal_api_token  = $tmp_array['textlocal_api'];
        $redcap_api_token  = $tmp_array['redcap_api'];
        $apiUrl = $tmp_array['url'];

        $phone_var = $tmp_array['phone_variable'];
        $phone_event = $tmp_array['phone_event'];
        $phone_number = '';


        $details_to_check = json_decode($tmp_array['sms_invitations']);
        $details = array();

            //Store the specific invitation criteria in an array to check
        foreach ($details_to_check  as $key => $value){
            $details[$key] = $value;
        }


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
                            break;
                        }
                    }
                }

                //While looping through each record, need to check against stored details
                $num = count($details) / 8;
                $i = 0;
                for($x=0; $x < $num; $x++) {
                    $date_event = 'date_event_' . strval($i);
                    $date_var = 'date_var_' . strval($i);
                    $form_event = 'form_event_' . strval($i);
                    $form_var = 'form_var_' . strval($i);
                    $sms_timer_var = 'sms_timer_' . strval($i);
                    $num_days_var = 'num_days_' . strval($i);
                    $recurrence_var = 'recurrence_' . strval($i);
                    $message_var = 'message_' . strval($i);
                    $i++;

//                    Get DATE and FORM values for each invitation from REDCap
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

                    try{
//                    Check to see if form has been completed, if yes do nothing, if no check the date diff using dateEqualsSMSTRigger function
                            if($form_complete === 2){
                                //Form is complete do nothing
                                continue;
                            }else {
                                $time_elapsed = $details[$sms_timer_var];

                                if($this->dateEqualsSMSTrigger($date_to_calc, $time_elapsed)){

                                    $txt = $details[$message_var];
                                    $this->sendSMS( $textlocal_api_token, $phone_number, $txt);

                                    //Create a recurring alert if specified:
                                    $recurrence = $details[$recurrence_var];
                                    if($recurrence > 0){
                                        $alert = new AlertRecurrenceLogic();
                                        $alert->createNewAlert($study->id, $record_id_var, $record_id , $details[$recurrence_var], $details[$num_days_var], $details[$form_event], $details[$form_var], $details[$message_var] );
                                        continue;
                                    }
                                    continue;

                                }else{
                                    continue;
                                }
                            }
//                        }
                    }catch ( \Exception $e) {
                        echo 'You have run into an error, please return to the Edit and make sure all variables are correctly input';
                        //Should log error

                    }

                }
            }


            }
        }

    return $tabledata;
}

//borrowed this piece of code from REDCap
public function phoneFormatter($phoneNumber){

    //May need to be updated wt-check
    // If number contains an extension (denoted by a comma between the number and extension), then separate here and add later
    $phoneExtension = "";
    if (strpos($phoneNumber, ",") !== false) {
        list ($phoneNumber, $phoneExtension) = explode(",", $phoneNumber, 2);
    }
    // Remove all non-numerals
    $phoneNumber = preg_replace("/[^0-9]/", "", $phoneNumber);
    // Prepend number with + for international use cases (except for short codes, which are 5 or 6 digits in length)
//    if (strlen($phoneNumber) > 6) {
//        $phoneNumber = (isPhoneUS($phoneNumber) ? "+1" : "+") . $phoneNumber;
//    }
    // If has an extension, re-add it
    if ($phoneExtension != "") $phoneNumber .= ",$phoneExtension";
    // Return formatted number
    return $phoneNumber;


}


}
