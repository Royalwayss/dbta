<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\AdminsRole;
use Session;
class EventsController extends Controller
{
	public function events(){ 
		Session::put('page','events');
		$events = Event::get();
		$eventsModule['view_access'] = 1;
		$eventsModule['edit_access'] = 1;
		$eventsModule['full_access'] = 1; 
		return view('admin.events.events')->with(compact('events','eventsModule'));    
	}
	
	public function addEditEvent(request $request,$id=null){
		
		if($id==""){
			$title = "Add Event";
			$row = new Event;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Event";
			$row = Event::find($id);
			$model = 'Event'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'event_title' => 'required',
				'event_slug' => 'required',
				'description' => 'required',
				'event_date' => 'required',
				'meta_title' => 'required',
				'meta_description' => 'required',
				'meta_keywords' => 'required',
				'event_sort' => 'required',
			];
			$customMessages = [
				'event_title.required' => 'Enter the event title',
				'event_slug.required' => 'Enter the event slug',
				'description.required' => 'Enter the event description',
				'event_date.required' => 'Enter the event date',
				'meta_title.required' => 'Enter the meta tilte',
				'meta_description.required' => 'Enter the meta description',
				'meta_keywords.required' => 'Enter the meta keywords',
				'event_sort.required' => 'Enter the event sort',
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all();
			if(isset($data['id']) && $data['id']!=""){
				$row = Event::find($data['id']);
				$message = "Event updated successfully!";
			}else{
				$row = new Event;
				$message = "Event added successfully!";    
			}
			
			if($request->hasFile('image')){
				$image_tmp = $request->file('image');
				if($image_tmp->isValid()){
					$manager = new ImageManager(new Driver());
					$image = $manager->read($image_tmp);
					$extension = $image_tmp->getClientOriginalExtension();
					$imageName = time().''.rand(11,99).'.'.$extension;
					$image_path = 'front/images/events/'.$imageName; 
					$image->save($image_path);
					$row->image = $imageName;
				}
			}
			
			$row->event_title = $data['event_title'];
			$row->event_slug = $data['event_slug'];
			$row->description = $data['description'];
			$row->event_date = $data['event_date'];
			$row->meta_title = $data['meta_title'];
			$row->meta_description = $data['meta_description'];
			$row->meta_keywords = $data['meta_keywords'];
			$row->event_sort = $data['event_sort'];
			if(!empty($data['status'])){
				$row->status = '1';
			}else{
				$row->status = '0';
			}
			$row->save();
			return redirect('admin/events')->with('success_message',$message);
		}
		return view('admin.events.add_edit_event')->with(compact('title','row','prevId','nextId')); 
	}
}