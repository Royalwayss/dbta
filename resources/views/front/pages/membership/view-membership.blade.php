<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      body {
        font-family: sans-serif;
        font-size: 11px;
        color: #1a1a2e;
        background: #fff;
      }

      @if($type =='download') .page {
        width: 100%;
        border: 2px solid #1a2b5e;
        padding: 0;
      }

      @else .page {
        width: 50%;
        border: 2px solid #1a2b5e;
        padding: 0;
      }

      @endif

      /* ── HEADER ── */
      .header {
        background-color: #1a2b5e;
        padding: 14px 20px 10px;
        text-align: center;
      }

      .org-name {
        font-size: 20px;
        font-weight: bold;
        color: #ffffff;
        letter-spacing: 0.3px;
      }

      .org-sub {
        font-size: 13px;
        font-style: italic;
        color: #c8a84b;
        margin: 3px 0 4px;
      }

      .org-addr {
        font-size: 15px;
        color: #c8d0e8;
      }

      .gold-divider {
        height: 2px;
        background-color: #c8a84b;
        margin-top: 8px;
      }

      /* ── FORM TITLE ── */
      .form-title-bar {
        text-align: center;
        padding: 7px 0 6px;
        border-bottom: 1px solid #ccd3e0;
      }

      .form-title {
        font-size: 12px;
        font-weight: bold;
        color: #1a2b5e;
        letter-spacing: 1.5px;
        text-transform: uppercase;
      }

      /* ── BODY ── */
      .body {
        padding: 14px 20px 6px;
      }

      /* ── TOP NAME + PHOTO ROW ── */
      .top-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 6px;
      }

      .top-table td {
        vertical-align: top;
        padding: 0;
      }

      .photo-box {
        width: 100px;
        height: 118px;
        border: 1.5px dashed #888;
        text-align: center;
        font-size: 15px;
        color: #666;
        padding-top: 36px;
        line-height: 1.6;
      }

      .photo-caption {
        font-size: 15px;
        color: #666;
        text-align: right;
        margin-top: 3px;
      }

      /* ── FIELDS ── */
      .field {
        margin-bottom: 15px;
      }

      .field-label {
        font-size: 14px;
        font-weight: bold;
        color: #1a2b5e;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: block;
        margin-bottom: 1px;
      }

      .field-sublabel {
        font-weight: normal;
        font-size: 15px;
        color: #555;
        text-transform: none;
        letter-spacing: 0;
      }

      .field-line {
        border: none;
        border-bottom: 1px solid #6a7a9b;
        width: 100%;
        height: 16px;
        display: block;
      }

      .field-box {
        border: 1px solid #9aa3bc;
        width: 100%;
        height: 28px;
        display: block;
        margin-top: 2px;
      }

      /* ── SECTION BAR ── */
      .section-bar {
        background-color: #1a2b5e;
        color: #ffffff;
        font-size: 15.5px;
        font-weight: bold;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 4px 10px;
        margin: 12px -20px 8px;
        width: calc(100% + 40px);
      }

      /* ── GRID ROWS ── */
      .row-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 8px;
      }

      .row-table td {
        vertical-align: bottom;
        padding: 0 6px 0 0;
      }

      .row-table td:last-child {
        padding-right: 0;
      }

      /* ── PROFESSIONAL ── */
      .prof-row {
        margin-bottom: 6px;
      }

      .prof-inline {
        display: inline;
      }

      .checkbox-wrap {
        display: inline-block;
        margin-right: 12px;
        font-size: 12px;
        color: black !important;
        font-weight: bold;
      }

      .chk {
        display: inline-block;
        width: 10px;
        height: 10px;
        border: 1px solid #333;
        margin-right: 3px;
        vertical-align: middle;
      }

      .tick-note {
        font-size: 9px;
        color: #555;
        font-style: italic;
      }

      /* ── KYC ── */
      .kyc-aadhaar {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 8px;
      }

      .kyc-aadhaar td {
        vertical-align: bottom;
        padding: 0 6px 0 0;
        width: 50%;
      }

      .kyc-aadhaar td:last-child {
        padding-right: 0;
      }

      .kyc-list-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 8px;
      }

      .kyc-list-table td {
        vertical-align: bottom;
        padding: 2px 4px 2px 0;
        width: 50%;
      }

      .kyc-item-row {
        display: flex;
        align-items: flex-end;
        gap: 4px;
      }

      .kyc-num {
        font-weight: bold;
        color: #1a2b5e;
        font-size: 11px;
        white-space: nowrap;
      }

      .kyc-text {
        font-size: 15.5px;
        color: black;
        white-space: nowrap;
      }

      /* ── DECLARATION ── */
      .declaration-box {
        border: 1px solid #b0b8cc;
        padding: 10px 12px;
        background: #f9fafc;
        font-style: italic;
        font-size: 15px;
        line-height: 1.65;
        color: #222;
        margin-bottom: 12px;
      }

      /* ── SIGNATURE ── */
      .sig-area {
        text-align: right;
        padding: 0 20px 12px;
      }

      .sig-space {
        height: 30px;
      }

      .sig-line {
        border-top: 1px solid #555;
        padding-top: 3px;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: bold;
        color: #444;
        width: 180px;
        display: inline-block;
        text-align: center;
      }

      /* ── OFFICE USE ── */
      .office-section {
        padding: 0 20px 16px;
      }

      .office-scrutiny {
        font-size: 15px;
        font-weight: bold;
        color: #1a2b5e;
        margin-bottom: 2px;
      }

      .office-sub {
        font-size: 15px;
        color: #666;
        margin-bottom: 6px;
      }

      .office-rec-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 8px;
      }

      .office-rec-table td {
        font-size: 15px;
        width: 50%;
        padding: 2px 0;
      }

      .sign-boxes-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
      }

      .sign-boxes-table td {
        width: 50%;
        padding: 0 6px 0 0;
      }

      .sign-boxes-table td:last-child {
        padding: 0;
      }

      .sign-box {
        border: 1px solid #9aa3bc;
        text-align: center;
        padding: 18px 10px 6px;
        font-size: 15px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .mem-date-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
      }

      .mem-date-table td {
        width: 50%;
        vertical-align: bottom;
        padding: 0 10px 0 0;
      }

      .mem-date-table td:last-child {
        padding: 0;
      }

      .mem-label {
        font-size: 15px;
        font-weight: bold;
        color: #1a2b5e;
        margin-bottom: 2px;
      }

      /* ── FOOTER ── */
      .footer {
        text-align: center;
        font-size: 15px;
        color: #555;
        border-top: 1px solid #ccd3e0;
        padding: 6px 0 8px;
        margin-top: 4px;
      }
    </style>
  </head>

  <body>
    <div style="display:flex; justify-content:center; padding:30px 10px; min-height:100vh; background:#dde3ed;">
      <div class="page">

        {{-- HEADER --}}
        <div class="header">
          <div class="org-name">Distt. Taxation Bar Association (Regd.)</div>
          <div class="org-sub">(DIRECT TAXES)</div>
          <div class="org-addr">Aaykar Bhawan, Rishi Nagar, Ludhiana</div>
          <div class="gold-divider"></div>
        </div>

        {{-- FORM TITLE --}}
        <div class="form-title-bar">
          <div class="form-title">Application Form for Membership</div>
        </div>

        {{-- BODY --}}
        <div class="body">

          {{-- NAME + PHOTO --}}
          <table class="top-table">
            <tr>
              <td>
                <div class="field">
                  <span class="field-label">Full Name
                    <span class="field-sublabel">(Name in Block / Capital Letters)</span>
                  </span>
                  <div class="field-line">muthu</div>
                </div>
                <div class="field" style="margin-top:6px;">
                  <span class="field-label">Son of / Daughter of</span>
                  <div class="field-line">velusamy</div>
                </div>
              </td>
              <td style="width:108px; padding-left:12px; vertical-align:top;">
                <div class="photo-box">Passport<br>Size<br>Photo</div>
                <div class="photo-caption">Photograph</div>
              </td>
            </tr>
          </table>

          {{-- CONTACT DETAILS --}}
          <div class="section-bar">Contact Details</div>

          <div class="field">
            <span class="field-label">Residential Address</span>
            <div class="field-box"></div>
          </div>

          <div class="field">
            <span class="field-label">Office Address</span>
            <div class="field-box"></div>
          </div>

          <table class="row-table">
            <tr>
              <td>
                <span class="field-label">Ph. (Office)</span>
                <div class="field-line"></div>
              </td>
              <td>
                <span class="field-label">Ph. (Residence)</span>
                <div class="field-line"></div>
              </td>
              <td>
                <span class="field-label">Mobile No.</span>
                <div class="field-line"></div>
              </td>
            </tr>
          </table>

          <div class="field" style="margin-top:8px;">
            <span class="field-label">Email Address</span>
            <div class="field-line"></div>
          </div>

          {{-- PROFESSIONAL DETAILS --}}
          <div class="section-bar">Professional Details</div>

          <div class="field prof-row">
            <span class="field-label" style="display:inline;">Professional Area:</span>
            &nbsp;&nbsp;
            <span class="checkbox-wrap"><span class="chk"></span> CA</span>
            <span class="checkbox-wrap"><span class="chk"></span> CS</span>
            <span class="checkbox-wrap"><span class="chk"></span> Advocate</span>
            <span class="checkbox-wrap"><span class="chk"></span> ITP</span>
            <span class="tick-note">(Please tick one only)</span>
          </div>

          <div class="field">
            <span class="field-label">Membership / Enrolment No.
              <span class="field-sublabel">(if applicable)</span>
            </span>
            <div class="field-line"></div>
          </div>

          {{-- KYC & ENCLOSURES --}}
          <div class="section-bar">KYC &amp; Enclosures</div>

          <table class="kyc-aadhaar">
            <tr>
              <td>
                <span class="field-label">Aadhaar Card No.</span>
                <div class="field-line"></div>
              </td>
              <td>
                <span class="field-label">PAN Card No.</span>
                <div class="field-line"></div>
              </td>
            </tr>
          </table>

          <table class="kyc-list-table" style="margin-top:6px;">
            <tr>
              <td>
                <table width="100%">
                  <tr>
                    <td style="width:14px; vertical-align:bottom; padding-bottom:2px;">
                      <span class="kyc-num">1.</span>
                    </td>
                    <td style="vertical-align:bottom; padding-bottom:2px; padding-right:4px;">
                      <span class="kyc-text">KYC Document (Aadhaar / PAN / Passport)</span>
                    </td>
                    <td style="vertical-align:bottom;">
                      <div class="field-line"></div>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%">
                  <tr>
                    <td style="width:14px; vertical-align:bottom; padding-bottom:2px;">
                      <span class="kyc-num">2.</span>
                    </td>
                    <td style="vertical-align:bottom; padding-bottom:2px; padding-right:4px;">
                      <span class="kyc-text">Proof of Qualification</span>
                    </td>
                    <td style="vertical-align:bottom;">
                      <div class="field-line"></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding-top:6px;">
                <table width="100%">
                  <tr>
                    <td style="width:14px; vertical-align:bottom; padding-bottom:2px;">
                      <span class="kyc-num">3.</span>
                    </td>
                    <td style="vertical-align:bottom; padding-bottom:2px; padding-right:4px;">
                      <span class="kyc-text">Practice Certificate or evidence of practice</span>
                    </td>
                    <td style="vertical-align:bottom;">
                      <div class="field-line"></div>
                    </td>
                  </tr>
                </table>
              </td>
              <td style="padding-top:6px;">
                <table width="100%">
                  <tr>
                    <td style="width:14px; vertical-align:bottom; padding-bottom:2px;">
                      <span class="kyc-num">4.</span>
                    </td>
                    <td style="vertical-align:bottom; padding-bottom:2px; padding-right:4px;">
                      <span class="kyc-text">Fees Paid — Amount (Rs.)</span>
                    </td>
                    <td style="vertical-align:bottom;">
                      <div class="field-line"></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding-top:6px;">
                <table width="100%">
                  <tr>
                    <td style="width:14px; vertical-align:bottom; padding-bottom:2px;">
                      <span class="kyc-num">5.</span>
                    </td>
                    <td style="vertical-align:bottom; padding-bottom:2px; padding-right:4px;">
                      <span class="kyc-text">Transaction No. / Cheque No. / Receipt No.</span>
                    </td>
                    <td style="vertical-align:bottom;">
                      <div class="field-line"></div>
                    </td>
                  </tr>
                </table>
              </td>
              <td style="padding-top:6px;">
                <table width="100%">
                  <tr>
                    <td style="width:14px; vertical-align:bottom; padding-bottom:2px;">
                      <span class="kyc-num">6.</span>
                    </td>
                    <td style="vertical-align:bottom; padding-bottom:2px; padding-right:4px;">
                      <span class="kyc-text">Date of Payment</span>
                    </td>
                    <td style="vertical-align:bottom;">
                      <div class="field-line"></div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

          {{-- DECLARATION --}}
          <div class="section-bar">Declaration</div>

          <div class="declaration-box">
            I hereby apply for being enrolled as a Member of the
            <strong>Distt. Taxation Bar Association (Regd.) (Direct Taxes), Ludhiana</strong>.
            I hereby confirm and undertake that the information furnished above is true and correct
            in all respects and that I fulfil the eligibility criteria to become a member.
            I further undertake to abide by the Memorandum and By-Laws of the Association.
          </div>

        </div>{{-- /body --}}

        {{-- SIGNATURE --}}
        <div class="sig-area">
          <div class="sig-space"></div>
          <span class="sig-line">Signature of Applicant</span>
        </div>

        {{-- FOR OFFICE USE ONLY --}}
        <div class="office-section">
          <div class="section-bar" style="margin-left:-20px; margin-right:-20px;">For Office Use Only</div>

          <div class="office-scrutiny">Scrutiny by Jt. Secretary:</div>
          <div class="office-sub">(Status, Date &amp; Remarks, if any)</div>

          <table class="office-rec-table">
            <tr>
              <td>Recommended &nbsp;/&nbsp; Not Recommended</td>
              <td>Admitted &nbsp;/&nbsp; Not Admitted</td>
            </tr>
          </table>

          <table class="sign-boxes-table">
            <tr>
              <td>
                <div class="sign-box">(SECRETARY)</div>
              </td>
              <td>
                <div class="sign-box">(PRESIDENT)</div>
              </td>
            </tr>
          </table>

          <table class="mem-date-table">
            <tr>
              <td>
                <div class="mem-label">Membership Number Assigned:</div>
                <div class="field-line"></div>
              </td>
              <td>
                <div class="mem-label">Date:</div>
                <div class="field-line"></div>
              </td>
            </tr>
          </table>
        </div>

        {{-- FOOTER --}}
        <div class="footer">
          Distt. Taxation Bar Association (Regd.) &bull; Aaykar Bhawan, Rishi Nagar, Ludhiana
        </div>

      </div>
    </div>
  </body>

</html>