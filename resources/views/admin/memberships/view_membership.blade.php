@extends('admin.layout.layout')
@section('content')
<style>
   /* Action Icon Hover Effect */
   a .fas {
   transition: color 0.3s ease, transform 0.3s ease;
   }
   a:hover .fas {
   color: #1E90FF; /* Vibrant blue color on hover */
   transform: scale(1.2); /* Slightly enlarge icon */
   }
   /* Action Icons for Better Visibility */
   a .fas.fa-toggle-on {
   color: #28a745; /* Green for Active */
   }
   a .fas.fa-toggle-off {
   color: #dc3545; /* Red for Inactive */
   }
   a .fas.fa-edit {
   color: #ffc107; /* Yellow for Edit */
   }
   a .fas.fa-trash {
   color: #dc3545; /* Red for Delete */
   }
   a .fas.fa-unlock {
   color: #17a2b8; /* Teal for Update Role */
   }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">View Membership</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{'/admin/dashboard'}}">Home</a></li>
                  <li class="breadcrumb-item active">Membership</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">Membership Form Details</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table class="table table-bordered">
                        <tbody>
                           <tr>
                              <th style="width:30%">Name</th>
                              <td style="width:70%">{{ $contact['name'] }}</td>
                           </tr>
                           <tr>
                              <th style="width:30%"> S/O - D/O</th>
                              <td style="width:70%">{{ $contact['parent_name'] }}</td>
                           </tr>
                           <tr>
                         
						   
                           <tr>
                              <th style="width:30%"> Phone Office</th>
                              <td style="width:70%">{{ $contact['phone_office'] }}</td>
                           </tr>
                           <tr>
                              <th style="width:30%">Phone Residence</th>
                              <td style="width:70%">{{ $contact['phone_residence'] }}</td>
                           </tr>
                           <tr>
                              <th style="width:30%">Mobile</th>
                              <td style="width:70%">{{ $contact['mobile'] }}</td>
                           </tr>
                           <tr>
                              <th>Email</th>
                              <td>{{ $contact['email'] }}</td>
                           </tr>
						   
						        <th style="width:30%">Residence Address</th>
                              <td style="width:70%">{{ $contact['residence_address'] }}</td>
                           </tr>
                           <tr>
                              <th style="width:30%">Office Address</th>
                              <td style="width:70%">{{ $contact['office_address'] }}</td>
                           </tr>
						   <tr>
                              <th style="width:30%"> Aadhaar Card No</th>
                              <td style="width:70%">{{ $contact['aadhaar_no'] }}</td>
                           </tr>
						  <tr>
                              <th style="width:30%"> Pan Card No</th>
                              <td style="width:70%">{{ $contact['pan_no'] }}</td>
                           </tr>
                           <tr>
                              <th>Professional Area</th>
                              <td>{{ $contact['professional_area'] }}</td>
                           </tr>
						   
						   
						   
                           <tr style="display:none">
                              <th>Membership No. (or other Enrolment No., if applicable)</th>
                              <td>{{ $contact['membership_no'] }}</td>
                           </tr>
                           <tr>
                              <th>KYC</th>
                              <td>
                                 @if(!empty($contact['kyc']))
                                 <a target="_black" href="{{ asset('uploads/kyc/'.$contact['kyc']) }}">View File</a>
                                 @endif
                              </td>
                           </tr>
                           <tr>
                              <th>Qualification Proof</th>
                              <td>
                                 @if(!empty($contact['qualification_proof']))
                                 <a target="_black" href="{{ asset('uploads/qualification_proof/'.$contact['qualification_proof']) }}">View File</a>
                                 @endif
                              </td>
                           </tr>
                           <tr>
                              <th>Practice Certificate / Evidence of Practice</th>
                              <td>
                                 @if(!empty($contact['practice_certificate']))
                                 <a target="_black" href="{{ asset('uploads/practice_certificate/'.$contact['practice_certificate']) }}">View File</a>
                                 @endif
                              </td>
                           </tr>
                           <tr style="display:none">
                              <th>Fees Paid Amount (Rs.)</th>
                              <td>{{ $contact['fees_paid_amount'] }}</td>
                           </tr>
                           <tr style="display:none">
                              <th>Transaction / Cheque / Receipt No.</th>
                              <td>{{ $contact['transaction_id'] }}</td>
                           </tr>
                           <tr style="display:none">
                              <th>Date of Payment</th>
                              <td>
							  @if(!empty($contact['date_of_payment']))
							  {{ date("M j, Y", strtotime($contact['date_of_payment'])) }}
							  @endif
							  </td>
                           </tr>
                           <tr>
                              <th>Signature of Applicant</th>
                              <td>
                                 @if(!empty($contact['signature_of_applicant']))
                                 <a target="_black" href="{{ asset('uploads/signature_of_applicant/'.$contact['signature_of_applicant']) }}">View File</a>
                                 @endif
                              </td>
                           </tr>
						   <tr>
                              <th>Profile Photo</th>
                              <td>
                                 @if(!empty($contact['photo']))
                                 <a target="_black" href="{{ asset('uploads/photo/'.$contact['photo']) }}">View Profile</a>
                                 @endif
                              </td>
                           </tr>
                           <tr>
                              <th>Any Remarks</th>
                              <td>{{ $contact['remarks'] }}</td>
                           </tr>
                           <tr>
                              <th>Created At</th>
                              <td>{{ date("M j, Y, g:i a", strtotime($contact['created_at'])) }}</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <!-- /.card-body -->
               </div>
            </div>
         </div>
         <!-- /.col -->
      </div>
   </section>
</div>
<!-- /.content-wrapper -->
@endsection