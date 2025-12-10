@extends('front.layout.layout')
@section('content')
<main>
		<section class="list_committes_wrap_sec">
			<div class="heading-one heading_one_dtba"data-aos="fade-up">
			<h1 class="text-center img-text">DTBA Committees </h1>
				<div class="underline mx-auto mt-2"></div>
			</div>
		</section>
		<section id="vertical-tab">
			<div class="container-fluid ">
				<div class="vertical-tab-wrapper">
					<div class="row justify-content-between">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-3"data-aos="fade-left">
							<div class="vertical-tab">
								@foreach($committees as $key=>$committee)
								<div class="each-tab @if($key == 0) active @endif" data-target="#Tab{{ $key+1 }}">
									<div class="title">
										<h4>{{ $committee['title'] }}</h4>
									</div>
								</div>
								@endforeach
								
							</div>

						</div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-9"data-aos="fade-right">
							@foreach($committees as $key=>$committee)
							<div id="Tab{{ $key+1 }}" class="vertical-tab-content @if($key == 0) active @endif">
								
								<div class="row ">
									@foreach($committee['active_committee_members'] as $committee_member)
									<div class="col-md-6 col-lg-6 col-sm-6 mt-4">
										<div class="team-card1">
											<div class="team_member_image_wrapper">
											    @if(!empty($committee_member['profile']))
												<img src="{{ asset('front/images/committees/members/'.$committee_member['profile']) }}" alt="">
												@endif
											</div>
											<div class="team_members_text">
												<h6>{{ $committee_member['name'] }}</h6>
												<p class="subheading">{{ $committee_member['destination'] }}</p>
											</div>
										</div>
									</div>
									@endforeach
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