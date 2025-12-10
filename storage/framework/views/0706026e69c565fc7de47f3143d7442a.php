
<?php $__env->startSection('content'); ?>
<main>
  <!-- <section class="contact_us_wrapper_sec">
    <div class="heading-one d-flex align-items-center justify-content-center h-100">
      <h1>interactive meeting
      </h1>
    </div>
  </section> -->
  <section class="list_committes_wrap_sec">
    <div class="heading-one heading_one_dtba"data-aos="fade-up">
      <h1 class="text-center img-text"><?php echo e($meeting_type['name']); ?></h1>
      <div class="underline mx-auto mt-2"></div>
    </div>
  </section>
   <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
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
          <h2 class="about-heading learning_heading"><?php echo e($meeting['meeting_title']); ?></h2>
          <p class="subheading"> 
            <i class="bi bi-calendar-event"></i> <?php echo date("F Y", strtotime($meeting['meeting_date'])); ?> &nbsp; | &nbsp;
            <i class="bi bi-geo-alt"></i> <?php echo e($meeting['location']); ?>

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
			    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><img src="<?php echo e(asset('front/images/meetings/'.$img)); ?>" class="rounded-4" alt="Image <?php echo e($key +1); ?>"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>

            <div class="col-lg-6 video_image_wrap learning_wrapper_right_side">
              <div class="video-slider learning_imgage_wrapper2">
                 <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="position-relative <?php if($key == 0): ?> mb-4 <?php endif; ?>">
                 <iframe width="420" height="315" src="<?php echo e($video); ?>">
				 </iframe>
                </div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/pages/meeting/meeting.blade.php ENDPATH**/ ?>