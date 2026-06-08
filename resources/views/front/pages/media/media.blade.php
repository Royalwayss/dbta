@extends('front.layout.layout')
@section('content')
<main>
  <section class="list_committes_wrap_sec">
    <div class="heading-one heading_one_dtba" data-aos="fade-up">
      <h1 class="text-center img-text">Media and Gallery</h1>
      <div class="underline mx-auto mt-2"></div>
    </div>
  </section>
  @if(!empty($media_list))
  @foreach($media_list as $val)
  <section class="media_galery_wrapper gallery_image_wrapper_sec">
    <div class="container">
      <div class="mb-4 text-left">
        <h2 class="about-heading">{{ $val['title'] }}</h2>
        <div class="underline mt-2"></div>
      </div>
      <div class="row">
        <div class="col-lg-12" data-aos="fade-up">
          <div class="owl-carousel owl-theme media-carousel">
            @foreach($val['active_media_images'] as $image)
            <div class="item">
              <div class="card blog-card border-0 shadow-sm">
                {{-- Added: data attributes + zoom-trigger class for lightbox --}}
                <img src="{{ asset('front/images/media/'.$image['file']) }}" class="card-img-top zoom-trigger" alt="img" data-title="{{ $val['title'] }}" data-group-images="{{ implode('|', array_column($val['active_media_images'], 'file')) }}" data-current="{{ $image['file'] }}" style="cursor: zoom-in;">
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
  
  <section>
    <div class="container">
      <div class="row align-items-end table-pagination">
        {{ $media->links() }}
      </div>
    </div>
  </section>
</main>
@include('front.pages.media.gallery-zoom')
@endsection