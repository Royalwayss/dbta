<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\MeetingType;
use App\Models\AdminsRole;
use Session;
class MettingController extends Controller
{
	public function meeting(){ 
		Session::put('page','mettings');
		$rows = Meeting::get();
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.meetings.meetings')->with(compact('rows','module'));    
	}
	
	public function addEditMeeting(request $request,$id=null){
		
		if($id==""){
			$title = "Add Meeting";
			$row = new Meeting;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Meeting";
			$row = Meeting::find($id);
			$model = 'Meeting'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'meeting_title' => 'required',
				'meeting_type' => 'required',
				'description' => 'required',
				'meeting_date' => 'required',
				'location' => 'required',
				'meeting_sort' => 'required',
				
			];
			$customMessages = [
				'meeting_title.required' => 'Enter the meeting title',
				'meeting_type.required' => 'Enter the meeting type',
				'description.required' => 'Enter the meeting description',
				'meeting_date.required' => 'Enter the meeting date',
				'location.required' => 'Enter the meeting location',
				'meeting_sort.required' => 'Enter the meeting sort',
				
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all(); 
			if(isset($data['id']) && $data['id']!=""){
				$row = Meeting::find($data['id']);
				$message = "Meeting updated successfully!";
			}else{
				$row = new Meeting;
				$message = "Meeting added successfully!";    
			}
			
			if(!empty($row['images'])){
				$imagesNames = explode(',',$row['images']);
			}else{
				$imagesNames = [];
			}
			
			
			
			
			if($request->hasFile('images')){
				$images = $request->file('images'); 
				foreach($images as $key=>$img){
					$image_tmp = $img;
					if($image_tmp->isValid()){
						$manager = new ImageManager(new Driver());
						$image = $manager->read($image_tmp);
						$extension = $image_tmp->getClientOriginalExtension();
						$imageName = ($key+1).'-'.time().'.'.$extension;
						$image_path = 'front/images/meetings/'.$imageName; 
						$image->save($image_path);
						
						$imagesNames[] = $imageName;
					}
			   }
			    $imagesNames_implode = implode(',',$imagesNames);
				$row->images = $imagesNames_implode; 
			}
			
			
			
			$videos = [];
			$data['videos'] = array_filter($data['videos']);
			foreach($data['videos'] as $video){
				$videos[] = $video;
			}
			
			$row->videos = implode(',',$videos); 
			$row->meeting_title = $data['meeting_title'];
			$row->meeting_type = $data['meeting_type'];
			$row->description = $data['description'];
			$row->meeting_date = $data['meeting_date'];
			$row->meeting_sort = $data['meeting_sort'];
			$row->location = $data['location'];
			
			if(!empty($data['status'])){
				$row->status = 1;
			}else{
				$row->status = 0;
			}
			$row->save(); 
			return redirect('admin/meetings')->with('success_message',$message);
		}
		return view('admin.meetings.add_edit_meeting')->with(compact('title','row','prevId','nextId')); 
	}
	
	public function deleteMeetingImage(request $request,$id=null){
		if($id != ""){
			$update_images = [];
			$img = Meeting::find($id);
			$images = $img->images;
			$exxplode_images = explode(',',$img->images);
			$name = $request->input('name');
			foreach($exxplode_images as $image){
				if($name != $image){
					$update_images[] = $image;
				}
			}
			$explode_img = implode(',',$update_images);
			Meeting::where('id',$id)->update(['images'=>$explode_img]);
			echo true;
		}
	}
	
	
	
	
	public function meeting_types(){ 
		Session::put('page','meeting-types');
		$rows = MeetingType::get();
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.meeting_types.meeting_types')->with(compact('rows','module'));    
	}
	
	
	 
	public function addEditMeetingType(request $request,$id=null){
		
		if($id==""){
			$title = "Add Meeting Type";
			$row = new MeetingType;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Meeting Type";
			$row = MeetingType::find($id);
			$model = 'MeetingType'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				
				'name' => 'required',
				'description' => 'required',
				
				
			];
			$customMessages = [
				
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all(); 
			if(isset($data['id']) && $data['id']!=""){
				$row = MeetingType::find($data['id']);
				$message = "Meeting Type updated successfully!";
			}else{
				$row = new MeetingType;
				
				$slug = strtolower(trim($data['name']));
                $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
                $slug = preg_replace('/-+/', '-', $slug);
				
				$row->slug = $slug;
				$message = "Meeting Type added successfully!";    
			}
			
			
			
			
			
			
			if($request->hasFile('image1')){
				$image_tmp = $request->file('image1'); 
					if($image_tmp->isValid()){
						$manager = new ImageManager(new Driver());
						$image = $manager->read($image_tmp);
						$extension = $image_tmp->getClientOriginalExtension();
						$imageName = time().'.'.$extension;
						$image_path = 'front/assets/images/'.$imageName; 
						$image->save($image_path);
						$row->image1 = $imageName;
					}
			}
			
			if($request->hasFile('image2')){
				$image_tmp = $request->file('image2'); 
					if($image_tmp->isValid()){
						$manager = new ImageManager(new Driver());
						$image = $manager->read($image_tmp);
						$extension = $image_tmp->getClientOriginalExtension();
						$imageName = time().'.'.$extension;
						$image_path = 'front/assets/images/'.$imageName; 
						$image->save($image_path);
						$row->image2 = $imageName;
					}
			}
			
			
		
			$row->name = $data['name'];
			$row->description = $data['description'];
			$row->sort = $data['sort'];
			
			
			if(!empty($data['show_in_home'])){
				$row->show_in_home = 1;
			}else{
				$row->show_in_home = 0;
			}
			
			if(!empty($data['status'])){
				$row->status = 1;
			}else{
				$row->status = 0;
			}
			$row->save(); 
			return redirect('admin/metting-types')->with('success_message',$message);
		}
		return view('admin.meeting_types.add_edit_metting_type')->with(compact('title','row','prevId','nextId')); 
	}
	
}