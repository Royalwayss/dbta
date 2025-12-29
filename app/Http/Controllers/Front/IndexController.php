<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
use App\Models\Membership;
use App\Models\ExecutiveBody;
use App\Models\MembersDirectory;
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
	
	public function save_membership(Request $request){
		
		 
		
        if($request->ajax()){
			
			$validation_data = $request->all();
	 	   
            $validator = Validator::make($validation_data, [
                    'name' =>  'required',
					'parent_name' =>  'required',
                    'residence_address' =>  'required',
                    'office_address' =>  'required',
					
					'mobile'=>'required|numeric|digits:10',
					'email' => 'required|string|regex:/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i|max:255',
					'professional_area'=>'required',
					
					'kyc'=>'required|file|max:2000|mimes:pdf,jpg,png',
					'qualification_proof'=>'required|file|max:2000|mimes:pdf,jpg,png',
					'practice_certificate'=>'required|file|max:2000|mimes:pdf,jpg,png',
					'signature_of_applicant'=>'file|max:2000|mimes:pdf,jpg,png',
                ],
                [
                    'name1.required'=>'Enter the name.',
                    
                ]);
            if($validator->passes()) {
                $data = $request->all();
                //save Membership
                $membership = new Membership;
                $membership->name = $data['name']; 
                $membership->parent_name = $data['parent_name']; 
                $membership->residence_address = $data['residence_address']; 
                $membership->office_address = $data['office_address']; 
                $membership->phone_office = $data['phone_office']; 
                $membership->phone_residence = $data['phone_residence']; 
                $membership->mobile = $data['mobile']; 
                $membership->email = $data['email']; 
                $membership->professional_area = $data['professional_area']; 
                $membership->membership_no = $data['membership_no']; 
                $membership->fees_paid_amount = $data['fees_paid_amount']; 
                $membership->transaction_id = $data['transaction_id']; 
				if(!empty($data['date_of_payment'])){
                $membership->date_of_payment = $data['date_of_payment']; 
				}
                $membership->remarks = $data['remarks']; 
				
				$upload_files = [
				
				         'kyc'=>'kyc',
				         'qualification_proof'=>'qualification_proof',
				         'practice_certificate'=>'practice_certificate',
				         'signature_of_applicant'=>'signature_of_applicant',
				
				];
				
				foreach( $upload_files as $folder=>$file_name){
					    if($request->hasFile($file_name)) {
							$file = $request->file($file_name);       
							$originalname = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
							$extension = $file->getClientOriginalExtension();
							$allowed_extension = array('pdf','jpg','jped','png');
							if(in_array($extension, $allowed_extension)){
								$fileName = time()."". rand(1111,9999).".".$extension;
								$destinationPath = 'uploads/'.$folder.'/';
								$file->move($destinationPath, $fileName);
								$membership->$file_name = $fileName;
							}

						}
			    }
				
			
				
                $membership->save();
                if(env('MAIL_MODE') =="live"){
                    
                }
                return response()->json(['status'=>true,'message'=>'Message has been sent, we will contact you soon.']);
            }else{
                return response()->json(['status'=>false,'type'=>'validation','errors'=>$validator->messages()]);
            }
        }
    }
    
	
	public function members_directory (Request $request){
		 if($request->isMethod('post')){
			$data = $request->all();
			$members_directory = MembersDirectory::where('status',1);
			
			if(isset($data['keyword']) && !empty($data['keyword'])){
				$keyword = $data['keyword'];
				$members_directory = $members_directory->where(function ($query) use ($keyword) { 
					$query->orWhere("member_name","like","%".$keyword."%")
						  ->orWhere("designation_prefix","like","%".$keyword."%")
						  ->orWhere("role","like","%".$keyword."%")
						  ->orWhere("serial_no","like","%".$keyword."%");
						  
				});
			}
			
			$members_directory = $members_directory->orderby('sort','asc')->get()->toArray(); 
			$data['members_directory'] = $members_directory;
			$html = (String)View::make('front.pages.members_directory.members_directory_list',$data);
			return response()->json(['status'=>true,'html'=>$html]);
		}
		
		
		$meta = meta(Route::currentRouteName());
        $members_directory = MembersDirectory::where('status',1)->orderby('sort','asc')->get()->toArray(); 
        return view('front.pages.members_directory.members_directory')->with(compact('meta','members_directory'));
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
