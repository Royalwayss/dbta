@extends('front.layout.layout')
@section('content')
<main>
	<!-- <section class="contact_us_wrapper_sec">
		<div class="heading-one d-flex align-items-center justify-content-center h-100">
			<h1>Media and Gallery</h1>
		</div>
	</section> -->
  <section class="list_committes_wrap_sec">
		<div class="heading-one heading_one_dtba"data-aos="fade-up">
			<h1 class="text-center img-text">Media and Gallery</h1>
			<div class="underline mx-auto mt-2"></div>
		</div>
	</section>
	@if(!empty($media))
	@foreach($media as $val)
	<section class="media_galery_wrapper gallery_image_wrapper_sec">
		<div class="container">
			<div class="mb-4 text-left">
				<h2 class="about-heading">{{ $val['title'] }}</h2>
				<div class="underline  mt-2"></div>
		    </div>	
			<div class="row">
				<div class="col-lg-12" data-aos="fade-up">
					<div class="owl-carousel owl-theme media-carousel">

						@foreach($val['active_media_images'] as $image)
						<div class="item">
							<div class="card blog-card border-0 shadow-sm">
								<img src="{{ asset('front/images/media/'.$image['file']) }}" class="card-img-top" alt="Blog Post Image">
							</div>
						</div>
						@endforeach
						

					</div>
				</div>
			</div>
		</div>
	</section>
	@endforeach
	@endif
	
</main>


@endsection