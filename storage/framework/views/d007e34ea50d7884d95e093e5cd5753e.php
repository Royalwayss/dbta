
<?php $__env->startSection('content'); ?>
<main>
		<section class="list_committes_wrap_sec">
			<div class="heading-one heading_one_dtba"data-aos="fade-up">
			<h1 class="text-center img-text">DTBA Committees </h1>
				<div class="underline mx-auto mt-2"></div>
			</div>
		</section>
		<section id="vertical-tab">
			<div class="container-fluid ">
				<div class="vertical-tab-wrapper">
					<div class="row justify-content-between">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-3"data-aos="fade-left">
							<div class="vertical-tab">
								<?php $__currentLoopData = $committees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="each-tab <?php if($key == 0): ?> active <?php endif; ?>" data-target="#Tab<?php echo e($key+1); ?>">
									<div class="title">
										<h4><?php echo e($committee['title']); ?></h4>
									</div>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								
							</div>

						</div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-9"data-aos="fade-right">
							<?php $__currentLoopData = $committees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div id="Tab<?php echo e($key+1); ?>" class="vertical-tab-content <?php if($key == 0): ?> active <?php endif; ?>">
								
								<div class="row ">
									<?php $__currentLoopData = $committee['active_committee_members']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee_member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-md-6 col-lg-6 col-sm-6 mt-4">
										<div class="team-card1">
											<div class="team_member_image_wrapper">
											    <?php if(!empty($committee_member['profile'])): ?>
												<img src="<?php echo e(asset('front/images/committees/members/'.$committee_member['profile'])); ?>" alt="">
												<?php endif; ?>
											</div>
											<div class="team_members_text">
												<h6><?php echo e($committee_member['name']); ?></h6>
												<p class="subheading"><?php echo e($committee_member['destination']); ?></p>
											</div>
										</div>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('front.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/pages/aboutus/committes.blade.php ENDPATH**/ ?>