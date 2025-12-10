@extends('front.layout.layout')
@section('content')
	<main>
		<section class="team-section  committes_wrap_sec">
			<div class="heading-one  mb-5"data-aos="fade-up">
				
				<h1 class="text-center">Executive Committee 2025</h1>
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
									<p class="subheading">{{ $val['destination'] }}</p>
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