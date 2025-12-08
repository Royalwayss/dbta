<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Committee;
use App\Models\CommitteeMember;
use App\Models\AdminsRole;
use Session;
class CommitteesController extends Controller
{
	public function committees(){ 
		Session::put('page','committees');
		$rows = Committee::get();
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.committees.committees')->with(compact('rows','module'));    
	}
	
	public function addEditMedia(request $request,$id=null){
		
		if($id==""){
			$title = "Add Committee";
			$row = new Committee;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Committee";
			$row = Committee::with('committee_members')->find($id); 
			$model = 'Committee'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		//pd($request->all());
		if($request->isMethod('post')){
			
			$rules = [
				'title' => 'required',
				'sort' => 'required',
				
			];
			$customMessages = [
				'title.required' => 'Enter the title',
				'sort.required' => 'Enter the sort',
				
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all(); 
			if(isset($data['id']) && $data['id']!=""){
				$row = Committee::find($data['id']);
				$message = "Committee updated successfully!";
			}else{
				$row = new Committee;
				$message = "Committee added successfully!";    
			}
			
			$row->title = $data['title'];
			$row->sort = $data['sort'];
			$row->status = $data['committee_status'];
			$row->save();
			
			$committee_id = $row->id;
			
			
			
			  
			  
			  foreach($data['name'] as $key=>$name){
			   $committee_member = new CommitteeMember;
			   $imageName = '';
				if(isset($request->file('images')[$key])){
					$image_tmp = $request->file('images')[$key];
					if($image_tmp->isValid()){ 
						$manager = new ImageManager(new Driver());
						$image = $manager->read($image_tmp); 
						$extension = $image_tmp->getClientOriginalExtension();
						$imageName = time().''.rand(11,99).'.'.$extension; 
						$image_path = 'front/images/committees/members/'.$imageName;  
						$image->save($image_path); 
					}
				}
					
						
				$committee_member->profile = $imageName;
				$committee_member->committee_id = $committee_id;
				$committee_member->name = $name;
				$committee_member->destination = $data['destination'][$key];
				$committee_member->sort = $data['member_sort'][$key];
				if(!empty($data['status'][$key])){
					$committee_member->status = '1';
				}else{
					$committee_member->status = '0';
				}
				$committee_member->save();
			  }
				
				
			
			
			
			if(isset($data['member_id']) && !empty($data['member_id'])){  
				foreach($data['member_id'] as $memberid){
					$committee_member = CommitteeMember::find($memberid); 
					if(isset($request->file('edit_image')[$memberid])){
					$image_tmp = $request->file('edit_image')[$memberid];
					if($image_tmp->isValid()){ 
						$manager = new ImageManager(new Driver());
						$image = $manager->read($image_tmp); 
						$extension = $image_tmp->getClientOriginalExtension();
						$imageName = time().''.rand(11,99).'.'.$extension; 
						$image_path = 'front/images/committees/members/'.$imageName;  
						$image->save($image_path); 
						$committee_member->profile = $imageName;
					}
				}
					
					
					
					
					
					
					$committee_member->committee_id = $committee_id;
					$committee_member->name = $data['edit_name'.$memberid];
					$committee_member->destination = $data['edit_destination'.$memberid];
					$committee_member->sort = $data['edit_sort'.$memberid];
					if(!empty($data['edit_status'.$memberid])){
						$committee_member->status = '1';
					}else{
						$committee_member->status = '0';
					}
					$committee_member->save();
				}
			}
			
			
			return redirect('admin/committees')->with('success_message',$message);
		}
		return view('admin.committees.add_edit_committee')->with(compact('title','row','prevId','nextId')); 
	}
	
	
	public function deleteMember(request $request,$id){
		CommitteeMember::where('id',$id)->delete();
		return true;
	}
	
}