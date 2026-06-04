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
use App\Models\DepartmentOfficer;
use App\Models\Article;
use App\Models\Event;
use App\Models\Downloads;
use App\Models\Media;
use App\Models\CaseLaw;
use App\Models\CaseLawSection;
use App\Models\Contact;
use App\Models\Membership;
use App\Models\ExecutiveBody;
use App\Models\MembersDirectory;
use App\Models\HomeMedia;
use App\Models\PublicNotice;
use App\Models\Visitor;
use App\Models\Mails;
use Validator;
use Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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
        $publicnotice_count =PublicNotice::where('status','1')->count(); 
        $publicnotices =PublicNotice::where('status','1')->orderby('sort','asc')->limit(5)->get()->toArray(); 
		$events = Event::where('status','1')->where('event_date','>=',date('Y-m-d'))->orderby('event_sort','asc')->get()->toArray(); 
		$meeting_types = MeetingType::where('status',1)->where('show_in_home','1')->orderby('sort','asc')->get()->toArray(); 
		$executive_body = ExecutiveBody::where('show_on_home',1)->where('status',1)->orderby('sort','asc')->get()->toArray(); 
		$media_images = HomeMedia::where('status',1)->where('media_type','image')->orderby('sort','asc')->get()->toArray();  
		$media_videos = HomeMedia::where('status',1)->where('media_type','video')->orderby('sort','asc')->get()->toArray(); 
		
		if(Session::has('tax_feeds')){
			$tax_feeds = Session::get('tax_feeds'); 
		}else{
			$tax_feeds = [
					'1' => $this->fetchtaxFeedsData('https://wmstatic-prd.incometaxindia.gov.in/press-release-rss-feed/-/asset_publisher/bxhj/rss'),
					'2' => $this->fetchtaxFeedsData('https://wmstatic-prd.incometaxindia.gov.in/circular-rss-feed/-/asset_publisher/bxhj/rss'),
					'3' => $this->fetchtaxFeedsData('https://wmstatic-prd.incometaxindia.gov.in/notification-rss-feed/-/asset_publisher/bxhj/rss'),
			];
			$tax_feeds = json_decode(json_encode($tax_feeds),true);
			
			Session::put('tax_feeds',$tax_feeds); 
			
		}
		$tax_feeds = array_filter($tax_feeds);
		
		return view('front.pages.home.index')->with(compact('banners','meeting_types','publicnotices','publicnotice_count','events','executive_body','media_images','media_videos','tax_feeds'));
    }
    public function fetchtaxFeedsData($url){
				$rss_url = urlencode($url);
				$api_url = 'https://api.rss2json.com/v1/api.json?rss_url=' . $rss_url;

				$ch = curl_init($api_url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				$response = curl_exec($ch);
				curl_close($ch);

				$data = json_decode($response, true); 
				if ($data && $data['status'] === 'ok') {
					$data = json_decode(json_encode($data),true);
				return $data;
			} else {
				return [];
			}
	}

    
	public function aboutus (){
		$meta = meta(Route::currentRouteName());
        return view('front.pages.aboutus.about_us')->with(compact('meta'));
    }
	
	public function public_notice (){
		$meta = meta(Route::currentRouteName());
		$publicnotices =PublicNotice::where('status','1')->orderby('sort','asc')->get()->toArray();
        return view('front.pages.public-notice.public-notice')->with(compact('meta','publicnotices'));
    }  
	
	public function executive(){
		$meta = meta(Route::currentRouteName());
        $executive_body = ExecutiveBody::where('status',1)->orderby('sort','asc')->get()->toArray(); 
        return view('front.pages.aboutus.executive')->with(compact('meta','executive_body'));
    }
	
	
	public function meeting(request $request){
		$meta = meta(Route::currentRouteName()); 
        $seo = Route::getFacadeRoot()->current()->uri(); 
		$meetings = Meeting::where('meeting_type',$seo)->where('status',1)->orderby('meeting_sort','asc')
		            ->simplePaginate(4); 
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
		$articles =Article::where('status',1)->orderby('sort','asc')->get()->toArray();
        return view('front.pages.newsletter.newsletter')->with(compact('meta','newsletters','articles'));
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
        $caselaw_sections = CaseLawSection::with('active_pdf_files')->where('status',1)->orderby('sort','asc')->get()->toArray(); 
        return view('front.pages.case_laws.case_laws')->with(compact('meta','caselaw_sections'));
    } 
	
	
	public function department_officers (){
		$meta = meta(Route::currentRouteName());
        $department_officers =DepartmentOfficer::where('status',1)->orderby('pdf_sort','asc')->get()->toArray();
        return view('front.pages.department_officers.department_officers')->with(compact('meta','department_officers'));
    }  
	
	public function save_membership(Request $request){
		
		 
		
        if($request->ajax()){
			
			$validation_data = $request->all();
	 	   
				$validator = Validator::make($validation_data, [
				'name' => 'required',
				'parent_name' => 'required',
				'residence_address' => 'required',
				'office_address' => 'required',

				'mobile' => 'required|numeric|digits:10',
				'email' => 'required|string|regex:/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i|max:255',

				'professional_area' => 'required',
				'aadhaar_no' => 'regex:/^[2-9][0-9]{11}$/',
				'pan_no'     => 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',


				'kyc' => 'required|file|max:2000|mimes:pdf,jpg,png',
				'qualification_proof' => 'required|file|max:2000|mimes:pdf,jpg,png',
				'practice_certificate' => 'required|file|max:2000|mimes:pdf,jpg,png',
				'signature_of_applicant' => 'nullable|file|max:2000|mimes:pdf,jpg,png',
				'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
			   ], [

				'name.required' => 'Please enter your full name.',
				'parent_name.required' => 'Please enter father\'s/mother\'s name.',

				'residence_address.required' => 'Please enter your residential address.',
				'office_address.required' => 'Please enter your office address.',

				'mobile.required' => 'Please enter your mobile number.',
				'mobile.numeric' => 'Mobile number must contain only digits.',
				'mobile.digits' => 'Mobile number must be exactly 10 digits.',

				'email.required' => 'Please enter your email address.',
				'email.regex' => 'Please enter a valid email address.',
				'email.max' => 'Email address may not be greater than 255 characters.',

				'professional_area.required' => 'Please select your professional area.',
				'aadhaar_no.regex' => 'Please enter a valid Aadhaar number.',
                'pan_no.regex'     => 'Please enter a valid PAN number.',

				'kyc.required' => 'Please upload a KYC document.',
				'kyc.mimes' => 'KYC document must be a PDF, JPG, or PNG file.',
				'kyc.max' => 'KYC document size must not exceed 2 MB.',

				'qualification_proof.required' => 'Please upload proof of qualification.',
				'qualification_proof.mimes' => 'Qualification proof must be a PDF, JPG, or PNG file.',
				'qualification_proof.max' => 'Qualification proof size must not exceed 2 MB.',

				'practice_certificate.required' => 'Please upload a practice certificate.',
				'practice_certificate.mimes' => 'Practice certificate must be a PDF, JPG, or PNG file.',
				'practice_certificate.max' => 'Practice certificate size must not exceed 2 MB.',

				'signature_of_applicant.mimes' => 'Signature file must be a PDF, JPG, or PNG file.',
				'signature_of_applicant.max' => 'Signature file size must not exceed 2 MB.',
				
				'photo.required' => 'Please upload your passport size photograph.',
				'photo.image' => 'The photo must be an image file.',
				'photo.mimes' => 'The photo must be in JPG, JPEG, or PNG format.',
				'photo.max' => 'The photo size must not exceed 2 MB.',
				
				
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
                $membership->aadhaar_no = $data['aadhaar_no']; 
                $membership->pan_no = $data['pan_no']; 
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
						 'photo' => 'photo'
				
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
				
				 $url = route('view_membership');
				 Session::put('membership_form_id',$membership->id);
				
                return response()->json(['status'=>true,'url'=>$url,'message'=>'Message has been sent, we will contact you soon.']);
            }else{
                return response()->json(['status'=>false,'type'=>'validation','errors'=>$validator->messages()]);
            }
        }
    }
    
	
	public function view_membership  (Request $request){
		if(Session::has('membership_form_id')){
			$membership_form_id = Session::get('membership_form_id');
			  $data = $request->all(); 
			  if(!isset($data['download'])){
				  $meta = meta(Route::currentRouteName());
				  
				  $type = 'view';
				  $membership = Membership::where('id',$membership_form_id)->firstorfail();
				  return view('front.pages.membership.view-membership')->with(compact('meta','membership','type'));
			  }else{
			 	
			  $membership = Membership::where('id',$membership_form_id)->first(); 
			 $type = 'download';
			 $pdf = Pdf::loadView('front.pages.membership.view-membership',[
					'type' => $type,
					'membership' => $membership,
					'date'   => now()->format('d/m/Y'),
					])
					->setPaper('a4', 'portrait')
					->setOptions([
						'defaultFont'       => 'sans-serif',
						'isRemoteEnabled'   => true,
						'isHtml5ParserEnabled' => true,
						'dpi'               => 150,
					]);

				return $pdf->download('DTBA-Membership-Form.pdf');
			 
			  }
		}else{
			abort(404);
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
						  ->orWhere("serial_no",$keyword);
						  
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
