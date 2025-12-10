
<?php $__env->startSection('content'); ?>
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
	<?php if(!empty($media)): ?>
	<?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<section class="media_galery_wrapper gallery_image_wrapper_sec">
		<div class="container">
			<div class="mb-4 text-left">
				<h2 class="about-heading"><?php echo e($val['title']); ?></h2>
				<div class="underline  mt-2"></div>
		    </div>	
			<div class="row">
				<div class="col-lg-12" data-aos="fade-up">
					<div class="owl-carousel owl-theme media-carousel">

						<?php $__currentLoopData = $val['active_media_images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item">
							<div class="card blog-card border-0 shadow-sm">
								<img src="<?php echo e(asset('front/images/media/'.$image['file'])); ?>" class="card-img-top" alt="Blog Post Image">
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						

					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
	
</main>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/pages/media/media.blade.php ENDPATH**/ ?>