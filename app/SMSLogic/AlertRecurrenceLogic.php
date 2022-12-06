<?php

namespace App\SMSLogic;

use IU\PHPCap\RedCapProject;
use App\StudyConfiguration;
use Illuminate\Support\Facades\DB;
use App\SMSLogic\PHCSMS;
use App\Alert;

class AlertRecurrenceLogic {


    //Create recurring alert
    public function createNewAlert($studyid, $record_id_var, $record_id, $num_of_recurrences, $num_days, $form_event, $form_variable, $alert_message){

        $today = new \DateTime('today');

        $alertArray = [
            'study_id' => $studyid,
            'record_id_variable_name' => $record_id_var,
            'record_id' => $record_id,
            'first_sent' => $today,
            'last_sent' => $today,
            'times_sent' => 0,
            'form_event' => $form_event,
            'form_variable' => $form_variable,
            'alert_message' => $alert_message,
            'num_of_recurrences' => $num_of_recurrences,
            'send_every_num_days' => $num_days

        ];

        Alert::create($alertArray);
    }

    public function checkForRecurringAlerts(){

        $alertdata = $this->getAllSMSAlerts();

        //Store values in temporary array to loop through later
        $tmp_alert_array = array();
        foreach ($alertdata as $key => $value){
            $tmp_alert_array[$key] = $value;
        }

        foreach ($tmp_alert_array as $array){

            //Check if we've sent all recurring alerts for a given participant
            if( $array->times_sent !== $array->num_of_recurrences){

                //Check the dates to see if should send:
                $helper = new PHCSMS();
                $date_check = $helper->dateEqualsSMSTrigger($array->last_sent, $array->send_every_num_days);
                //TESTING PURPOSES ONLY **uncomment/comment line above**
//                $test_date = '2022-12-04';
//                $date_check = $helper->dateEqualsSMSTrigger($test_date, $array->send_every_num_days);
                //END

                //if the diff between last sent and send_every_num_days is equal, then check if is NOW complete, else continue.
                if($date_check){

                    //GET Study specifics from phc_sms_db.studies
                    $tmp_study_get = $this->getStudyAlertInfo($array->study_id);
                    $tmp_study = $tmp_study_get[0];

                    $stop = 0;

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

                    //Loop through all records, where record ID matches and store relevant data
                    foreach ($records as $record) {

                        if( $record[$record_d_variable_name] === $record_id ){
                            //check conditions
                            if($record['redcap_event_name'] === $alert_form_event && $record[$alert_form_variable] !== 2){
                                $send_sms = true;
                            }
                            if($record['redcap_event_name'] === $phone_event && $record[$phone_variable] !== ''){
                                $phone_number = $record[$phone_variable];
                                //Maybe add phonenumber formatter and run it on this wt-check
                                $phone_number = $helper->phoneFormatter($phone_number);
                            }
                        }
                    }
                    //Maybe also only allow if valid phone-number/not null wt-check
                    if($send_sms){

                                //send SMS
                                $sms = $helper->sendSMS($textLocalAPI, $phone_number, $alert_message );

                                //Update specific alert with new date and number of times sent:
                                $this->updateStudyAlertInfo($array->alert_id);

                                $stop = 0;
                                break;
                            }

                    $stop =0;
                }else{
                    //Maybe add error message here wt-check

                }
            }
            //if the number of recurring has been reached, then remove it from the alert DB
            else if ( $array->times_sent === $array->num_of_recurrences ){
                $this->destroyAlert($array->alert_id);
            }
        }
    }

    /***
     * @return array
     * Returns all recurring alerts stored in the alerts table (all studies).
     * To access an individual studies' alerts
     * use the getStudyAlertInfo() function.
     */
    public function getAllSMSAlerts(){
        $tmpData = DB::select('SELECT * FROM alerts');
        return $tmpData;
    }

    /***
     * @param $studyid
     * @return array
     * Returns all alerts associated with a SPECIFIC study.
     */
    public function getStudyAlertInfo($studyid){
        $sql = "SELECT * FROM studies WHERE id = '$studyid'";
        $tmpAlert = DB::select($sql);
        return $tmpAlert;
    }

    /***
     * @param $alertid
     * @return void
     * This updates the last_sent date to "today"
     * and +=1 to times_sent.
     * This is to be called after a recurring message has been sent
     */
    public function updateStudyAlertInfo($alertid){
        $sql = "SELECT * FROM alerts WHERE alert_id = '$alertid'";
        $tmpGetData = DB::select($sql);
        $alertData = $tmpGetData[0];
        $numTimesSent = $alertData->times_sent;
        $numTimesSent += 1;

        $lastSent = new \DateTime('today');
        $lastSent = $lastSent->format('Y/m/d');

        $sql = "UPDATE phc_sms_db.alerts
                SET times_sent = '$numTimesSent', last_sent = '$lastSent'
                WHERE alert_id = '$alertid'";

        DB::statement($sql);

    }

    //Delete alert
    public function destroyAlert( $alert){
        DB::table('alerts')->where('alert_id', $alert)->delete();
    }
}
