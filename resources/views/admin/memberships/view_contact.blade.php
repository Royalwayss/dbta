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
          <h1 class="m-0">View Contact</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{'/admin/dashboard'}}">Home</a></li>
            <li class="breadcrumb-item active">Contacts</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">Contact Form Details</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table class="table table-bordered">
                        <tbody>
                           <tr>
                              <th style="width:20%">Name</th>
                              <td style="width:80%">{{ $contact['name'] }}</td>
                           </tr>
                           <tr>
                              <th>Email</th>
                              <td>{{ $contact['email'] }}</td>
                           </tr>
                           <tr>
                              <th>Mobile</th>
                              <td>{{ $contact['mobile'] }}</td>
                           </tr>
                            <tr>
                              <th>Subject</th>
                              <td>{{ $contact['subject'] }}</td>
                           </tr>
                            <tr>
                              <th>Message</th>
                              <td>{{ $contact['message'] }}</td>
                           </tr>
                           <tr>
                              <th>Created At</th>
                              <td>{{ date("M j, Y, g:i a", strtotime($contact['created_at'])); }}</td>
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