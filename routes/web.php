<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\MettingController;
use App\Http\Controllers\Admin\NewslettersController;
use App\Http\Controllers\Admin\DownloadsController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\CommitteesController;
use App\Http\Controllers\Admin\CaselawsController;
use App\Http\Controllers\Admin\ExecutivebodyController;
use App\Http\Controllers\Admin\UserController;


use App\Http\Controllers\Front\IndexController;


/*Route::get('/', function () {
    return view('welcome');
});*/

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::get('login',[AdminController::class,'login']);
    Route::match(['get','post'],'login/request',[AdminController::class,'loginRequest']);
    Route::group(['middleware'=>['admin']],function(){
        Route::match(['get','post'],'dashboard',[AdminController::class,'dashboard']);
        Route::get('update-password',[AdminController::class,'updatePassword']);
        Route::post('update-password/request',[AdminController::class,'updatePasswordRequest']);
        Route::post('current-password/verify',[AdminController::class,'currentPasswordVerify']);
        Route::get('update-details',[AdminController::class,'updateDetails']);
        Route::post('update-details/request',[AdminController::class,'updateDetailsRequest']);
		 Route::post('update-status',[AdminController::class,'updateStatus']);
        Route::get('logout',[AdminController::class,'logout']);

        //banners
		Route::get('banners',[BannerController::class,'banners']);
		Route::get('add-edit-banner/{id?}',[BannerController::class,'addEditBanner']);
		Route::post('add-edit-banner/{id?}',[BannerController::class,'addEditBannerRequest']);
		Route::get('delete-banner/{id}',[BannerController::class,'deleteBanner']);
		// CMS Pages
        Route::get('cms-pages',[CmsController::class,'index']);
        Route::post('update-cms-page-status',[CmsController::class,'update']);
        Route::match(['get','post'],'add-edit-cms-page/{id?}',[CmsController::class,'edit']);
        Route::get('delete-cms-page/{id}','CmsController@destroy');

        // Sub-Admins
        Route::get('subadmins',[AdminController::class,'subadmins']);
        Route::post('update-subadmin-status',[AdminController::class,'updateSubadminStatus']);
        Route::get('delete-subadmin/{id}',[AdminController::class,'deleteSubadmin']);
        Route::get('add-edit-subadmin/{id?}',[AdminController::class,'addEditSubadmin']);
        Route::post('add-edit-subadmin/request',[AdminController::class,'addEditSubadminRequest']);
        Route::get('/update-role/{id}',[AdminController::class,'updateRole']);
        Route::post('/update-role/request',[AdminController::class,'updateRoleRequest']);
        Route::match(['get','post'],'website-settings',[AdminController::class,'websiteSettings']);
        Route::match(['get','post'],'save-website-settings',[AdminController::class,'saveWebsiteSettings']);

        // Events
        Route::get('events',[EventsController::class,'events']);
        Route::match(['get','post'],'add-edit-event/{id?}',[EventsController::class,'addEditEvent']);
        
	   
	   // Meeting
        Route::get('meetings',[MettingController::class,'meeting']);
        Route::match(['get','post'],'add-edit-meeting/{id?}',[MettingController::class,'addEditMeeting']);
        Route::get('delete-meeting-image/{id}',[MettingController::class,'deleteMeetingImage']);
       
	    // Newsletters
        Route::get('newsletters',[NewslettersController::class,'newsletters']);
        Route::match(['get','post'],'add-edit-newsletter/{id?}',[NewslettersController::class,'addEditNewsletter']);
	   
	   // Downloads
        Route::get('downloads',[DownloadsController::class,'downloads']);
        Route::match(['get','post'],'add-edit-download/{id?}',[DownloadsController::class,'addEditDownload']);
	   
	   
	    // Media
        Route::get('media',[MediaController::class,'media']);
        Route::match(['get','post'],'add-edit-media/{id?}',[MediaController::class,'addEditMedia']);
        Route::get('delete-media/{id}',[MediaController::class,'deleteMedia']);
        Route::get('home-media',[MediaController::class,'homeMedia']);
        Route::post('add-edit-home-media',[MediaController::class,'addEditHomeMedia']);
        Route::get('delete-home-media/{id}',[MediaController::class,'deleteHomeMedia']);
		
	   
        //Committees
        Route::get('committees',[CommitteesController::class,'committees']);
        Route::match(['get','post'],'add-edit-committee/{id?}',[CommitteesController::class,'addEditMedia']);
        Route::get('delete-member/{id}',[CommitteesController::class,'deleteMember']);
		
       
        
         // case-laws
        Route::get('case-laws',[CaselawsController::class,'caselaws']);
        Route::match(['get','post'],'add-edit-case-law/{id?}',[CaselawsController::class,'addEditCaselaw']);
	   
        //executive-body
		
		Route::get('executive-body',[ExecutivebodyController::class,'executivebody']);
        Route::match(['get','post'],'add-edit-executive-body/{id?}',[ExecutivebodyController::class,'addEditexecutiveBody']);
        
		
	   //contacts
        Route::get('contacts',[UserController::class,'contacts']);
        Route::get('view-contact/{id}',[UserController::class,'viewContact']);
    });
});

Route::namespace('App\Http\Controllers\Front')->group(function(){
    
   
    //Route::get('/', [IndexController::class,'comingSoon'])->name('comingSoon');
    Route::get('/', [IndexController::class,'index'])->name('home');
    Route::get('about-us', [IndexController::class,'aboutus'])->name('aboutus');
    Route::get('executive-body-2025', [IndexController::class,'executive'])->name('executive');
    Route::get('list-of-dtba-committees', [IndexController::class,'committes'])->name('committes');
    Route::get('newsletter-and-publications', [IndexController::class,'newsletter'])->name('newsletter');
    Route::get('new-membership', [IndexController::class,'new_membership'])->name('new_membership');
    Route::get('contact-us', [IndexController::class,'contactus'])->name('contactus');
    Route::post('save-contact', [IndexController::class,'save_contact'])->name('save_contact');
    Route::get('downloads', [IndexController::class,'downloads'])->name('downloads');
    Route::get('media', [IndexController::class,'media'])->name('media');
    Route::get('case-laws', [IndexController::class,'case_laws'])->name('case_laws');
    $meeting_types = meeting_types();
	foreach($meeting_types as $meeting_type){
      Route::get($meeting_type['slug'], [IndexController::class,'meeting'])->name('meeting');
	}
   
   
    

    Route::group(['middleware' => ['auth','preventBackHistory']], function () {

       
    });

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home1');
