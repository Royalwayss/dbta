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
									<img src="{{ asset('front/images/banners/'.$banner['image']) }}" class="d-block w-100" alt="Slide 1">
									<div class="carousel-caption text-white">
									{{ $banner['title'] }}
									</div>
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
										<h5>📅 {{ date("d F Y", strtotime($event['event_date'])); }}</h5>
									</div>
									<div>
										<p>{{ $event['event_title'] }}</p>
									</div>
									<a href="#" class="read-link">Read Full Story →</a>
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
						<div class="about-left">
							<div class="about-title">
								<p class="subheading">About Us</p>
							</div>
							<h2 class="about-heading">About Our Expertise And Excellence <br> In District Tax Bar
								Association</h2>
							<ul class="row about-points">
								<li class="col-md-6">Study Circle Committee members</li>
								<li class="col-md-6">Newsletters Committee members</li>
								<li class="col-md-6">Website Committee members</li>
								<li class="col-md-6">Media Committee members</li>
								<li class="col-md-6">Advisory Committee members</li>

							</ul>
							<div class="login_btn">
								<a href="#">Learn More</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12 about-image" data-aos="fade-left">
						<div class="experience-shape"></div>
						<img src="front/assets/images/about-us.jpg" alt="Experience" class="experience-image">
					</div>
				</div>
			</div>
		</section> 
		 <section class="section-services">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-md-10 col-lg-8"
						>
						<div class="header-section"data-aos="fade-up">
							<h2 class="title about-heading">What We Do</h2>
							<p class="description subheading">Our Services at the District Tax Bar Association</p>
						</div>
					</div>
				</div>
				<div class="row justify-content-center" data-aos="fade-down">
					<div class="col-md-6 col-lg-4"
						>
						<div class="single-service">
							<div class="content">
								<span class="icon">
									<i class="fab fa-battle-net"></i>
								</span>
								<h3 class="heading_three"> Representation Before Tax Authorities</h3>
								<p class="description subheading">Supporting members in appearing before Income Tax,
									GST, and other
									tax tribunals.</p>

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
								<h3 class="heading_three">Meeting with Income tax department</h3>
								<p class="description subheading">A formal meeting was held with the Income Tax
									Department to discuss key compliance updates, address member concerns, and
									strengthen professional coordination.</p>

							</div>
							<span class="circle-before"></span>
						</div>
					</div>

					<div class="col-md-6 col-lg-4"
						>
						<div class="single-service">
							<div class="content">
								<span class="icon">
									<i class="fab fa-artstation"></i>
								</span>
								<h3 class="heading_three">Monthly Newsletters & Circulars</h3>
								<p class="description subheading">Publishing timely legal amendments, tax judgments, and
									expert
									articles.</p>

							</div>
							<span class="circle-before"></span>
						</div>
					</div>

					<div class="col-md-6 col-lg-4"
						>
						<div class="single-service">
							<div class="content">
								<span class="icon">
									<i class="fab fa-500px"></i>
								</span>
								<h3 class="heading_three"> Study Circles & Discussion Forums</h3>
								<p class="description subheading">Facilitating knowledge sharing and peer learning among
									tax
									professionals.</p>

							</div>
							<span class="circle-before"></span>
						</div>
					</div>

					<div class="col-md-6 col-lg-4"
						>
						<div class="single-service">
							<div class="content">
								<span class="icon">
									<i class="fas fa-chart-pie"></i>
								</span>
								<h3 class="heading_three">Sports and cultural Events for members and there families</h3>
								<p class="description subheading">Organized sports and cultural events to promote
									bonding, relaxation, and active participation among members and their families.</p>

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
					<div class="col-lg-8 col-12 col-md-8" 
					>
						<div class="header-section"data-aos="fade-up">
							<h2 class="title about-heading">Learning Offerings</h2>
							<p class="description subheading"> High-quality curated learning offerings through multiple
								formats on contemporary topics of professional importance.</p>
						</div>
					</div>
				</div>
				<div class="row">
					@foreach($meeting_types as $meeting_type)
					<div class="col-md-4 col-lg-4 col-12" 
						>
						<div class="hover-img-wrapper" data-aos="fade-down">
							<img src="{{ asset('front/assets/images/'.$meeting_type['image1']) }}" title="img" alt="img" class="hover-img">
							<img src="{{ asset('front/assets/images/'.$meeting_type['image2']) }}" title="img" alt="img" class="service-img">
							<div class="service-card">
								<h3 class="heading_three">{{ $meeting_type['name'] }}</h3>
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

					<div class="col-lg-8"data-aos="fade-right">
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
		<section class="service-section section-services">
			<div class="header-section justify-content-center text-center d-flex" data-aos="fade-up">
				<h2 class="title about-heading">Media and Gallery</h2>
			</div>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-8 col-12 mb-4 mb-lg-0  gallery_image_wrap">
						<div class="image-slider">
							<div><img src="front/assets/images/gallery1.jpg" class="img-fluid rounded-4" alt="Image 1"></div>
							<div><img src="front/assets/images/gallery2.jpg" class="img-fluid rounded-4" alt="Image 2"></div>
						</div>
					</div>

					<div class="col-lg-4  col-12 video_image_wrap">
						<div class="video-slider">
							<div class="position-relative">
								<img src="front/assets/images/video1.jpg" class="img-fluid rounded-4" alt="Video 1">
								<a href="#" class="play-button"><i class="bi bi-play-fill"></i></a>
							</div>
							<div class="position-relative">
								<img src="front/assets/images/video2.jpg" class="img-fluid rounded-4" alt="Video 2">
								<a href="#" class="play-button"><i class="bi bi-play-fill"></i></a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section> 
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
	</main>
@endsection