@extends('front.layout.layout')
@section('content')
<main>
		<!-- <section class="contact_us_wrapper_sec">
			<div class="heading-one d-flex align-items-center justify-content-center h-100">
				<h1>About Us</h1>
			</div>
		</section> -->
		<section class="list_committes_wrap_sec">
			<div class="heading-one heading_one_dtba"data-aos="fade-up">
			<h1 class="text-center img-text">About Us</h1>
				<div class="underline mx-auto mt-2"></div>
			</div>
		</section>
		<section class="about_us_sec">
		<div class="container my-5">
			<div class="row about-wrapper">
				<div class="col-lg-6 col-12 about_us_left_side" data-aos="fade-right">
					<div class="about-left">
						<h2 class="about-heading">About Us</h2>
						<p>The District Tax Bar Association, Direct Taxes, Ludhiana was established on 29.05.1981 as a
							unified platform for tax professionals in the region. The association comprises Chartered
							Accountants, Advocates, and qualified Income Tax Practitioners who are actively engaged in
							the practice of taxation law. With its head office situated at Bar Room, Aayakar Bhawan,
							Rishi Nagar, Ludhiana, the association has been formed with several key objectives: to
							promote up-to-date knowledge and comprehensive study of taxation law among members by
							organizing study circle meetings, seminars, and continuing education programs; to protect
							and safeguard the rights, interests, and privileges of members in their professional
							practice; to create a strong sense of fellowship and consolidate the bonds of brotherhood
							within the tax practitioner community; and to take a united stand on behalf of members when
							dealing with instances where departmental officials display a tendency to disregard
							professional courtesy or the legitimate rights of tax practitioners. Through these
							objectives, the association serves as an essential institution for fostering professional
							excellence and collective representation in the field of direct taxation.</p>
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
		
		<section class="mission-vision-section">
			<div class="container">
				<div class="text-center mb-5"data-aos="fade-up"
					>
					<h2 class="about-heading">Our Mission & Vision</h2>
					<div class="underline mx-auto mt-2"></div>
				</div>
				<div class="row align-items-center h-100 ">
					<div class="col-lg-6 col-12 "
						>
						<div class="our_mission_wrapper d-flex align-items-center"data-aos="fade-right">
							<img src="front/assets/images/missiom.jpg" alt="Mission" class="circle-img">
							<div>
								<h4 class="fw-bold">Our Mission</h4>
								<p>This slide is 100% editable. Adapt it to your needs and capture your audience's
									attention.
								</p>
							</div>
						</div>

					</div>
				<div class="col-lg-6 col-12 "
						>
						<div class="our_mission_wrapper d-flex align-items-center"data-aos="fade-left" >
							<img src="front/assets/images/vison.jpg" alt="Mission" class="circle-img">
							<div>
								<h4 class="fw-bold">Our Vision</h4>
								<p>This slide is 100% editable. Adapt it to your needs and capture your audience's
									attention.
								</p>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>

	</main>
  
@endsection