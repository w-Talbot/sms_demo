<?php

namespace App\SMSLogic;

use App\StudyConfiguration;
use Illuminate\Support\Facades\DB;
use App\Alert;

class AlertRecurrenceLogic {


    public function getAllRecurringSMS(){
        $tmpData = DB::select('SELECT * FROM alerts_recurrence');
        return $tmpData;
    }

    //create recurring alert
    public function createNewAlert($studyid, $first_sent){

        $today = new \DateTime('today');
        $array = [
            'project_id' => $studyid,
            'first_sent' => $first_sent,
            'last_send' => $today,
            'times_sent' =>'99',
            'first_send_time' => $today,
            'last_send_time' => $today
        ];

        Alert::create($array);
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
