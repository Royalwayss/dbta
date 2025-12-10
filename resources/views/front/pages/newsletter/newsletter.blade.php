@extends('front.layout.layout')
@section('content')
<main>
	<!-- <section class="contact_us_wrapper_sec">
		<div class="heading-one d-flex align-items-center justify-content-center h-100">
			<h1>Newsletter</h1>
		</div>
	</section> -->
	<section class="list_committes_wrap_sec">
		<div class="heading-one heading_one_dtba"data-aos="fade-up">
			<h1 class="text-center img-text">Newsletter</h1>
			<div class="underline mx-auto mt-2"></div>
		</div>
	</section>
	<section class="newsletter_sec">
		<div class="container my-5">
			<div class="table-responsive" data-aos="fade-up">
				<table class="table custom-table">
					<thead>
						<tr>
							<th>Month</th>
							<th>Year</th>
							<th>PDF Link</th>
						</tr>
					</thead>
					<tbody>
					@foreach($newsletters as $newsletter)
						<tr>
							<td><strong>{{ date("F", strtotime($newsletter['month'])) }}</strong></td>
							<td><span class="badge yellow-badge">{{ date("Y", strtotime($newsletter['month'])) }}</span></td>
							<td>
								<a @if($newsletter['pdf']) href="{{ asset('front/pdf/newsletters/'.$newsletter['pdf']) }}" @else href="javascript:;"> @endif class="btn btn-sm pdf_icon" target="_blank"><i
										class="fa-solid fa-file-pdf"></i></a>
							</td>
						</tr>
					@endforeach	
					</tbody>
				</table>
			</div>
		</div>

	</section>


</main>


@endsection