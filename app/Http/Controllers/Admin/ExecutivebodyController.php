<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExecutiveBody;
use App\Models\AdminsRole;
use Session;
class ExecutivebodyController extends Controller
{
	public function executivebody(){ 
		Session::put('page','executive-body');
		$rows = ExecutiveBody::get(); 
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.executive_body.executive_body')->with(compact('rows','module'));    
	}
	
	public function addEditexecutiveBody  (request $request,$id=null){
		
		if($id==""){
			$title = "Add Executive Body";
			$row = new ExecutiveBody;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Executive Body";
			$row = ExecutiveBody::find($id);
			$model = 'ExecutiveBody'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'sort' => 'required',
				'name' => 'required',
				
			];
			$customMessages = [
				'name.required' => 'Enter the name',
				'sort.required' => 'Enter the sort',
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all();  
			if(isset($data['id']) && $data['id']!=""){
				$row = ExecutiveBody::find($data['id']);
				$message = "ExecutiveBody pdf has been updated successfully!";
			}else{
				$row = new ExecutiveBody;
				$message = "ExecutiveBody pdf has been added successfully!";    
			}
	         $row->name = $data['name']; 
	         $row->destination = $data['destination']; 
			 if($request->hasFile('image')) {
				$file = $request->file('image');       
				$extension = $file->getClientOriginalExtension();
				$allowed_extension = array('jpg','jpeg','png');
				if(in_array($extension, $allowed_extension)){
					$file_name = time().''.rand(100,999).'.'.$extension; 
					$destinationPath = 'front/images/executive-body/';
					$file->move($destinationPath, $file_name);
					$row->image = $file_name; 
				}

			}
			
			
			$row->sort = $data['sort'];
			if(!empty($data['status'])){
				$row->status = 1;
			}else{
				$row->status = 0;
			}
			if(!empty($data['show_on_home'])){
				$row->show_on_home = 1;
			}else{
				$row->show_on_home = 0;
			}
			
			
			$row->save();
			return redirect('admin/executive-body')->with('success_message',$message);
		}
		return view('admin.executive_body.add_edit_executive_body')->with(compact('title','row','prevId','nextId')); 
	}
}