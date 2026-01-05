<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PublicNotice;
use App\Models\AdminsRole;
use Session;
class PublicNoticeController extends Controller
{
	public function public_notice(){ 
		Session::put('page','public-notice');
		$rows = PublicNotice::get(); 
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.public_notice.public_notice')->with(compact('rows','module'));    
	}
	
	public function addEditPublicNotice (request $request,$id=null){
		
		if($id==""){
			$title = "Add Public Notice";
			$row = new PublicNotice;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Public Notice";
			$row = PublicNotice::find($id);
			$model = 'PublicNotice'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'message' => 'required',
				'date' => 'required',
				'sort' => 'required',
				
			];
			$customMessages = [
				'month.message' => 'Select the message',
				'month.required' => 'Select the date',
				'sort.required' => 'Enter the sort',
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all();  
			if(isset($data['id']) && $data['id']!=""){
				$row = PublicNotice::find($data['id']);
				$message = "Public Notice updated successfully!";
			}else{
				$row = new PublicNotice;
				$message = "Public Notice added successfully!";    
			}
	          
			 if($request->hasFile('file')) {
				$file = $request->file('file');  
				$extension = $file->getClientOriginalExtension();
				$allowed_extension = array('pdf','PDF','jpg','jpeg','png','JPG','JPEG','PNG');
				if(in_array($extension, $allowed_extension)){
					$file_name = time().''.rand(100,999).'.'.$extension; 
					$destinationPath = 'front/images/public-notice/';
					$file->move($destinationPath, $file_name);
					$row->file = $file_name; 
				}

			}
			
		
			$row->message = $data['message']; 
			$row->date = $data['date']; 
		
			$row->sort = $data['sort'];
			if(!empty($data['status'])){
				$row->status = 1;
			}else{
				$row->status = 0;
			}
			$row->save();
			return redirect('admin/public-notice')->with('success_message',$message);
		}
		return view('admin.public_notice.add_edit_public_notice')->with(compact('title','row','prevId','nextId')); 
	}
}