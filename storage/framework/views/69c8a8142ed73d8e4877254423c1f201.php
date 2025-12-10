
<?php $__env->startSection('content'); ?>
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

							<input type="text" class="form-control" id="firstName" placeholder="Name" required>
						</div>
						<div class="col-md-6 mb-4">

							<input type="text" class="form-control" id="designation" placeholder="Designation" required>
						</div>
					</div>

					<div class="mb-4">

						<textarea class="form-control" id="address" rows="2" placeholder="Address" required></textarea>
					</div>

					<div class="row">
						<div class="col-md-6 mb-4">

							<select class="form-select" id="city" required>
								<option value="">Select City</option>
								<option value="Mumbai">Mumbai</option>
								<option value="Delhi">Delhi</option>
								<option value="Bangalore">Bangalore</option>
							</select>
						</div>
						<div class="col-md-6 mb-4">

							<select class="form-select" id="state" required>
								<option value="">Select State</option>
								<option value="Maharashtra">Maharashtra</option>
								<option value="Karnataka">Karnataka</option>
								<option value="Delhi">Delhi</option>
							</select>
						</div>
					</div>
					<div class="mb-3 mb-4">

						<select class="form-select" id="paymentMode" onchange="togglePaymentFields()" required>
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
							placeholder="Attach Document" accept=".pdf, .jpg, .png" required>

					</div>
					<div class="login_btn">
						<button type="submit" class="btn">Submit</button>
					</div>

				</form> -->
				<form class="input_field_list">
					<div class="row">
						<div class="col-md-6 col-12">
							<!-- Name -->
							<div class="mb-4">
								<label class="form-label">Name (In Capital Letters)</label>
								<input type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<!-- S/D/O -->
							<div class="mb-4">
								<label class="form-label">S/O - D/O</label>
								<input type="text" class="form-control" required>
							</div>
						</div>
					</div>
					<!-- Residence -->
					<div class="mb-4">
						<label class="form-label">Residence Address</label>
						<textarea class="form-control" rows="2" required></textarea>
					</div>

					<!-- Office -->
					<div class="mb-4">
						<label class="form-label">Office Address</label>
						<textarea class="form-control" rows="2" required></textarea>
					</div>

					<!-- Phone -->
					<div class="row">
						<div class="col-md-4 mb-4">
							<label class="form-label">Phone (O)</label>
							<input type="text" class="form-control">
						</div>
						<div class="col-md-4 mb-4">
							<label class="form-label">Phone (R)</label>
							<input type="text" class="form-control">
						</div>
						<div class="col-md-4 mb-4">
							<label class="form-label">Mobile (M)</label>
							<input type="text" class="form-control" required>
						</div>
					</div>

					<!-- Email -->
					<div class="mb-4">
						<label class="form-label">Email</label>
						<input type="email" class="form-control" required>
					</div>

					<!-- Professional Area -->
					<div class="mb-4">
						<label class="form-label">Professional Area</label>
						<select class="form-select" required>
							<option value="">Select</option>
							<option>CA</option>
							<option>CS</option>
							<option>Adv.</option>
							<option>ITP</option>
							<option>Other</option>
						</select>
					</div>

					<!-- Membership Number -->
					<div class="mb-4">
						<label class="form-label">Membership No. (or other Enrolment No., if applicable)</label>
						<input type="text" class="form-control">
					</div>

					<hr>

					<!-- Enclosures Section -->
					<h5 class="mb-3">Enclosures (Upload Required Documents)</h5>
					<div class="row">
						<div class="col-md-6 col-12">
							<div class="mb-3">
								<label class="form-label">KYC</label>
								<input type="file" class="form-control" accept=".pdf,.jpg,.png" required>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="mb-3">
								<label class="form-label">Qualification Proof</label>
								<input type="file" class="form-control" accept=".pdf,.jpg,.png" required>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="mb-3">
								<label class="form-label">Practice Certificate / Evidence of Practice</label>
								<input type="file" class="form-control" accept=".pdf,.jpg,.png" required>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="mb-3">
								<label class="form-label">Fees Paid Amount (Rs.)</label>
								<input type="text" class="form-control" placeholder="Amount" required>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="mb-3">
								<label class="form-label">Transaction / Cheque / Receipt No.</label>
								<input type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6 col-12">

							<div class="mb-4">
								<label class="form-label">Date of Payment</label>
								<input type="date" class="form-control" required>
							</div>
						</div>
					</div>
					<hr>

					<!-- Signature -->
					<div class="mb-4">
						<label class="form-label">Signature of Applicant</label>
						<input type="file" class="form-control" accept=".jpg,.png,.pdf">
					</div>

					<!-- Remarks -->
					<div class="mb-4">
						<label class="form-label">Any Remarks</label>
						<textarea class="form-control" rows="2"></textarea>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/pages/membership/new_membership.blade.php ENDPATH**/ ?>