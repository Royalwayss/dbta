@extends('front.layout.layout')
<style>
.contact-info a{ color: #006090;    text-decoration: none; }
</style>
@section('content')
	<main>
		<section class="team-section  committes_wrap_sec">
			<div class="heading-one  mb-5"data-aos="fade-up">
				
				<h1 class="text-center">Executive Committee 2026-27</h1>
				<div class="underline mx-auto mt-2"></div>
			</div>
			<div class="container">
				<div class="row g-4 align-items-start"data-aos="fade-down">
					<div class="col-12">
						<div class="row g-4">
							@foreach($executive_body as $val)
							<div class="col-md-3 col-lg-3 col-sm-6">
								<div class="team-card text-center bg-white  rounded shadow-sm">
									<img src="{{ asset('front/images/executive-body/'.$val['image']) }}" alt="" class="img-fluid mb-3">
									<h6>{{ $val['name'] }}</h6>
									<p class="subheading text-center">{{ $val['destination'] }}</p>
									@if($val['phone'] != '')
									<p class="contact-info text-center"><i class="bi bi-telephone-fill"></i> <a href="tel:+{{ $val['phone'] }}">{{ $val['phone'] }}</a></p>
									@endif
									@if($val['email'] != '')
									<p class="contact-info text-center"><i class="bi bi-envelope-fill"></i> <a href="mailto:{{ $val['email'] }}">{{ $val['email'] }}</a></p>
								    @endif
								</div>
							</div>
                          @endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
   
  @endsection