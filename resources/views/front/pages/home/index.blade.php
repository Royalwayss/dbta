@extends('front.layout.layout')
@section('content')
<main>
   <section class="main_banner_sec">
      <div class="container-fluid ">
         <div class="row">
            <div class="col-lg-8 ">
               <div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                     @foreach($banners as $key => $banner)
                     <div class="carousel-item @if($key== 0) active @endif">
                        <img src="{{ asset('front/images/banners/'.$banner['image']) }}" class="d-block w-100" alt="Slide {{ $key+1 }}">
                        @if(!empty($banner['title']))
                        <div class="carousel-caption text-white">
                           {{ $banner['title'] }}
                        </div>
                        @endif
                     </div>
                     @endforeach
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider"
                     data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#mainSlider"
                     data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  </button>
               </div>
            </div>
            <div class="col-lg-4">
               <h4 class="events_heading4">Upcoming Events</h4>
               @if(!empty($events))
               <div class="swiper newsSwiper">
                  <div class="swiper-wrapper">
                     @foreach($events as $event)
                     <div class="swiper-slide event_box">
                        <div class="news-date">
                           <h5>📅 {{ date("d F Y", strtotime($event['event_date'])) }} @if(!empty($event['event_time'])) {{ get_time($event['event_time']) }} @endif</h5>
                        </div>
                        <div>
                           <p class="event_title">{{ $event['event_title'] }}</p>
                           @if(!empty($event['description']))
                           <p> @php echo $event['description'] @endphp</p>
                           @endif
                        </div>
                        <a  class="read-link" @if(!empty($event['event_file'])) target="_blank" href="{{ url('front/events/'.$event['event_file']) }}" @else href="javascript:;" @endif>View Details →</a>
                     </div>
                     @endforeach
                  </div>
               </div>
               @endif
            </div>
         </div>
      </div>
   </section>
   <section class="about_us_sec">
      <div class="container my-5">
         <div class="row about-wrapper">
            <div class="col-lg-6 col-12 about_us_left_side" data-aos="fade-right">
               <div class="about-left text-justify">
                  <h2 class="about-heading">About Us</h2>
                  <p>The District Taxation Bar Association, Direct Taxes, Ludhiana was established on 29.05.1981 and duly registered under Societies registration act, 1860 vide Registration no. 015 as a unified platform for tax professionals in the region. The association comprises Chartered Accountants, Advocates, Company Secretaries and qualified Income Tax Practitioners who are actively engaged in the practice of taxation law. With its head office situated at Bar Room, Aayakar Bhawan, Rishi Nagar, Ludhiana, the association has been formed with several key objectives: to promote up-to-date knowledge and comprehensive study of taxation law among members by organizing study circle meetings, seminars, and continuing education programs; to protect and safeguard the rights, interests, and privileges of members in their professional practice; to create a strong sense of fellowship and consolidate the bonds of brotherhood within the tax practitioner community; and to take a united stand on behalf of members when dealing with instances where departmental officials display a tendency to disregard professional courtesy or the legitimate rights of tax practitioners. Through these objectives, the association serves as an essential institution for fostering professional excellence and collective representation in the field of direct taxation.</p>
                  <div class="login_btn">
                     <a href="{{ route('aboutus') }}">Learn More</a>
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-12 about-image" data-aos="fade-left">
               <div class="experience-shape"></div>
               <img src="front/assets/images/ayakarBhawan.jpg" alt="Experience" class="experience-image">
            </div>
         </div>
      </div>
   </section>
   @if($publicnotice_count > 0)
   <section class="service-section section-services pt-0">
      <div class="container">
         <div class="row justify-content-center ">
            <div class="col-md-10 col-lg-8 text-center">
               <div class="header-section" data-aos="fade-up">
                  <h2 class="title about-heading">Public Notice</h2>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table class="table custom-table">
               <thead>
                  <tr>
                     <th style="width:15%">Date</th>
                     <th style="width:65%">Message</th>
                     <th style="width:20%"></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($publicnotices as $publicnotice)
                  <tr>
                     <td>{{ date("d-m-Y", strtotime($publicnotice['date'])) }}</td>
                     <td><?php echo wordwrap($publicnotice['message'],75,"<br>\n"); ?></td>
                     <td>
                        @if($publicnotice['file'] != '')
						    <a href="{{ asset('front/images/public-notice/'.$publicnotice['file']) }}" class="read-link" target="_blank">View Details →</a>
                        @else
							 -
						@endif
					 </td>
                     @endforeach
               </tbody>
            </table>
         </div>
         @if($publicnotice_count > 5)
         <div class="login_btn text-center">
            <a href="{{ route('public_notice') }}" >View All</a>
         </div>
         @endif
      </div>
   </section>
   @endif
   <section class="service-section section-services pt-0">
      <div class="container">
         <div class="row text-justify">
            <div class="col-md-4 col-lg-4 col-12">
               <div class="hover-img-wrapper" data-aos="fade-down">
                  <div class="service-card">
                     <h3 class="heading_three">President’s Message</h3>
                     <p class="description subheading"> It gives me immense pleasure to announce the launch of
                        the official website of the District Tax Bar
                        Association (DTBA). This long-awaited plaƞorm marks a significant milestone in our
                        ongoing
                        commitment to modernization, transparency, and improved communication within our
                        professional
                        community.
                     </p>
                     <div class="login_btn read-more">
                        <a href="{{ asset('front/pdf/home/president-message.pdf') }}" target="_blank">Read More<i class="fa-solid fa-arrow-right-long"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-lg-4 col-12">
               <div class="hover-img-wrapper" data-aos="fade-down">
                  <div class="service-card">
                     <h3 class="heading_three">Convenor’s Message</h3>
                     <p class="description subheading">It gives me great pleasure to welcome you to the new
                        website of District Tax Bar Association (Direct Taxes). As Convenor of the Website
                        Development Committee, it has been an exciting and rewarding journey to create this
                        platform for all of us and I am delighted to present this digital platform that has been
                        designed with your needs and convenience in mind.
                     </p>
                     <div class="login_btn read-more">
                        <a href="{{ asset('front/pdf/home/convenor-message.pdf') }}" target="_blank">Read More<i class="fa-solid fa-arrow-right-long"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-lg-4 col-12">
               <div class="hover-img-wrapper" data-aos="fade-down">
                  <div class="service-card">
                     <h3 class="heading_three">Secretary Message</h3>
                     <p class="description subheading">With great satisfaction, I am sharing here that our
                        Association has taken an important step
                        forward by introducing its official website. The development is part of our ongoing
                        effort to
                        strengthen internal systems, to bring greater discipline to our processes, and to ensure
                        that
                        relevant information reaches members in a timely and organised manner.
                     </p>
                     <div class="login_btn read-more">
                        <a href="{{ asset('front/pdf/home/secretary-message.pdf') }}" target="_blank">Read More<i class="fa-solid fa-arrow-right-long"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--@if(!empty($executive_body))-->
   <!--<section class="team-section  committes_wrap_sec">-->
   <!--	<div class="heading-one  mb-5" data-aos="fade-up">-->
   <!--		<h1 class="text-center">Executive body 2025</h1>-->
   <!--		<div class="underline mx-auto mt-2"></div>-->
   <!--	</div>-->
   <!--	<div class="container">-->
   <!--		<div class="gridBody" data-aos="fade-down">-->
   <!--			@foreach($executive_body as $val)-->
   <!--			<div class="team-card text-center bg-white  rounded shadow-sm">-->
   <!--				<img src="{{ asset('front/images/executive-body/'.$val['image']) }}" alt="" class="img-fluid mb-3">-->
   <!--				<h6>{{ $val['name'] }}</h6>-->
   <!--				<p class="subheading">{{ $val['destination'] }}</p>-->
   <!--			</div>-->
   <!--               @endforeach-->
   <!--		</div>-->
   <!--	</div>-->
   <!--</section>-->
   <!--@endif-->
   <section class="section-services">
      <div class="container">
         <div class="row justify-content-center text-center">
            <div class="col-md-10 col-lg-8">
               <div class="header-section" data-aos="fade-up">
                  <h2 class="title about-heading">What We Do</h2>
                  <p class="description subheading text-center">Our Services at the District Tax Bar Association</p>
               </div>
            </div>
         </div>
         <div class="row justify-content-center " data-aos="fade-down">
            <div class="col-md-6 col-lg-4">
               <div class="single-service">
                  <div class="content">
                     <span class="icon">
                     <i class="fab fa-battle-net"></i>
                     </span>
                     <h3 class="heading_three">Representation Before Tax Authorities</h3>
                     <p class="description subheading">Our Association represents collective issues of members before tax authorities, including assessment difficulties, procedural challenges etc.</p>
                  </div>
                  <span class="circle-before"></span>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="single-service">
                  <div class="content">
                     <span class="icon">
                     <i class="fab fa-asymmetrik"></i>
                     </span>
                     <h3 class="heading_three">Meeting with Income Tax Department</h3>
                     <p class="description subheading text-justify"> Our Association engages in regular dialogue with Income Tax Department authorities to address members’ issues and improve administrative processes.</p>
                  </div>
                  <span class="circle-before"></span>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="single-service">
                  <div class="content">
                     <span class="icon">
                     <i class="fab fa-artstation"></i>
                     </span>
                     <h3 class="heading_three">Monthly Newsletters & Circulars</h3>
                     <p class="description subheading text-justify">We circulate regular newsletters highlighting important tax updates and professional insights for our members.</p>
                  </div>
                  <span class="circle-before"></span>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="single-service">
                  <div class="content">
                     <span class="icon">
                     <i class="fab fa-500px"></i>
                     </span>
                     <h3 class="heading_three">Study Circles and Discussions Forums</h3>
                     <p class="description subheading text-justify">We host regular study circles and interactive discussion forums to promote knowledge sharing and professional updates among members.</p>
                  </div>
                  <span class="circle-before"></span>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="single-service">
                  <div class="content">
                     <span class="icon">
                     <i class="fas fa-chart-pie"></i>
                     </span>
                     <h3 class="heading_three">Sports and Cultural Events</h3>
                     <p class="description subheading text-justify">We organize sports and cultural events for members and their families to promote bonding, wellness, and community spirit.</p>
                  </div>
                  <span class="circle-before"></span>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="service-section section-services ">
      <div class="container">
         <div class="row justify-content-center text-center">
            <div class="col-lg-8 col-12 col-md-8">
               <div class="header-section" data-aos="fade-up">
                  <h2 class="title about-heading">Learning Offerings</h2>
                  <p class="description subheading"> High-quality curated learning offerings through multiple
                     formats on contemporary topics of professional importance.
                  </p>
               </div>
            </div>
         </div>
         <div class="row">
            @foreach($meeting_types as $meeting_type)
            <div class="col-md-4 col-lg-4 col-12 text-justify">
               <div class="hover-img-wrapper" data-aos="fade-down">
                  <img src="{{ asset('front/assets/images/'.$meeting_type['image1']) }}" alt="" title="img" class="hover-img">
                  <img src="{{ asset('front/assets/images/'.$meeting_type['image2']) }}" alt="" title="img" class="service-img">
                  <div class="service-card">
                     <h3 class="heading_three"><?php echo $meeting_type['name']; ?></h3>
                     <p class="description subheading"> 
                        <?php echo $meeting_type['description']; ?>
                     </p>
                     <div class="login_btn read-more">
                        <a href="{{ url($meeting_type['slug']) }}">Explore More<i class="fa-solid fa-arrow-right-long"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach  
         </div>
      </div>
   </section>
   <?php /*
      <section class="blogs_wrapper">
      	<div class="container">
      		<div class="row align-items-center">
      
      			<div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-left">
      				<h6 class="text-uppercase text-muted">Our events</h6>
      				<h2 class="title about-heading">What’s New at DTBA?</h2>
      				<p class="description subheading">
      					Stay updated with the latest news, articles, and insights from District Tax Bar Association.
      				</p>
      				<div class="login_btn">
      					<a href="#" class="mt-3">View All Posts</a>
      				</div>
      
      			</div>
      
      			<div class="col-lg-8" data-aos="fade-right">
      				<div class="owl-carousel owl-theme blog-carousel">
      
      
      					<div class="item">
      						<div class="card blog-card border-0 shadow-sm">
      							<img src="front/assets/images/blog1.jpg" class="card-img-top" alt="Blog Post Image">
      							<div class="card-body">
      								<h5 class="card-title">Tax Updates 2025</h5>
      								<small class="text-muted d-block mb-2">June 1, 2023</small>
      								<p class="card-text">We share timely updates on tax regulations, expert
      									articles, and professional insights tailored for members and practitioners.
      								</p>
      								<div class="login_btn">
      									<a href="#" class="mt-3">Read More</a>
      								</div>
      
      							</div>
      						</div>
      					</div>
      
      					<div class="item">
      						<div class="card blog-card border-0 shadow-sm">
      							<img src="front/assets/images/BLOG2.jpg" class="card-img-top" alt="Blog Post Image">
      							<div class="card-body">
      								<h5 class="card-title">DTBA Seminar Recap</h5>
      								<small class="text-muted d-block mb-2">June 1, 2023</small>
      								<p class="card-text">Explore key case studies, circulars, and legal
      									interpretations to enhance your knowledge.
      									Subscribe to receive curated updates straight to your inbox.</p>
      								<div class="login_btn">
      									<a href="#" class="mt-3">Read More</a>
      								</div>
      							</div>
      						</div>
      					</div>
      					<div class="item">
      						<div class="card blog-card border-0 shadow-sm">
      							<img src="front/assets/images/blog3.jpg" class="card-img-top" alt="Blog Post Image">
      							<div class="card-body">
      								<h5 class="card-title">Policy Changes Ahead</h5>
      								<small class="text-muted d-block mb-2">June 1, 2023</small>
      								<p class="card-text">We share timely updates on tax regulations, expert
      									articles, and professional insights tailored for members and practitioners.
      								</p>
      								<div class="login_btn">
      									<a href="#" class="mt-3">Read More</a>
      								</div>
      							</div>
      						</div>
      					</div>
      					<div class="item">
      						<div class="card blog-card border-0 shadow-sm">
      							<img src="front/assets/images/blog4.jpg" class="card-img-top" alt="Blog Post Image">
      							<div class="card-body">
      								<h5 class="card-title">Recent Legal Insights</h5>
      								<small class="text-muted d-block mb-2">June 1, 2023</small>
      								<p class="card-text">Explore key case studies, circulars, and legal
      									interpretations to enhance your knowledge.
      									Subscribe to receive curated updates straight to your inbox.</p>
      								<div class="login_btn">
      									<a href="#" class="mt-3">Read More</a>
      								</div>
      							</div>
      						</div>
      					</div>
      
      				</div>
      			</div>
      		</div>
      	</div>
      
      </section> 
      */ ?>
   <section class="service-section section-services">
      <div class="header-section justify-content-center text-center d-flex" data-aos="fade-up">
         <h2 class="title about-heading">Media and Gallery</h2>
      </div>
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-8 col-12 mb-4 mb-lg-0  gallery_image_wrap">
               <div class="image-slider">
                  @foreach($media_images as $media_image)
                  <div><img src="{{ asset('front/images/home-media/'.$media_image['media_file']) }}" class="img-fluid rounded-4" title="img" alt="img"></div>
                  @endforeach
               </div>
            </div>
            <div class="col-lg-4  col-12 video_image_wrap">
               <div class="video-slider">
                  @foreach($media_videos as $media_video)
                  <div class="position-relative">
                     <iframe width="420" height="315" src="{{ $media_video['media_file'] }}">
                     </iframe>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </section>
   <?php /*
      <section class="media_galery_wrapper our_sponser">
      	<div class="container">
      		<div class="mb-4 text-left" data-aos="fade-left">
      			<h2 class="about-heading">Our Sponsors</h2>
      			<div class="underline  mt-2"></div>
      		</div>
      		<div class="row">
      			<div class="col-lg-12" data-aos="fade-up">
      				<div class="owl-carousel owl-theme media-carousel">
      
      					<!-- Slide 1 -->
      					<div class="item">
      						<div class="blog-card adv_card">
      							<img src="front/assets/images/adv1.png" alt="Blog Post Image">
      
      						</div>
      						<div class="card_title_adv">
      							<h6>Trusted Sponsors of DTBA</h6>
      						</div>
      					</div>
      					<!-- Slide 2 -->
      					<div class="item">
      						<div class="blog-card adv_card">
      							<img src="front/assets/images/adv2.png" alt="Blog Post Image">
      
      						</div>
      						<div class="card_title_adv">
      							<h6>Trusted Sponsors of DTBA</h6>
      						</div>
      					</div>
      					<div class="item">
      						<div class="blog-card adv_card">
      							<img src="front/assets/images/adv3.png" alt="Blog Post Image">
      
      						</div>
      						<div class="card_title_adv">
      							<h6>Trusted Sponsors of DTBA</h6>
      						</div>
      					</div>
      					<div class="item">
      						<div class="blog-card adv_card">
      							<img src="front/assets/images/adv1.png" alt="Blog Post Image">
      
      						</div>
      						<div class="card_title_adv">
      							<h6>Trusted Sponsors of DTBA</h6>
      						</div>
      					</div>
      
      				</div>
      			</div>
      		</div>
      	</div>
      </section> 
      */ ?>
</main>
@endsection