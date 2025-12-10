
<?php $__env->startSection('content'); ?>
	<main>
		<section class="team-section  committes_wrap_sec">
			<div class="heading-one  mb-5"data-aos="fade-up">
				
				<h1 class="text-center">Executive Committee 2025</h1>
				<div class="underline mx-auto mt-2"></div>
			</div>
			<div class="container">
				<div class="row g-4 align-items-start"data-aos="fade-down">
					<div class="col-12">
						<div class="row g-4">
							<?php $__currentLoopData = $executive_body; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-md-3 col-lg-3 col-sm-6">
								<div class="team-card text-center bg-white  rounded shadow-sm">
									<img src="<?php echo e(asset('front/images/executive-body/'.$val['image'])); ?>" alt="" class="img-fluid mb-3">
									<h6><?php echo e($val['name']); ?></h6>
									<p class="subheading"><?php echo e($val['destination']); ?></p>
								</div>
							</div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
   
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/pages/aboutus/executive.blade.php ENDPATH**/ ?>