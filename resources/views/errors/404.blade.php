@extends('front.layout.layout')
@section('content')
<!-- breadcrumb start -->
<section class="list_committes_wrap_sec">
		<div class="heading-one heading_one_dtba"data-aos="fade-up">
			<h1 class="text-center img-text">404 - Page Not Found</h1>
			<div class="underline mx-auto mt-2"></div>
		</div>
	</section>

<!-- breadcrumb end -->
<section class="bg-light text-black text-center py-5 about-header">
    <div class="container">
        
        <p class="lead" style="text-align:center !important">Oops! The page you're looking for doesn't exist or might have been moved.</p>
    </div>
</section>

<section class="container my-5 about-content">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 text-center">
            <img src="{{ asset('front/images/404.png') }}" alt="Page Not Found" class="img-fluid mb-4" style="max-height: 300px;">
            <p class="mb-4"><!-- We couldn't find the page you were looking for. This might be due to an outdated link or a typo in the URL. --></p>
            <a href="{{ route('home') }}" class="btn btn-secondary px-4">Go to Homepage</a>
        </div>
    </div>
</section>

@endsection
