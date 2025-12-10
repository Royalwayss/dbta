@extends('front.layout.layout')
@section('content')
<main>
  <!-- <section class="contact_us_wrapper_sec">
    <div class="heading-one d-flex align-items-center justify-content-center h-100">
      <h1>interactive meeting
      </h1>
    </div>
  </section> -->
  <section class="list_committes_wrap_sec">
    <div class="heading-one heading_one_dtba"data-aos="fade-up">
      <h1 class="text-center img-text">{{ $meeting_type['name'] }}</h1>
      <div class="underline mx-auto mt-2"></div>
    </div>
  </section>
   @foreach($meetings as $meeting) 
   <?php 
     $images = [];
     if(!empty($meeting['images'])){
        $image_strings = $meeting['images']; 
		$images = explode(',',$image_strings);
     }
	 $videos = [];
     if(!empty($meeting['videos'])){
        $video_strings = $meeting['videos']; 
		$videos = explode(',',$video_strings);
     }
   ?>
   <section class="learning_sec_wrap">
    <div class="container">
      <div class="row align-items-start">

        <!-- LEFT SIDE CONTENT -->
        <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-left">
          <h2 class="about-heading learning_heading">{{  $meeting['meeting_title'] }}</h2>
          <p class="subheading"> 
            <i class="bi bi-calendar-event"></i> <?php echo date("F Y", strtotime($meeting['meeting_date'])); ?> &nbsp; | &nbsp;
            <i class="bi bi-geo-alt"></i> {{  $meeting['location'] }}
          </p>
          <hr>

          <h3 class="heading_three detail_subheading">Meeting Summary</h3>
          <p class="subheading">
		    <?php echo $meeting['description']; ?>
		  </p>
        </div>

        <!-- RIGHT SIDE IMAGES -->
        <div class="col-lg-6"data-aos="fade-right">
          <div class="row align-items-center">
            <div class=" gallery_image_wrap ">
              <div class="image-slider learning_imgage_wrapper">
			    @foreach($images as $key=> $img)
                <div><img src="{{ asset('front/images/meetings/'.$img) }}" class="rounded-4" alt="Image {{ $key +1 }}"></div>
                @endforeach
              </div>
            </div>

            <div class="col-lg-6 video_image_wrap learning_wrapper_right_side">
              <div class="video-slider learning_imgage_wrapper2">
                 @foreach($videos as $key=> $video)
				<div class="position-relative @if($key == 0) mb-4 @endif">
                 <iframe width="420" height="315" src="{{ $video }}">
				 </iframe>
                </div>
				@endforeach
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  @endforeach
</main>

@endsection