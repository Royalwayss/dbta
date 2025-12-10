<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\MediaImage;
use App\Models\HomeMedia;
use App\Models\AdminsRole;
use Session;
class MediaController extends Controller
{
	public function media(){ 
		Session::put('page','media');
		$rows = Media::get();
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.media.media')->with(compact('rows','module'));    
	}
	
	public function addEditMedia(request $request,$id=null){
		
		if($id==""){
			$title = "Add Media";
			$row = new Media;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Media";
			$row = Media::with('media_images')->find($id);
			$model = 'Media'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'title' => 'required',
				'mediasort' => 'required',
				
			];
			$customMessages = [
				'event_title.required' => 'Enter the title',
				'mediasort.required' => 'Enter the sort',
				
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all(); 
			if(isset($data['id']) && $data['id']!=""){
				$row = Media::find($data['id']);
				$message = "Media updated successfully!";
			}else{
				$row = new Media;
				$message = "Media added successfully!";    
			}
			
			$row->title = $data['title'];
			$row->media_sort = $data['mediasort'];
			$row->save();
			
			$media_id = $row->id;
			
			
			if($request->hasFile('images')){
			  foreach($request->file('images') as $key=>$file){
					$image_tmp = $file;
					if($image_tmp->isValid()){
						$manager = new ImageManager(new Driver());
						$image = $manager->read($image_tmp);
						$extension = $image_tmp->getClientOriginalExtension();
						$imageName = time().''.rand(11,99).'.'.$extension;
						$image_path = 'front/images/media/'.$imageName; 
						$image->save($image_path);
						$media_image = new MediaImage;
						$media_image->file = $imageName;
						$media_image->media_id = $media_id;
						$media_image->media_sort = $data['media_sort'][$key];
						if(!empty($data['status'][$key])){
							$media_image->status = '1';
						}else{
							$media_image->status = '0';
						}
						$media_image->save();
					}
				}
			}
			
			
			if(isset($data['media_id']) && !empty($data['media_id'])){ 
				foreach($data['media_id'] as $mediaid){
					$media_image = MediaImage::find($mediaid); 
					$media_image->media_sort = $data['edit_media_sort_'.$mediaid];
					if(!empty($data['edit_status_'.$mediaid])){
						$media_status = '1';
					}else{
						$media_status = '0';
					}
					
					$media_image->status = $media_status; 
					$media_image->save();
				}
			}
			
			
			return redirect('admin/media')->with('success_message',$message);
		}
		return view('admin.media.add_edit_media')->with(compact('title','row','prevId','nextId')); 
	}
	
	
	public function deleteMedia(request $request,$id){
		MediaImage::where('id',$id)->delete();
		return true;
	}
	
	
	public function homeMedia(){ 
		Session::put('page','home-media');
		$images = HomeMedia::where('media_type','image')->orderby('sort','asc')->get()->toArray();  
		$videos = HomeMedia::where('media_type','video')->orderby('sort','asc')->get()->toArray();  
		$title = 'Home Media';
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.media.home-media')->with(compact('title','images','videos','module'));    
	}
	
	public function addEditHomeMedia(request $request){
		$data = $request->all();
		
		
		   if($request->hasFile('images')){
			  foreach($request->file('images') as $key=>$file){
					$image_tmp = $file;
					if($image_tmp->isValid()){
						$manager = new ImageManager(new Driver());
						$image = $manager->read($image_tmp);
						$extension = $image_tmp->getClientOriginalExtension();
						$imageName = time().''.rand(11,99).'.'.$extension;
						$image_path = 'front/images/home-media/'.$imageName; 
						$image->save($image_path);
						$media_image = new HomeMedia;
						$media_image->media_file = $imageName;
						$media_image->media_type = 'image';
						$media_image->sort = $data['media_sort'][$key];
						if(!empty($data['status'][$key])){
							$media_image->status = '1';
						}else{
							$media_image->status = '0';
						}
						$media_image->save();
					}
				}
			}
			
			
		if(!empty($data['media_id'])){
			foreach($data['media_id'] as $media_id){
				$media_image = HomeMedia::find($media_id);
				$media_image->sort = @$data['edit_media_sort_'.$media_id];
				$media_image->status = @$data['edit_status_'.$media_id]; 
				$media_image->save();
			}
		}			
			
		if(!empty($data['video_url'])){
			foreach($data['video_url'] as $key=>$video_url){
				if(!empty($video_url)){
					$add_video = new HomeMedia;
					$add_video->media_type = 'video';
					$add_video->media_file = $video_url;
					$add_video->sort = @$data['video_sort'][$key];
					$add_video->status = @$data['video_status'][$key];
					$add_video->save();
				}
			}
		}	
			
		
			
		if(!empty($data['video_id'])){
			foreach($data['video_id'] as $video_id){
				$edit_video = HomeMedia::find($video_id);
				$edit_video->sort = @$data['edit_video_sort_'.$video_id];
				$edit_video->status = @$data['edit_video_status_'.$video_id]; 
				$edit_video->save();
			}
		}			
				
			
			
			
		$message =  "Home Media has been updated successfully!";   
		return redirect('admin/home-media')->with('success_message',$message);
		
		
		
		
	}
	
	
	public function deleteHomeMedia(request $request,$id){
		HomeMedia::where('id',$id)->delete();
		return true;
	}
	
	
	
}