<?php

namespace App\SMSLogic;

use IU\PHPCap\RedCapProject;
use App\StudyConfiguration;
use Illuminate\Support\Facades\DB;
use App\SMSLogic\PHCSMS;
use App\Alert;

class AlertRecurrenceLogic {


    //Create recurring alert
    public function createNewAlert($studyid, $record_id_var, $record_id, $calc_date, $send_after_num_days_elapsed,  $num_of_recurrences, $num_days, $form_event, $form_variable, $alert_message){

        $today = new \DateTime('today');

        $alertArray = [
            'study_id' => $studyid,
            'record_id_variable_name' => $record_id_var,
            'record_id' => $record_id,
            'calc_date' => $calc_date,
            'last_sent' => null,
            'times_sent' => 0,
            'form_event' => $form_event,
            'form_variable' => $form_variable,
            'alert_message' => $alert_message,
            'send_after_num_days_elapsed' => $send_after_num_days_elapsed,
            'num_of_recurrences' => $num_of_recurrences,
            'send_every_num_days' => $num_days

        ];

        Alert::create($alertArray);
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
    public function destroySingleAlert( $alert){
        DB::table('alerts')->where('alert_id', $alert)->delete();
    }

    //Delete all alerts for study
    public function destroyAllStudyAlerts( $alert){
        DB::table('alerts')->where('study_id', $alert)->delete();

    }
}
