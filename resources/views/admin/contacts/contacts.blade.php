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
          <h1 class="m-0">Contacts Management</h1>
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

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success:</strong> {{ Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <div class="card">
             
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Subject</th>
                     
                      <th>Date</th>
                      <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($rows as $row)
                  <tr>
                      <td>{{ $row['id'] }}</td>
                      <td>{{ $row['name'] }}</td>
                      <td>{{ $row['email'] }}</td>
                      <td>{{ $row['mobile'] }}</td>
                      <td>{{ $row['subject'] }}</td>
                      
                    <td>{{ date("M j, Y, g:i a", strtotime($row['created_at'])); }}</td>
                    <td ><a @if($row['view_status'] == 0) style="color:red" @else style="color:green" @endif href="{{ asset('admin/view-contact/'.$row['id']) }}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                  </tr>
                  @endforeach
                  </tbody> 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection