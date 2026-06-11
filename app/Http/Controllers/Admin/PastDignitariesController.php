<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PastDignitary;
use App\Models\AdminsRole;
use Session;
class PastDignitariesController extends Controller
{
	public function pastdignitaries (){ 
		Session::put('page','past-dignitaries');
		$rows = PastDignitary::get(); 
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.past-dignitaries.past-dignitaries')->with(compact('rows','module'));    
	}
	
	public function addEditPastdignitary(request $request,$id=null){
		
		if($id==""){
			$title = "Add Past Dignitary";
			$row = new PastDignitary;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Past Dignitary";
			$row = PastDignitary::find($id);
			$model = 'PastDignitary'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'year' => 'required',
				'president' => 'required',
				'secretary' => 'required',
			];
			$customMessages = [
				
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all();  
			if(isset($data['id']) && $data['id']!=""){
				$row = PastDignitary::find($data['id']);
				$message = "Past Dignitary pdf has been updated successfully!";
			}else{
				$row = new PastDignitary;
				$message = "Past Dignitary pdf has been added successfully!";    
			}
	         $row->year = $data['year'];
	         $row->president = $data['president'];
	         $row->secretary = $data['secretary'];

			 if(!empty($data['status'])){
				$row->status = 1;
			 }else{
				$row->status = 0;
			 }
			 $row->save();
			 return redirect('admin/past-dignitaries')->with('success_message',$message);
		}
		return view('admin.past-dignitaries.add_edit_past_dignitary')->with(compact('title','row','prevId','nextId')); 
	}
}