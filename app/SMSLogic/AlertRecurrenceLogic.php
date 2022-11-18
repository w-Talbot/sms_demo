<?php

namespace App\SMSLogic;

use IU\PHPCap\RedCapProject;
use App\StudyConfiguration;
use Illuminate\Support\Facades\DB;
use App\Alert;

class AlertRecurrenceLogic {


    //Create recurring alert
    public function createNewAlert($studyid, $record_id_var, $record_id){

        $today = new \DateTime('today');

        $alertArray = [
            'study_id' => $studyid,
            'record_id_variable_name' => $record_id_var,
            'record_id' => $record_id,
            'first_sent' => $today,
            'last_sent' => $today,
            'times_sent' => 0

        ];

        Alert::create($alertArray);
    }

    public function checkForRecurringAlerts(){

        $tabledata = $this->getAllRecurringSMS();

        if($tabledata )
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
