<?php

namespace App\Http\Controllers;

use App\SMSLogic\PHCSMS;
use App\SMSLogic\AlertRecurrenceLogic;

use App\Study;
use Illuminate\Http\Request;


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
            'phone_variable' => 'required',
        ]);

        $formFields['sms_invitations'] = json_encode($inv_array);


        //TESTING PURPOSES: Use this to run off update.
        //This is for testing PHCSMS stuff:
//        $helper = new PHCSMS();
//        $tabledata = $helper->checkForNEWAlerts();

        //This is for testing Recurring Alerts:
//        $alert = new AlertRecurrenceLogic();
//        $alert->checkForRecurringAlerts();
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

    //Delete study
    public function destroy( Study $study){
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
