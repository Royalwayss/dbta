 
<?php $__env->startSection('content'); ?>
	<main>
		<!-- <section class="contact_us_wrapper_sec">
			<div class="heading-one d-flex align-items-center justify-content-center h-100">
				<h1>Contact Us</h1>
			</div>
		</section> -->
		<section class="list_committes_wrap_sec">
		<div class="heading-one heading_one_dtba"data-aos="fade-up">
			<h1 class="text-center img-text">Contact Us</h1>
			<div class="underline mx-auto mt-2"></div>
		</div>
	</section>
		<section class="contact_us_wrap_sec">
			<div class="container py-5">
				<div class="row g-4">

					<div class="col-lg-8"data-aos="fade-left">
						<form class="contact_us_form_wrapper" id="contact_form" action="javascript:;"><?php echo csrf_field(); ?>
							<div class="row g-3">
								<div class="col-md-6 input_filed_wrap">
									<input type="text" class="form-control" name="name" id="contact-name" placeholder="Your Name">
								    <p class="error-message" id="contact-err-name"></p>
								</div>
								<div class="col-md-6 input_filed_wrap">
									<input type="text" class="form-control" name="email" id="contact-email" placeholder="Email">
								     <p class="error-message" id="contact-err-email"></p>
								</div>
								<div class="col-6 input_filed_wrap">
									<input type="text" class="form-control" name="mobile" id="contact-mobile" placeholder="Phone Number">
								     <p class="error-message" id="contact-err-mobile"></p>
								</div>
								<div class="col-6 input_filed_wrap">
									<input type="text" class="form-control" name="subject" id="contact-subject" placeholder="Subject">
								     <p class="error-message" id="contact-err-subject"></p>
								</div>
								<div class="col-12 input_filed_wrap">
									<textarea class="form-control" rows="4" name="message" id="contact-message" placeholder="Message"></textarea>
								     <p class="error-message" id="contact-err-message"></p>
								</div>
								<!-- <div class="col-12 input_filed_wrap">
									<button type="submit" class="btn btn-success px-4">Submit Button</button>
								</div> -->
								
								<div class="login_btn read-more">
					<button type="submit" class="btn">Submit</button>
				</div>
								
							</div>
						</form>
					</div>
					<div class="col-lg-4"data-aos="fade-right">
						<div class="newsletter-box h-100">
							<div class="info-card d-flex align-items-start ">
								<i class="bi bi-telephone-fill"></i>
								<div>
									<h6>Call Us</h6>
									<p>7986043087</p>
								</div>

							</div>
							<div class="info-card d-flex align-items-start">
								<i class="bi bi-envelope-fill"></i>
								<div>
									<h6>Mail</h6>
									<p>Dtbadt@gmail.com</p>
								</div>

							</div>
							<div class="info-card d-flex align-items-start">
								<i class="bi bi-geo-alt-fill"></i>
								<div>
									<h6>Registered Office</h6>
									<p>Bar Room, Aayakar Bhawan, Rishi Nagar, Ldh, pb-141001</p>
								</div>

							</div>
							<div class="Social-media">
								<a href="#">
									<i class="fab fa-facebook"></i>
								</a>
								<a href="#">
									<i class="fab fa-linkedin"></i>
								</a>
								<a href="#">
									<i class="fab fa-instagram"></i>
								</a>
								<a href="#">
									<i class="fab fa-youtube"></i>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12"data-aos="fade-up">
						<iframe class="map-frame"
							src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3423.2671516523105!2d75.79973217558721!3d30.90715597450054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzDCsDU0JzI1LjgiTiA3NcKwNDgnMDguMyJF!5e0!3m2!1sen!2sin!4v1764999988071!5m2!1sen!2sin"
							style="border:0;" allowfullscreen="" loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
			</div>
		</section>
	</main>
<script type="text/javascript" src="<?php echo e(asset('front/assets/js/ajax_jquery.min.js')); ?>"></script>
	<script>	
	$(document).ready(function(){ 
		$("#contact_form").submit(function(e){ 
			e.preventDefault();
			$('.PleaseWaitDiv').show();
			$('.error-message').html('');
			var formdata = $("#contact_form").serialize();
			$.ajax({
				url: "/save-contact",
				type:'POST',
				data: formdata,
				success: function(data) {
					$('.PleaseWaitDiv').hide();
					if(!data.status){
						if(data.type=="validation"){
							var err_no = 0;
							$.each(data.errors, function (i, error) {
							err_no = err_no + 1;
							
							$('#contact-err-'+i).html(error);
							if(err_no  == 1) { $('#contact-'+i).focus(); }
							
							});
						}
					}else{
						$('#contact_form')[0].reset(); 
						alert(data.message);
					}
				}
			});
		});
	});
	</script>		
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/pages/contactus/contact-us.blade.php ENDPATH**/ ?>