@extends('front.layout.layout')
@section('content')
<main>
  <!-- <section class="contact_us_wrapper_sec">
    <div class="heading-one d-flex align-items-center justify-content-center h-100">
      <h1>Downloads</h1>
    </div>
  </section> -->
  <section class="list_committes_wrap_sec">
		<div class="heading-one heading_one_dtba"data-aos="fade-up">
			<h1 class="text-center img-text">Downloads</h1>
			<div class="underline mx-auto mt-2"></div>
		</div>
	</section>
  <section>
    <div class="container my-5"data-aos="fade-up">
      <div class="table-responsive">
        <table class="table custom-table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Download PDF</th>
            </tr>
          </thead>
          <tbody>
		  @foreach($downloads as $download)
            <tr>
              <td><strong>{{ $download['title']  }}</strong></td>
              <td>
                <a href="{{ asset('front/pdf/downloads/'.$download['pdf']) }}" class="btn btn-sm pdf_icon" target="_blank"><i class="fa-solid fa-cloud-arrow-down"></i></a>
              </td>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

  </section>


</main>
@endsection