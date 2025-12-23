@extends('front.layout.layout')
@section('content')
<main>
	<!-- <section class="contact_us_wrapper_sec">
		<div class="heading-one d-flex align-items-center justify-content-center h-100">
			<h1>New Membership</h1>
		</div>
	</section> -->
	<section class="list_committes_wrap_sec">
		<div class="heading-one heading_one_dtba" data-aos="fade-up">
			<h1 class="text-center img-text">New Membership</h1>
			<div class="underline mx-auto mt-2"></div>
		</div>
	</section>
	<section class="">
		<div class="container">
			<div class="row">
				<div class="col-12" data-aos="fade-up">
					<p class="subheading paragraph">New Membership in DTBA opens the door to a thriving community of tax
						professionals, accountants, and advisors. It provides access to exclusive networking
						opportunities, knowledge-sharing sessions, and professional development resources. New members
						benefit from educational webinars, industry updates, and committee involvement that fosters
						leadership and growth. The registration process is simple and transparent, with flexible
						membership categories tailored to individual needs. As a member, you'll stay connected with the
						latest developments in tax laws and practices. Joining DTBA means being part of a trusted
						network committed to excellence and ethical standards.</p>
				</div>
			</div>
		</div>
	</section>
	<section class="join_us_form">
		<div class="container mt-5 " data-aos="fade-down">
			<div class="join_us_form_design">
				<h3 class="about-heading text-center mb-4">Join Us</h3>
				<!-- <form class="input_field_list">
					<div class="row">
						<div class="col-md-6 mb-4">

							<input type="text" class="form-control" id="firstName" placeholder="Name" >
						</div>
						<div class="col-md-6 mb-4">

							<input type="text" class="form-control" id="designation" placeholder="Designation" >
						</div>
					</div>

					<div class="mb-4">

						<textarea class="form-control" id="address" rows="2" placeholder="Address" ></textarea>
					</div>

					<div class="row">
						<div class="col-md-6 mb-4">

							<select class="form-select" id="city" >
								<option value="">Select City</option>
								<option value="Mumbai">Mumbai</option>
								<option value="Delhi">Delhi</option>
								<option value="Bangalore">Bangalore</option>
							</select>
						</div>
						<div class="col-md-6 mb-4">

							<select class="form-select" id="state" >
								<option value="">Select State</option>
								<option value="Maharashtra">Maharashtra</option>
								<option value="Karnataka">Karnataka</option>
								<option value="Delhi">Delhi</option>
							</select>
						</div>
					</div>
					<div class="mb-3 mb-4">

						<select class="form-select" id="paymentMode" onchange="togglePaymentFields()" >
							<option value="">Select Payment Mode</option>
							<option value="qr">QR Code</option>
							<option value="bank">Bank Details</option>
						</select>
					</div>
					<div id="qrSection" class="mb-4">

						<img src="assets/images/scan.png" alt="QR Code" class="qr-img">
					</div>

					<div id="bankSection" class="mb-4">

						<ul class="list-group">
							<li class="list-group-item">Bank Name: ABC Bank</li>
							<li class="list-group-item">A/C No: 1234567890</li>
							<li class="list-group-item">IFSC: ABCD0123456</li>
							<li class="list-group-item">Branch: Mumbai</li>
						</ul>
					</div>

					<div class="mb-4">

						<input type="file" class="form-control custom-file-input" id="document"
							placeholder="Attach Document" accept=".pdf, .jpg, .png" >

					</div>
					<div class="login_btn">
						<button type="submit" class="btn">Submit</button>
					</div>

				</form> -->
				<form class="input_field_list" id="membership-signup" action="javascript:;">@csrf
					<div class="row">
						<div class="col-md-6 col-12">
							<!-- Name -->
							<div class="mb-4">
								<label class="form-label">Name (In Capital Letters)</label>
								<input type="text" class="form-control" name="name" id="form-name" >
								<p class="error-message" id="form-err-name"></p>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<!-- S/D/O -->
							<div class="mb-4">
								<label class="form-label">S/O - D/O</label>
								<input type="text" name="parent_name" id="form-parent_name" class="form-control" >
								<p class="error-message" id="form-err-parent_name"></p>
							</div>
						</div>
					</div>
					<!-- Residence -->
					<div class="mb-4">
						<label class="form-label">Residence Address</label>
						 <textarea class="form-control" name="residence_address" id="form-residence_address" rows="2" ></textarea>
					     <p class="error-message" id="form-err-residence_address"></p>
					</div>

					<!-- Office -->
					<div class="mb-4">
						<label class="form-label">Office Address</label>
						<textarea class="form-control" name="office_address" id="form-office_address" rows="2" ></textarea>
						<p class="error-message" id="form-err-office_address"></p>
					</div>

					<!-- Phone -->
					<div class="row">
						<div class="col-md-4 mb-4">
							<label class="form-label">Phone (O)</label>
							<input type="text" class="form-control" name="phone_office" id="form-phone_office">
							<p class="error-message" id="form-err-phone_office"></p>
						</div>
						<div class="col-md-4 mb-4">
							<label class="form-label">Phone (R)</label>
							<input type="text" class="form-control" name="phone_residence" id="form-phone_residence">
							<p class="error-message" id="form-err-phone_residence"></p>
						</div>
						<div class="col-md-4 mb-4">
							<label class="form-label">Mobile (M)</label>
							<input type="text" class="form-control"  name="mobile" id="form-mobile">
							<p class="error-message" id="form-err-mobile"></p>
						</div>
					</div>

					<!-- Email -->
					<div class="mb-4">
						<label class="form-label">Email</label>
						<input type="email" class="form-control" name="email" id="form-email" >
						<p class="error-message" id="form-err-email"></p>
					</div>

					<!-- Professional Area -->
					<div class="mb-4">
						<label class="form-label">Professional Area</label>
						<select class="form-select" name="professional_area" id="form-professional_area">
							<option value="">Select</option>
							<option value="CA">CA</option>
							<option value="CS">CS</option>
							<option value="Adv.">Adv.</option>
							<option value="ITP">ITP</option>
							<option value="Other">Other</option>
						</select>
						<p class="error-message" id="form-err-professional_area"></p>
					</div>

					<!-- Membership Number -->
					<div class="mb-4" style="display:none">
						<label class="form-label">Membership No. (or other Enrolment No., if applicable)</label>
						<input type="text" class="form-control" name="membership_no" id="form-membership_no">
						<p class="error-message" id="form-err-membership_no"></p>
					</div>

					<hr>

					<!-- Enclosures Section -->
					<h5 class="mb-3">Enclosures (Upload  Documents)</h5>
					<div class="row">
						<div class="col-md-6 col-12">
							<div class="mb-3">
								<label class="form-label">KYC</label>
								<input type="file" class="form-control" name="kyc" id="form-kyc" accept=".pdf,.jpg,.png" >
							    <p class="error-message" id="form-err-kyc"></p>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="mb-3">
								<label class="form-label">Qualification Proof</label>
								<input type="file" class="form-control" name="qualification_proof" id="form-qualification_proof" accept=".pdf,.jpg,.png" >
								<p class="error-message" id="form-err-qualification_proof"></p>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="mb-3">
								<label class="form-label">Practice Certificate / Evidence of Practice</label>
								<input type="file" class="form-control" name="practice_certificate" id="form-practice_certificate" accept=".pdf,.jpg,.png" >
								<p class="error-message" id="form-err-practice_certificate"></p>
							</div>
						</div>
						<div class="col-md-6 col-12" style="display:none">
							<div class="mb-3">
								<label class="form-label">Fees Paid Amount (Rs.)</label>
								<input type="text" class="form-control" name="fees_paid_amount" id="form-fees_paid_amount" placeholder="Amount" >
								<p class="error-message" id="form-err-fees_paid_amount"></p>
							</div>
						</div>
						<div class="col-md-6 col-12" style="display:none">
							<div class="mb-3">
								<label class="form-label">Transaction / Cheque / Receipt No.</label>
								<input type="text" class="form-control" name="transaction_id" id="form-transaction_id" >
								<p class="error-message" id="form-err-transaction_id"></p>
							</div>
						</div>
						<div class="col-md-6 col-12" style="display:none">

							<div class="mb-4">
								<label class="form-label">Date of Payment</label>
								<input type="date" class="form-control" name="date_of_payment" id="form-date_of_payment">
								<p class="error-message" id="form-err-date_of_payment"></p>
							</div>
						</div>
					</div>
					<hr>

					<!-- Signature -->
					<div class="mb-4">
						<label class="form-label">Signature of Applicant</label>
						<input type="file" class="form-control" name="signature_of_applicant" id="form-signature_of_applicant" accept=".jpg,.png,.pdf">
						<p class="error-message" id="form-err-signature_of_applicant"></p>
					</div>

					<!-- Remarks -->
					<div class="mb-4">
						<label class="form-label">Any Remarks</label>
						<textarea class="form-control" rows="2" name="remarks" id="form-remarks"></textarea>
						<p class="error-message" id="form-err-remarks"></p>
					</div>

					<!-- Submit -->
					<div class="login_btn">
						<button type="submit" class="btn btn-primary w-100">Submit</button>
					</div>

				</form>

			</div>

		</div>
	</section>

</main>
<script type="text/javascript" src="{{ asset('front/assets/js/ajax_jquery.min.js') }}"></script>
	<script>	
	$(document).ready(function(){ 
		
		
		$('#form-name').on('keyup', function() {
           $(this).val($(this).val().toUpperCase()); 
         });
		
		
		
		
		
		$(document).on("submit", "form", function(e){
			e.preventDefault();
			$('.PleaseWaitDiv').show();
			$('.error-message').html('');
			var formdata =  new FormData(this);
			$.ajax({
				url: "/save-membership",
				 type:'POST',
				 dataType: "JSON",
				 data: formdata,
				 processData: false,
				 contentType: false,
				success: function(data) {
					$('.PleaseWaitDiv').hide();
					if(!data.status){
						if(data.type=="validation"){
							var err_no = 0;
							$.each(data.errors, function (i, error) {
							err_no = err_no + 1;
							
							$('#form-err-'+i).html(error);
							if(err_no  == 1) { $('#form-'+i).focus(); }
							
							});
						}
					}else{
						$('#membership-signup')[0].reset(); 
						alert(data.message);
					}
				},
				
				
				error: function() {
						$('.PleaseWaitDiv').hide();
						alert('Something went to wrong. Please try again later.');
				}
				
				
			
				
			});
		});
	});
	</script>		
 @endsection
