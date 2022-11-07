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
            $formFields = $request->validate([
                'study_name' => 'required',
                        'api' => 'required',
                        'url' => 'required']);

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
