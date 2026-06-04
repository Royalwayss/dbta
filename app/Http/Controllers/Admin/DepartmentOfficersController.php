<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepartmentOfficer;
use App\Models\AdminsRole;
use Session;
class DepartmentOfficersController extends Controller
{
	public function departmentofficers(){ 
		Session::put('page','departmentofficer');
		$rows = DepartmentOfficer::get(); 
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.department-officers.department-officers')->with(compact('rows','module'));    
	}
	
	public function addEditDepartmentOfficers(request $request,$id=null){
		
		if($id==""){
			$title = "Add Department Officer";
			$row = new DepartmentOfficer;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Department Officer";
			$row = DepartmentOfficer::find($id);
			$model = 'Downloads'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'title' => 'required',
				'pdf_sort' => 'required',
				
			];
			$customMessages = [
				'month.title' => 'Enter the title',
				'pdf_sort.required' => 'Enter the pdf sort',
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all();  
			if(isset($data['id']) && $data['id']!=""){
				$row = DepartmentOfficer::find($data['id']);
				$message = "Department Officer pdf has been updated successfully!";
			}else{
				$row = new Downloads;
				$message = "Department Officer pdf has been added successfully!";    
			}
	         $row->title = $data['title'];
			 if($request->hasFile('file')) {
				$file = $request->file('file');       
				$extension = $file->getClientOriginalExtension();
				$allowed_extension = array('pdf','PDF','jpg','jpeg','png','JPG','JPEG','PNG');
				if(in_array($extension, $allowed_extension)){
					$file_name = time().''.rand(100,999).'.'.$extension; 
					$destinationPath = 'front/department-officers/';
					$file->move($destinationPath, $file_name);
					$row->file = $file_name; 
				}

			}
			
			
			$row->pdf_sort = $data['pdf_sort'];
			if(!empty($data['status'])){
				$row->status = 1;
			}else{
				$row->status = 0;
			}
			$row->save();
			return redirect('admin/department-officers')->with('success_message',$message);
		}
		return view('admin.department-officers.add_edit_department_officer')->with(compact('title','row','prevId','nextId')); 
	}
}