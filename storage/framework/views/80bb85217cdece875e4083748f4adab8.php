
<?php $__env->startSection('content'); ?>
<main>
  <!-- <section class="contact_us_wrapper_sec">
    <div class="heading-one d-flex align-items-center justify-content-center h-100">
      <h1>interactive meeting
      </h1>
    </div>
  </section> -->
  <section class="list_committes_wrap_sec">
    <div class="heading-one heading_one_dtba mb-5"data-aos="fade-up">
      <h1 class="text-center img-text">Case Laws</h1>
      <div class="underline mx-auto mt-2"></div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        
		<?php $__currentLoopData = $case_laws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case_law): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="col-12">
          <div class="case-laws_wrapper"data-aos="fade-down">
            <h2 class="about-heading"><?php echo e($case_law['title']); ?></h2>
            <p class="subheading">
			    <?php echo $case_law['description']; ?>
			</p>
            <div class="login_btn">
              <a href="<?php echo e(asset('front/pdf/caselaws/'.$case_law['pdf'])); ?>" class="btn btn-sm pdf_icon" target="_blank">Open PDF<i
                  class="fa-solid fa-file-pdf"></i></a>
            </div>

          </div>

        </div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
        
      </div>
    </div>
  </section>
</main>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/pages/case_laws/case_laws.blade.php ENDPATH**/ ?>