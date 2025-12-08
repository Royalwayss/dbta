<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\SearchResult;
use App\Models\AdminsRole;
use App\Models\Subscriber;
use App\Models\Contact;
use Session;
use Auth;

class UserController extends Controller
{
    
	public function contacts(){ 
		Session::put('page','contacts');
		$rows = Contact::get();
		$module['view_access'] = 1;
		$module['edit_access'] = 1;
		$module['full_access'] = 1; 
		return view('admin.contacts.contacts')->with(compact('rows','module'));    
	}
	
	public function viewContact($id){  
	  $contact = Contact::where('id',$id)->firstOrFail();
	  if($contact['view_status'] == '0'){ 
	     Contact::where('id',$id)->update(['view_status'=>1]);
	  }
	  return view('admin.contacts.view_contact')->with(compact('contact'));  
	}
	
   

}
