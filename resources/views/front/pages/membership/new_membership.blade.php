@extends('front.layout.layout')
@section('content')
<style>
.input_field_list input,textarea,select {
	color: var(--bs-body-color);
    background-color: var(--bs-body-bg);
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
}
</style>
<main>
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
          <p class="subheading paragraph text-justify">New Membership in DTBA opens the door to a thriving community of Chartered Accountants, Advocates, Company secretaries and ITP. It provides access to exclusive networking opportunities, knowledge-sharing sessions, and professional development resources. New members benefit from Study Circle Meetings, Discussion forums, webinars, newsletters, Direct tax updates, and committee involvement that fosters leadership and growth. The registration process is simple and transparent, with flexible membership categories tailored to individual needs. As a member, you'll stay connected with the latest developments in tax laws and practices. Joining DTBA means being part of a trusted member’snetwork committed to excellence and ethical standards.</p>
        </div>
      </div>
    </div>
  </section>
  <section class="join_us_form">
    <div class="container mt-5 " data-aos="fade-down">
      <div class="join_us_form_design">
        <h3 class="about-heading text-center mb-4">Join Us</h3>
        <form class="input_field_list" id="membership-signup" action="javascript:;">
          @csrf
          <div class="row">
            <div class="col-md-3 mb-4">
              <!-- Name -->
              <div class="mb-4">
                <label class="form-label">Name (In Capital Letters)</label>
                <input type="text" class="form-control" name="name" id="form-name">
                <p class="error-message" id="form-err-name"></p>
              </div>
            </div>
            <div class="col-md-3 mb-4">
              <!-- S/D/O -->
              <div class="mb-4">
                <label class="form-label">S/O - D/O</label>
                <input type="text" name="parent_name" id="form-parent_name" class="form-control">
                <p class="error-message" id="form-err-parent_name"></p>
              </div>
            </div>

            <!-- Phone -->

            <div class="col-md-3 mb-4">
              <label class="form-label">Phone (O)</label>
              <input type="text" class="form-control" name="phone_office" id="form-phone_office">
              <p class="error-message" id="form-err-phone_office"></p>
            </div>
            <div class="col-md-3 mb-4">
              <label class="form-label">Phone (R)</label>
              <input type="text" class="form-control" name="phone_residence" id="form-phone_residence">
              <p class="error-message" id="form-err-phone_residence"></p>
            </div>
            <div class="col-md-3 mb-4">
              <label class="form-label">Mobile (M)</label>
              <input type="text" class="form-control" name="mobile" id="form-mobile">
              <p class="error-message" id="form-err-mobile"></p>
            </div>

            <!-- Email -->

            <div class="col-md-3 mb-4">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="form-email">
              <p class="error-message" id="form-err-email"></p>
            </div>
            <!-- Professional Area -->
            <div class="col-md-2 mb-4">
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
            <div class="col-md-4 mb-4">
              <label class="form-label">Membership / Enrolment No. (if applicable)</label>
              <input type="text" class="form-control" name="membership_no" id="form-membership_no">
              <p class="error-message" id="form-err-membership_no"></p>
            </div>
          </div>

          <div class="row">
            <!-- Residence -->
            <div class="col-md-6 mb-4">
              <label class="form-label">Residence Address</label>
              <textarea class="form-control" name="residence_address" id="form-residence_address" rows="2"></textarea>
              <p class="error-message" id="form-err-residence_address"></p>

            </div>
            <!-- Office -->
            <div class="col-md-6 mb-4">
              <label class="form-label">Office Address</label>
              <textarea class="form-control" name="office_address" id="form-office_address" rows="2"></textarea>
              <p class="error-message" id="form-err-office_address"></p>
            </div>
          </div>
		  
		  <div class="row">
		  <!-- Office -->
		   <div class="col-md-6 mb-4">
              <label class="form-label">Aadhaar Card No</label>
              <input type="text" class="form-control" name="aadhaar_no" id="form-aadhaar_no">
              <p class="error-message" id="form-err-aadhaar_no"></p>
            </div>
		  
          
		  <!-- Pan -->
		   <div class="col-md-6 mb-4">
              <label class="form-label">Pan Card No</label>
              <input type="text" class="form-control" name="pan_no" id="form-pan_no">
              <p class="error-message" id="form-err-pan_no"></p>
            </div>
            </div>
          <hr>
          <!-- Enclosures Section -->
          <h5 class="mb-3">Enclosures (Upload Documents)</h5>
          <div class="row">

            @php
            $upload_files = [
					'kyc' => 'KYC Document (Aadhaar / PAN / Passport)',
					'qualification_proof' => 'Proof of Qualification',
					'practice_certificate' => 'Practice Certificate / Evidence of Practice',
					'signature_of_applicant' => 'Signature of Applicant',
					'photo' => 'Passport Size Photo'
            ];
            @endphp
            <div class="row">
              @foreach($upload_files as $name => $label)
              <div class="col-md-6 col-12">
                <div class="membership-file-upload mb-3">
                  <label class="membership-file-label" for="{{ $name }}">
                    <span>{{ $label }}</span>
                    <span class="file-name" style="color: #00608f;"></span>
                  </label>

                  <input type="file" id="{{ $name }}" name="{{ $name }}" class="file-input">

                  @error($name)
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <p class="error-message" id="form-err-{{ $name }}"></p>
              </div>
              @endforeach
            </div>

          </div>
          <hr>

          <!-- Remarks -->
          <div class="mb-4">
            <label class="form-label">Any Remarks</label>
            <textarea class="form-control" rows="2" name="remarks" id="form-remarks"></textarea>
            <p class="error-message" id="form-err-remarks"></p>
          </div>
          <!-- Payment Details Section -->
          <div class="payment-container-details">
            <h3 class="payment-container-title">
              Membership Fee – Payment Details
            </h3>
            <div class="payment-container-inner">
              <!-- QR Code -->
              <div class="payment-container-qr-code">
                <p class="payment-container-qr-text text-center">Scan & Pay (UPI)</p>
                <img src="{{ asset('front/assets/images/SBI_QR_CODE.png') }}" alt="QR Code" class="payment-container-qr-image">
                <a download class="qrcode_download_btn" href="{{ asset('front/assets/images/SBI_QR_CODE.png') }}"><br><i class="fa fa-download" aria-hidden="true"></i> Download Qrcode</a>

              </div>
              <!-- Bank Details -->
              <div class="payment-container-bank-details">
                <p class="payment-container-bank-text">Bank Account Details</p>
                <table class="payment-container-bank-table">
                  <tr style="display:none">
                    <td class="payment-container-table-cell">Account Name</td>
                    <td class="payment-container-table-cell"></td>
                  </tr>
                  <tr>
                    <td class="payment-container-table-cell">Bank Name</td>
                    <td class="payment-container-table-cell">State Bank of India</td>
                  </tr>
                  <tr>
                    <td class="payment-container-table-cell">Account Number</td>
                    <td class="payment-container-table-cell">55116931248</td>
                  </tr>
                  <tr>
                    <td class="payment-container-table-cell">IFSC Code</td>
                    <td class="payment-container-table-cell">SBIN0051249</td>
                  </tr>
                  <tr>
                    <td class="payment-container-table-cell">Branch</td>
                    <td class="payment-container-table-cell">Ludhiana</td>
                  </tr>
                </table>
                <div class="payment-container-important-note">
                  <strong>Note:</strong>
                  Please complete the membership payment using the above QR code or bank transfer.
                  <br>The fee for <strong>New Membership</strong> is <strong>₹1,000/-.</strong>
                  <br>The <strong>Annual Membership</strong> Fee is <strong>₹1,000/- up to 31st March.</strong>
                  <br>From <strong>1st April onwards</strong>, the applicable annual membership fee will be <strong>₹1,100/-.</strong>
                </div>
              </div>
            </div>
            <!-- Important Note -->

          </div>

          <div class="row">
            <div class="col-md-4 col-12">
              <div class="mb-3">
                <label class="form-label">Fees Paid Amount (Rs.)</label>
                <input type="text" class="form-control" name="fees_paid_amount" id="form-fees_paid_amount" placeholder="Amount">
                <p class="error-message" id="form-err-fees_paid_amount"></p>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="mb-3">
                <label class="form-label">Transaction / Cheque / Receipt No.</label>
                <input type="text" class="form-control" name="transaction_id" id="form-transaction_id">
                <p class="error-message" id="form-err-transaction_id"></p>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="mb-4">
                <label class="form-label">Date of Payment</label>
                <input type="date" class="form-control" name="date_of_payment" id="form-date_of_payment">
                <p class="error-message" id="form-err-date_of_payment"></p>
              </div>
            </div>

          </div>

          <div class="row mb-4">
            <div class="col-md-12 col-12">
              <label class="form-label">Declaration</label>
              <div class="payment-container-important-note">
                <p>I hereby apply for being enrolled as a Member of the Distt. Taxation Bar Association (Regd.) (Direct Taxes), Ludhiana. I hereby
                  confirm and undertake that the information furnished above is true and correct in all respects and that I fulfil the eligibility criteria
                  to become a member. I further undertake to abide by the Memorandum and By-Laws of the Association.
                </p>
              </div>
            </div>
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
  $(document).ready(function() {
    $('#form-name').on('keyup', function() {
      $(this).val($(this).val().toUpperCase());
    });
    $(document).on("submit", "form", function(e) {
      e.preventDefault();
      $('.PleaseWaitDiv').show();
      $('.error-message').html('');
      var formdata = new FormData(this);
      $.ajax({
        url: "/save-membership",
        type: 'POST',
        dataType: "JSON",
        data: formdata,
        processData: false,
        contentType: false,
        success: function(data) {
          $('.PleaseWaitDiv').hide();
          if (!data.status) {
            if (data.type == "validation") {
              var err_no = 0;
              $.each(data.errors, function(i, error) {
                err_no = err_no + 1;
                $('#form-err-' + i).html(error);
                if (err_no == 1) {
                  $('#form-' + i).focus();
                }
              });
            }
          } else {
             $('#membership-signup')[0].reset();
             //window.location.href=data.url;
			 window.open(data.url, '_blank');
          }
        },
        error: function() {
          $('.PleaseWaitDiv').hide();
          alert('Something went to wrong. Please try again later.');
        }
      });
    });
  });
  $(document).on('change', '.file-input', function() {
    let fileName = this.files[0]?.name || 'Choose File';
    $(this)
      .closest('.membership-file-upload')
      .find('.file-name')
      .text(fileName);
  });
</script>
@endsection