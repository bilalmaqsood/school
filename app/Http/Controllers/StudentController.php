<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator; 

class StudentController extends Controller
{
	public $module = 'student';



//        $validator = Validator::make(Input::all(), $rules);
//        if ($validator->passes())
//        {

    public function __construct() {
        parent::__construct();
		$this->model = new Student();
    }

    public function getIndex()
    {
        return View('Student.index');
    }

	public function getUpdate(Request $request, $id = null)
	{
		/*
		if($id =='')
		{
			 if($this->access['is_add'] ==0 )
			 return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}	
		
		if($id !='')
		{
			 if($this->access['is_edit'] ==0 )
			 return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}				
		*/
		 $row = $this->model->find($id);
		 if($row)
		 {
		 	$this->data['row'] 		=  $row;
		 } else {
		 	$this->data['row'] 		= $this->model->getColumnTable('tb_users');
		 }
		 //$this->data['setting'] 		= $this->info['setting'];
		 //$this->data['fields'] 		=  \AjaxHelpers::fieldLang($this->info['config']['forms']);
		
		 $this->data['id'] = $id;

		return view('student.form', $this->data);
	}	

	public function postSave( Request $request, $id =0)
	{
		$rules = array(
            
            'last_name' => 'required',
            'middle_name' => 'required',
            'first_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'county_of_origin' => 'required',
            'nationality' => 'required',
            'religion' => 'required',
            'admission_date' => 'required',
        );



		// $rules = $this->validateForm();
		// unset($rules['image']);
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {

	  $id = $this->model->insertRow($data , $request->input('id'));
			
			return response()->json(array(
				'status'=>'success',
				'message'=> \Lang::get('core.note_success')
				));	
			
		} else {

			$message = $validator->getMessageBag()->toArray() ;
			return response()->json(array(
				'message'	=> $message,
				'status'	=> 'error'
			));	
		}	
	
	}	

    
}