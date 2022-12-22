<?php

namespace App\Http\Controllers;

use App\Alert;
use App\SMSLogic\PHCSMS;
use App\SMSLogic\AlertRecurrenceLogic;

use App\Study;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudyController extends Controller
{

    //show all listings
    public function index(){
        return view('manage.index',[
            'studies' => Study::all()
        ]);
    }

    //Show create form
    public function create(){
        return view('manage.create');
    }

    //Show edit form
    public function edit(Study $study){

        $data = json_decode($study->sms_invitations);

        $tmp_array = array();
        foreach ($data as $key => $value){
            $tmp_array[$key] = $value;
        }
        return view('manage.edit', ['study' => $study , 'tmp_array' => $tmp_array ]);
    }

    //Update listing
    public function update(Request $request, Study $study){


        //Check for any new alerts to add to the list
        $inv_array = array();
        foreach($request->except('_token') as $key => $value){
            if(preg_match(' /[0-9]/', substr($key, -1, 1))){
                $inv_array[$key] = $request->input($key);
            }
        }


        //Check if any existing alerts now need to be deleted:
        foreach($inv_array as $row => $value){

            $test = $row;
            if( substr($row,0 , 14) === 'delete_invite_'){

                $sfx_to_delete = substr($row,-3 , 3);
                $sfx_to_delete = preg_replace("/[^0-9]/", "", $sfx_to_delete);
                $stop = 0;

                foreach ($inv_array as $row => $value){
                    $needle = substr($row,-3 , 3);
                    $needle = preg_replace("/[^0-9]/", "", $needle);
                    if( $needle === $sfx_to_delete){
                        unset($inv_array[$row]);
                    }
                }
            }
        }


        $formFields = $request->validate([
            'study_name' => 'required',
            'textlocal_api' => 'required',
            'redcap_api' => 'required',
            'url' => 'required',
            'phone_event' => 'required',
            'phone_variable' => 'required',
        ]);

        $formFields['sms_invitations'] = json_encode($inv_array);


        //TESTING PURPOSES: Use this to run off update button.
        //This is for testing PHCSMS stuff:
//        $helper = new PHCSMS();
//        $helper->updateActivityHistory(null, null, null, 'test note 1', 'test error message');
//        $helper->checkForNewSMSAlerts();
//        $helper->checkForSMSToSend();
//        $sms_test = $helper->sendSMS(999, 'noapi', '447892936509', 'Testing return values.' );


        //This is for testing Recurring Alerts:
//        $alert = new AlertRecurrenceLogic();
//        $alert->checkForRecurringAlerts();
//        $alert->createNewAlert(5,123123,0000,'2022-10-10', 5,5,5,'test','test', 'test'  );
        //END TESTING


        $study->update($formFields);
        return back()->with('update-message', 'Study details have been successfully updated!');
    }

    //Store
        public function store(Request $request){

        $inv_array = array();
        foreach($request->except('_token') as $key => $value){
            if(preg_match(' /[0-9]/', substr($key, -1, 1))){
                $inv_array[$key] = $request->input($key);
            }
        }

            $formFields = $request->validate([
                'study_name' => 'required',
                'textlocal_api' => 'required',
                'redcap_api' => 'required',
                'url' => 'required',
                'phone_event' => 'required',
                'phone_variable' => 'required'
                ]);

            $formFields['sms_invitations'] = json_encode($inv_array);

            Study::create($formFields)->with('success-message', 'Study created successfully!');

            return redirect('/manage/index');
        }

    //Delete study (and all associated alerts)
    public function destroy( Study $study){

        //first destroy all associated alerts:
        $alert = new AlertRecurrenceLogic();
        $alert->destroyAllStudyAlerts( $study["id"]);
        //then destroy the study itself:
        $study->delete();


        return redirect('/manage/index')->with('delete-message', 'Study has been deleted successfully');
    }

    //single listings
    public function show( Study $study){
        return view('manage.show', [
            'study' => $study
        ]);
    }



}
