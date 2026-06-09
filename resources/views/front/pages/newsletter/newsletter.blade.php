@extends('front.layout.layout')
@section('content')
<style>
#mob-tab {
    display: flex;
    gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid #e3e8f0;
    margin-bottom: 15px;
}

#mob-tab a {
    flex: 1;
    text-align: center;
    padding: 10px 16px;
    border-radius: 8px;
    background: #ffffff;
    color: #006090;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid #d0e0ff;
    transition: all 0.2s ease;
}
#mob-tab a: hover, #mob-tab a.active {
    background: #006090;
    color: #ffffff;
    border-color: #006090;
}

</style>
<main>
  <!-- <section class="contact_us_wrapper_sec">
		<div class="heading-one d-flex align-items-center justify-content-center h-100">
			<h1>Newsletter</h1>
		</div>
	</section> -->
  <section class="list_committes_wrap_sec">

    <div class="row">
      
	 <div class="col-12 d-block text-center d-md-none" id="mob-tab">
		<a href="#newsletter" class="active">Newsletter</a>
		<a href="#articles">Articles</a>
	</div>
	  
	  
	  <div class="col-12 col-md-6" id="newsletter">
        <div class="heading-one heading_one_dtba" data-aos="fade-up">
          <h1 class="text-center img-text">Newsletter</h1>
          <div class="underline mx-auto mt-2"></div>
        </div>

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
                    <a @if($newsletter['pdf']) href="{{ asset('front/pdf/newsletters/'.$newsletter['pdf']) }}" @else href="javascript:;"> @endif class="btn btn-sm pdf_icon" target="_blank"><i class="bi bi-download"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    
	  <div class="col-12 col-md-6" id="articles">
        <div class="heading-one heading_one_dtba" data-aos="fade-up">
          <h1 class="text-center img-text">Articles</h1>
          <div class="underline mx-auto mt-2"></div>
        </div>

        <div class="container my-5">
          <div class="table-responsive" data-aos="fade-up">
            <table class="table custom-table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Link</th>
                </tr>
              </thead>
              <tbody>
                @foreach($articles as $article)
                <tr>
                  <td><strong>{{  $article['title']  }}</strong></td>
                  <td><strong>{{  $article['author']  }}</strong></td>
                  
                  <td>
                    <a @if($article['pdf']) href="{{ asset('front/pdf/articles/'.$article['pdf']) }}" @else href="javascript:;" @endif class="btn btn-sm pdf_icon" target="_blank"><i class="bi bi-download"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    
	</div>

  </section>

</main>
<script type="text/javascript" src="{{ asset('front/assets/js/ajax_jquery.min.js') }}"></script>
<script>
$(document).ready(function () {
    $('#mob-tab a').on('click', function () {
        $('#mob-tab a').removeClass('active');
        $(this).addClass('active');
    });
});
</script>
@endsection