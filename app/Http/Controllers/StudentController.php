<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
	public $module = 'student';
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

    
}