<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subscriber;
use App\Models\Banner;
use App\Models\Committee;
use App\Models\Meeting;
use App\Models\MeetingType;
use App\Models\Newsletter;
use App\Models\Event;
use App\Models\Downloads;
use App\Models\Media;
use App\Models\CaseLaw;
use App\Models\Contact;
use App\Models\ExecutiveBody;
use App\Models\HomeMedia;
use App\Models\Visitor;
use App\Models\Mails;
use Validator;
use App\Services\Front\HomeWidgetService;

class IndexController extends Controller
{

    
    public function comingSoon(){
        return view('front.pages.website_under_construction.coming_soon');
    }
   
    public function index(){ 
	    $meta = meta(Route::currentRouteName());
        $this->checkVistor();	
        $banners =Banner::where('status','1')->orderby('sort','asc')->get()->toArray(); 
		$events = Event::where('status','1')->where('event_date','>',date('Y-m-d'))->orderby('event_sort','asc')->get()->toArray(); 
		$meeting_types = MeetingType::where('status',1)->orderby('sort','asc')->get()->toArray(); 
		$executive_body = ExecutiveBody::where('show_on_home',1)->where('status',1)->orderby('sort','asc')->get()->toArray(); 
		$media_images = HomeMedia::where('status',1)->where('media_type','image')->orderby('sort','asc')->get()->toArray();  
		$media_videos = HomeMedia::where('status',1)->where('media_type','video')->orderby('sort','asc')->get()->toArray(); 
		
		return view('front.pages.home.index')->with(compact('banners','meeting_types','events','executive_body','media_images','media_videos'));
    }

    
	public function aboutus (){
		$meta = meta(Route::currentRouteName());
        return view('front.pages.aboutus.about_us')->with(compact('meta'));
    }
	
	public function executive (){
		$meta = meta(Route::currentRouteName());
        $executive_body = ExecutiveBody::where('status',1)->orderby('sort','asc')->get()->toArray(); 
        return view('front.pages.aboutus.executive')->with(compact('meta','executive_body'));
    }
	
	
	public function meeting(request $request){
		$meta = meta(Route::currentRouteName()); 
        $seo = Route::getFacadeRoot()->current()->uri(); 
		$meetings = Meeting::where('meeting_type',$seo)->where('status',1)->orderby('meeting_sort','asc')->get()->toArray(); 
        $meeting_type = MeetingType::where('slug',$seo)->first();
		return view('front.pages.meeting.meeting')->with(compact('meta','seo','meetings','meeting_type'));
    }

    public function committes (){
		$meta = meta(Route::currentRouteName());
        $committees = Committee::with('active_committee_members')->where('status',1)->orderby('sort','asc')->get()->toArray();  
        return view('front.pages.aboutus.committes')->with(compact('meta','committees')); 
    }
	
	 public function newsletter (){
		$meta = meta(Route::currentRouteName());
		$newsletters =Newsletter::where('status',1)->orderby('newsletter_sort','asc')->get()->toArray();
        return view('front.pages.newsletter.newsletter')->with(compact('meta','newsletters'));
    }
	
	 public function new_membership (){
		$meta = meta(Route::currentRouteName());
        $meta_description = "";
        $meta_keyword = ""; 
        return view('front.pages.membership.new_membership')->with(compact('meta'));
    }
	
	public function contactus (){
		$meta = meta(Route::currentRouteName());
        $meta_description = "";
        $meta_keyword = ""; 
        return view('front.pages.contactus.contact-us')->with(compact('meta'));
    }
	
	public function save_contact(Request $request){
		
		 
		
        if($request->ajax()){
			$validation_data = $request->all();
	 	   
            $validator = Validator::make($validation_data, [
                    'name' =>  'required|regex:/^[a-zA-Z]+$/u|max:255',
                    'email' => 'required|string|regex:/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i|max:255',
					'mobile'=>'required|numeric|digits:10',
					'subject'=>'required',
                    'message' => 'bail|required'
                ],
                [
                    'name.required'=>'Enter the name.',
                    'email.required'=>'Enter the email address.',
                    'email.regex'=>'This email is not a valid email address',
                    'mobile.required'=>'Enter the mobile number.',
                    'mobile.numeric'=>'Enter the 10 digit valid mobile number.',
                    'mobile.digits'=>'Enter the 10 digit valid mobile number.',
					'subject.required'=>'Enter the subject.',
					'message.required'=>'Enter the message.',
                ]);
            if($validator->passes()) {
                $data = $request->all();
                //save Contact
                $contact = new Contact;
                $contact->name = $data['name']; 
                $contact->email = $data['email']; 
                $contact->mobile = $data['mobile'];
                $contact->subject = $data['subject']; 
                $contact->message = $data['message']; 
                $contact->save();
                if(env('MAIL_MODE') =="live"){
                    
                }
                return response()->json(['status'=>true,'message'=>'Message has been sent, we will contact you soon.']);
            }else{
                return response()->json(['status'=>false,'type'=>'validation','errors'=>$validator->messages()]);
            }
        }
    }
    
	
	public function downloads (){
		$meta = meta(Route::currentRouteName());
        $downloads =Downloads::where('status',1)->orderby('pdf_sort','asc')->get()->toArray();
        return view('front.pages.downloads.downloads')->with(compact('meta','downloads'));
    } 
	
	public function media (){
		$meta = meta(Route::currentRouteName());
        $media = Media::with('active_media_images')->where('status',1)->orderby('media_sort','asc')->get()->toArray();
        return view('front.pages.media.media')->with(compact('meta','media'));
    } 
	
	public function case_laws (){
		$meta = meta(Route::currentRouteName());
        $case_laws = CaseLaw::where('status',1)->orderby('sort','asc')->get()->toArray(); 
        return view('front.pages.case_laws.case_laws')->with(compact('meta','case_laws'));
    } 
	
	
	 public function checkVistor() {
        $ip = $_SERVER['REMOTE_ADDR']; 
        $checkVisitor = Visitor::where('user_ip',$ip)->count();
        if(empty($checkVisitor)){
            $user_ip_address_info = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
			$visitor = new Visitor;
			if(!empty($user_ip_address_info)){
				$user_ip_address_info_array = [];
				foreach($user_ip_address_info as $key=>$info){
					$user_ip_address_info_array[$key] = $info;
				}
				$visitor->user_info = json_encode($user_ip_address_info_array);
			}
			
			
            $visitor->user_ip  = $ip;
            $visitor->visit_date = date('Y-m-d');
            $visitor->save();
        }
      }

}
