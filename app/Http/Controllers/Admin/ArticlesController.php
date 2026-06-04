<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\AdminsRole;
use Session;
class ArticlesController extends Controller
{
	public function articles(){ 
		Session::put('page','articles');
		$rows = Article::get(); 
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.articles.articles')->with(compact('rows','module'));    
	}
	
	public function addEditArticle(request $request,$id=null){
		
		if($id==""){
			$title = "Add Article";
			$row = new Article;
			$prevId = 0; 
			$nextId = 0;
		}else{
			$title = "Edit Article";
			$row = Article::find($id);
			$model = 'Article'; 
			$prevId = findPreviousId($id, $model); 
			$nextId = findNextId($id, $model);  
		}
		
		if($request->isMethod('post')){
			
			$rules = [
				'month' => 'required',
				'sort' => 'required',
				
			];
			$customMessages = [
				'month.required' => 'Enter the month',
				'sort.required' => 'Enter the sort',
			];
			
			$this->validate($request,$rules,$customMessages);
			
			$data = $request->all();  
			if(isset($data['id']) && $data['id']!=""){
				$row = Article::find($data['id']);
				$message = "Article updated successfully!";
			}else{
				$row = new Article;
				$message = "Article added successfully!";    
			}
	          
			 if($request->hasFile('pdf')) {
				$file = $request->file('pdf');       
				$extension = $file->getClientOriginalExtension();
				$allowed_extension = array('pdf','PDF');
				if(in_array($extension, $allowed_extension)){
					$file_name = time().''.rand(100,999).'.'.$extension; 
					$destinationPath = 'front/pdf/articles/';
					$file->move($destinationPath, $file_name);
					$row->pdf = $file_name; 
				}

			}
			
		
			$row->month = $data['month']; 
		
			$row->sort = $data['sort'];
			if(!empty($data['status'])){
				$row->status = 1;
			}else{
				$row->status = 0;
			}
			$row->save();
			return redirect('admin/articles')->with('success_message',$message);
		}
		return view('admin.articles.add_edit_article')->with(compact('title','row','prevId','nextId')); 
	}
}