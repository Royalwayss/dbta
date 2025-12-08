<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Downloads;
use App\Models\AdminsRole;
use Session;
class DownloadsController extends Controller
{
	public function downloads(){ 
		Session::put('page','downloads');
		$rows = Downloads::get(); 
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.downloads.downloads')->with(compact('rows','module'));    
	}
	
	public function addEditDownload(request $request,$id=null){
		
		if($id==""){
			$title = "Add Download";
			$row = new Downloads;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Download";
			$row = Downloads::find($id);
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
				$row = Downloads::find($data['id']);
				$message = "Download pdf has been updated successfully!";
			}else{
				$row = new Downloads;
				$message = "Download pdf has been added successfully!";    
			}
	         $row->title = $data['title'];
			 if($request->hasFile('pdf')) {
				$file = $request->file('pdf');       
				$extension = $file->getClientOriginalExtension();
				$allowed_extension = array('pdf','PDF');
				if(in_array($extension, $allowed_extension)){
					$file_name = time().''.rand(100,999).'.'.$extension; 
					$destinationPath = 'front/pdf/downloads/';
					$file->move($destinationPath, $file_name);
					$row->pdf = $file_name; 
				}

			}
			
			
			$row->pdf_sort = $data['pdf_sort'];
			if(!empty($data['status'])){
				$row->status = 1;
			}else{
				$row->status = 0;
			}
			$row->save();
			return redirect('admin/downloads')->with('success_message',$message);
		}
		return view('admin.downloads.add_edit_download')->with(compact('title','row','prevId','nextId')); 
	}
}