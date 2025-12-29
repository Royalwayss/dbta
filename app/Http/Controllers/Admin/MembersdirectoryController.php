<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembersDirectory;

use App\Models\AdminsRole;
use Session;
class MembersdirectoryController extends Controller
{
	public function members_directory(){ 
		Session::put('page','members-directory');
		$rows = MembersDirectory::get();
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.members_directory.members_directory')->with(compact('rows','module'));    
	}
	
	public function addedit_member_directory (request $request,$id=null){
		
		if($id==""){
			$title = "Add Members Directory";
			$row = new MembersDirectory;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Member's Directory";
			$row = MembersDirectory::find($id);
			$model = "MembersDirectory"; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'role' => 'required',
				'designation_prefix' => 'required',
				'member_name' => 'required',
				'serial_no' => 'required',
				
				
			];
			$customMessages = [
				
				
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all(); 
			if(isset($data['id']) && $data['id']!=""){
				$row = MembersDirectory::find($data['id']);
				$message = "Member's Directory updated successfully!";
			}else{
				$row = new MembersDirectory;
				$message = "Member's Directory added successfully!";    
			}
			
			$row->role = $data['role'];
			$row->designation_prefix = $data['designation_prefix'];
			$row->member_name = $data['member_name'];
			$row->serial_no = $data['serial_no'];
			
			$row->contact_no = $data['contact_no'];
			$row->address = $data['address'];
			$row->email = $data['email'];
			$row->sort = $data['sort'];
			if(!empty( $data['status'])){
			   $row->status = 1;
			}else{
				$row->status = 1;
			}
			$row->save();
			
			
			
			
			
			return redirect('admin/members-directory')->with('success_message',$message);
		}
		return view('admin.members_directory.add_edit_members_directory')->with(compact('title','row','prevId','nextId')); 
	}
	
	
	
	
}