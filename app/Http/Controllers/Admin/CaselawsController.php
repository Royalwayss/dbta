<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseLaw;
use App\Models\AdminsRole;
use Session;
class CaselawsController extends Controller
{
	public function caselaws(){ 
		Session::put('page','case-laws');
		$rows = CaseLaw::get(); 
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.case-laws.case-laws')->with(compact('rows','module'));    
	}
	
	public function addEditCaselaw (request $request,$id=null){
		
		if($id==""){
			$title = "Add Case law";
			$row = new Caselaw;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Case law";
			$row = Caselaw::find($id);
			$model = 'Caselaw'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'title' => 'required',
				'sort' => 'required',
				
			];
			$customMessages = [
				'month.title' => 'Enter the title',
				'sort.required' => 'Enter the sort',
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all();  
			if(isset($data['id']) && $data['id']!=""){
				$row = Caselaw::find($data['id']);
				$message = "Caselaw pdf has been updated successfully!";
			}else{
				$row = new Caselaw;
				$message = "Caselaw pdf has been added successfully!";    
			}
	         $row->title = $data['title'];
	         $row->description = $data['description'];
			 if($request->hasFile('pdf')) {
				$file = $request->file('pdf');       
				$extension = $file->getClientOriginalExtension();
				$allowed_extension = array('pdf','PDF');
				if(in_array($extension, $allowed_extension)){
					$file_name = time().''.rand(100,999).'.'.$extension; 
					$destinationPath = 'front/pdf/caselaws/';
					$file->move($destinationPath, $file_name);
					$row->pdf = $file_name; 
				}

			}
			
			
			$row->sort = $data['sort'];
			if(!empty($data['status'])){
				$row->status = 1;
			}else{
				$row->status = 0;
			}
			$row->save();
			return redirect('admin/case-laws')->with('success_message',$message);
		}
		return view('admin.case-laws.add_edit_case-law')->with(compact('title','row','prevId','nextId')); 
	}
}