
<?php $__env->startSection('content'); ?>
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
					<?php $__currentLoopData = $newsletters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsletter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><strong><?php echo e(date("F", strtotime($newsletter['month']))); ?></strong></td>
							<td><span class="badge yellow-badge"><?php echo e(date("Y", strtotime($newsletter['month']))); ?></span></td>
							<td>
								<a <?php if($newsletter['pdf']): ?> href="<?php echo e(asset('front/pdf/newsletters/'.$newsletter['pdf'])); ?>" target="_blank" <?php else: ?> href="javascript:;" <?php endif; ?> class="btn btn-sm pdf_icon" ><i
										class="fa-solid fa-file-pdf"></i></a>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
					</tbody>
				</table>
			</div>
		</div>

	</section>


</main>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/pages/newsletter/newsletter.blade.php ENDPATH**/ ?>