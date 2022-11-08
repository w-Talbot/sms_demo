<?php

namespace App\Http\Controllers;

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
        return view('manage.edit', ['study' => $study]);
    }

    //Update listing
    public function update(Request $request, Study $study){
        $formFields = $request->validate([
            'study_name' => 'required',
            'api' => 'required',
            'url' => 'required']);

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
//            $param = $inv_array;
            $stop = 0;
            json_encode($inv_array);


            $formFields = $request->validate([
                'study_name' => 'required',
                'api' => 'required',
                'url' => 'required']);

dd($request);


//            Study::create($formFields)->with('success-message', 'Study created successfully!');

//            return redirect('/manage/index');
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
