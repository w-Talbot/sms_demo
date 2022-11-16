<?php

namespace App\SMSLogic;

use IU\PHPCap\RedCapProject;
use IU\PHPCap\PhpCapException;
use App\StudyConfiguration;
use Illuminate\Support\Facades\DB;

class PHCSMS {




public function sendSMS($participant, $message ){

   $stop = 0;


    $apiKey = urlencode('Your apiKey');

    // Message details
    $numbers = array(447123456789, 447987654321);
    $sender = urlencode('Jims Autos');
    $message = rawurlencode('This is your message');

    $numbers = implode(',', $numbers);

    // Prepare data for POST request
    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

    // Send the POST request with cURL
    $ch = curl_init('https://api.txtlocal.com/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Process your response here
    echo $response;


}

public function getAllStudyData(){

    $tmpData = DB::select('SELECT * FROM studies');

    return $tmpData;
}

public function dateIsBeyondLimit($date_to_check, $date_diffrence):bool{

    $origin = new \DateTime('today');
    $target = new \DateTime($date_to_check);

    //signed value ex: -12
//    $interval = $origin->diff($target)->format("%r%a");

    //unsigned value ex: 12
    $interval = $origin->diff($target)->format("%a");

    if($interval >= $date_diffrence){
        return true;
    }else{
        return false;
    }
}

public function checkForAlerts(){

    $tabledata = $this->getAllStudyData();

    //Loop through all studies in database:
    foreach($tabledata as $study){

        //Turn the data into a usable format (from STD::Class to Array) as $tmp_array
        $data = $study;
        $tmp_array = array();
        foreach ($data as $key => $value){
            $tmp_array[$key] = $value;
        }

        //Store the current projects REDCap API details to check it for any records that should send SMS:
        $apiToken  = $tmp_array['api'];
        $apiUrl = $tmp_array['url'];
        $number = $tmp_array['phone_variable'];
        $details_to_check = json_decode($tmp_array['sms_invitations']);
        $details = array();

        //Store the specific invitation criteria in an array to check
        foreach ($details_to_check  as $key => $value){
            $details[$key] = $value;
        }


        //Get all data from REDcap project, stored in $projects and $records
        $project = new RedCapProject($apiUrl, $apiToken);
        $projectInfo = $project->exportProjectInfo();
        $records = $project->exportRecords();

        //Loop through all records in project to see if they meet the criteria (stored in $details) for sending SMS:
        foreach ($records as $record) {

            //While looping through each record, need to check against stored details
            $num = count($details) / 7;
            $i = 0;
            for($x=0; $x < $num; $x++) {
                $calc_var = 'calc_var_' . strval($i);
                $rc_form_a = 'rc_form_a_' . strval($i);
                $rc_form_b = 'rc_form_b_' . strval($i);
                $sms_timer_var = 'sms_timer_' . strval($i);
                $num_days_var = 'num_days_' . strval($i);
                $recurrence_var = 'recurrence_' . strval($i);
                $message_var = 'message_' . strval($i);
                $i++;


                $event = $details[$rc_form_a];
                $variable = $details[$rc_form_b];

                $test = $record['redcap_event_name'];

                try{
                    if($record['redcap_event_name'] == $event){
//                    check to see if form has been completed, if yes do nothing, if no check the date diff
                        if($record[$variable] == 2){
                            continue;
                        }else {
                            $date = $details[$calc_var];
                            $num_of_days = $details[$num_days_var];
                            if($this->dateIsBeyondLimit($record[$date], $num_of_days)){
                                $stop = 0;
                                $this->sendSMS();
                            }
                        }
                    }
                }catch ( \Exception $e) {
                    echo 'You have run into an error, please return to the Edit and make sure all variables are correctly input';
                    //Should log error

                }

            }
        }
    }

    return $tabledata;
}


}
