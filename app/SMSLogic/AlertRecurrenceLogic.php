<?php

namespace App\SMSLogic;

use IU\PHPCap\RedCapProject;
use App\StudyConfiguration;
use Illuminate\Support\Facades\DB;
use App\SMSLogic\PHCSMS;
use App\Alert;

class AlertRecurrenceLogic {


    //Create recurring alert
    public function createNewAlert($studyid, $record_id_var, $record_id, $num_of_recurrences, $num_days){

        $today = new \DateTime('today');

        $alertArray = [
            'study_id' => $studyid,
            'record_id_variable_name' => $record_id_var,
            'record_id' => $record_id,
            'first_sent' => $today,
            'last_sent' => $today,
            'times_sent' => 0,
            'num_of_recurrences' => $num_of_recurrences,
            'send_every_num_days' => $num_days

        ];

        Alert::create($alertArray);
    }

    public function checkForRecurringAlerts(){

        $alertdata = $this->getAllRecurringSMS();


        //Turn the data into a new format (from STD::Class to an Array) as $tmp_array
        $tmp_alert_array = array();
        foreach ($alertdata as $key => $value){
            $tmp_alert_array[$key] = $value;
        }

        foreach ($tmp_alert_array as $array){

            //Check if we've sent all recurring alerts for a given participant
            if( $array->times_sent !== $array->num_of_recurrences){



                //Check the dates to see if should send:
                $helper = new PHCSMS();
//                $date_check = $helper->dateEqualsSMSTrigger($array->last_sent, $array->send_every_num_days);

                //TESTING PURPOSES ONLY:
                $test_date = '2022-12-03';
                $date_check = $helper->dateEqualsSMSTrigger($test_date, $array->send_every_num_days);
                //END

                //if the diff between last sent and send_every_num_days is equal, then send, else continue.
                if($date_check){
                    //Send SMS

                    //GET Study specifics from phc_sms_db.studies

                    $study_info = $helper->getAllStudyData();

//                    $sms = $helper->sendSMS( needs values here);


                    //UPDATE this alert
                    //if send: update times_sent and last_sent

                    $stop =0;
                }else{
                    continue;
                }

            }
            //if the number of recurring has been reached, then remove it from the alert DB
            else if ( $array->times_sent === $array->num_of_recurrences ){
                $stop = 0;

                //Delete the recurring alert
            }

        }


        $stop = 0;


        /***
         * get todays date
         * access stored studies at specifed study_id
         * need first sent
         * form complete staus
         * how manys days to count from first
         * how many repeats are there, how manyt time has it repeated
         * who to send the txt to
         * what is the message
         */

    }

    public function getAllRecurringSMS(){
        $tmpData = DB::select('SELECT * FROM alerts');
        return $tmpData;
    }

    public function getStudyAlertInfo($studyid){
        $sql = "SELECT * FROM studies WHERE id = '$studyid'";
        $tmpAlert = DB::select($sql);
        return $tmpAlert;
    }

    //Delete alert
    public function destroyAlert( Alert $alert){
        $alert->delete();
    }
}
