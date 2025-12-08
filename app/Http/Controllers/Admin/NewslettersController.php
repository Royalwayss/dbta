<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\AdminsRole;
use Session;
class NewslettersController extends Controller
{
	public function newsletters(){ 
		Session::put('page','newsletters');
		$rows = Newsletter::get(); 
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.newsletters.newsletters')->with(compact('rows','module'));    
	}
	
	public function addEditNewsletter(request $request,$id=null){
		
		if($id==""){
			$title = "Add Newsletter";
			$row = new Newsletter;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Newsletter";
			$row = Newsletter::find($id);
			$model = 'Newsletter'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'month' => 'required',
				'newsletter_sort' => 'required',
				
			];
			$customMessages = [
				'month.required' => 'Enter the month',
				'newsletter_sort.required' => 'Enter the newsletter sort',
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all();  
			if(isset($data['id']) && $data['id']!=""){
				$row = Newsletter::find($data['id']);
				$message = "Newsletter updated successfully!";
			}else{
				$row = new Newsletter;
				$message = "Newsletter added successfully!";    
			}
	          
			 if($request->hasFile('pdf')) {
				$file = $request->file('pdf');       
				$extension = $file->getClientOriginalExtension();
				$allowed_extension = array('pdf','PDF');
				if(in_array($extension, $allowed_extension)){
					$file_name = time().''.rand(100,999).'.'.$extension; 
					$destinationPath = 'front/pdf/newsletters/';
					$file->move($destinationPath, $file_name);
					$row->pdf = $file_name; 
				}

			}
			
		
			$row->month = $data['month']; 
		
			$row->newsletter_sort = $data['newsletter_sort'];
			if(!empty($data['status'])){
				$row->status = 1;
			}else{
				$row->status = 0;
			}
			$row->save();
			return redirect('admin/newsletters')->with('success_message',$message);
		}
		return view('admin.newsletters.add_edit_newsletter')->with(compact('title','row','prevId','nextId')); 
	}
}