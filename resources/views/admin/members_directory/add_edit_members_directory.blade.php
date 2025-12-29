<style>
  .btn-animated-link {
  display: inline-flex;
  align-items: center;
  text-decoration: none;
  transition: all 0.3s ease;
}

.btn-animated-link i {
  margin-right: 5px;
  transition: transform 0.3s ease;
}

.btn-animated-link:hover {
  background-color: #0056b3;
  color: white;
}

.btn-animated-link:hover i {
  transform: translateX(-5px);
}

.btn-animated-link:last-child i {
  margin-left: 5px;
  margin-right: 0;
}

.btn-animated-link:last-child:hover i {
  transform: translateX(5px);
}    
</style>
@extends('admin.layout.layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Events Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{'/admin/dashboard'}}">Home</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div style="float:right;">
                @if($prevId!=0)
                  <a href="{{ url('admin/add-edit-member-directory/'.$prevId) }}" class="btn btn-primary btn-animated-link"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Previous Member Directory</a>
                @endif
                @if($nextId!=0)
                  <a href="{{ url('admin/add-edit-member-directory/'.$nextId) }}" class="btn btn-primary btn-animated-link"> Next Member Directory  <i class="fas fa-arrow-right"></i> </a>
                @endif
                </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success:</strong> {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <form name="categoryForm" id="categoryForm" action="{{ url('admin/add-edit-member-directory') }}" method="post" enctype="multipart/form-data">@csrf
                @if(!empty($row['id']))
                  <input type="hidden" name="id" value="{{ $row['id'] }}">
                @endif
                <div class="card-body">
                  <div class="row">
				 
                   
				   
				   <div class="form-group col-md-6">
                    <label for="role">Role*</label>
                    <input type="text" class="form-control" id="role" name="role" placeholder="Role" @if(!empty($row['role'])) value="{{ $row['role'] }}" @else value="{{ old('role') }}" @endif  required>
                  </div>
				   
				   
				   
				   <div class="form-group col-md-6">
                    <label for="title">Designation Prefix*</label>
                    <select class="form-control" id="designation_prefix" name="designation_prefix"  required>
						<option value="">Select Designation</option>
						@foreach(designation_prefix() as $designation_prefix)
						<option value="{{ $designation_prefix }}" @if(!empty($row['designation_prefix']) && $row['designation_prefix'] == $designation_prefix) selected  @endif>{{ $designation_prefix }}</option>
						@endforeach
					</select>
                  </div>
				  <div class="form-group col-md-6">
                    <label for="mediasort">Member Name*</label>
                    <input type="text" class="form-control" id="member_name" name="member_name" placeholder="Name" @if(!empty($row['member_name'])) value="{{ $row['member_name'] }}" @else value="{{ old('member_name') }}" @endif  required>
                  </div>
				  
                  
                  <div class="form-group col-md-6">
                    <label for="serial_no">Serial No*</label>
                    <input type="text" class="form-control" id="serial_no" name="serial_no" placeholder="Serial No" @if(!empty($row['serial_no'])) value="{{ $row['serial_no'] }}" @else value="{{ old('serial_no') }}" @endif  required>
                  </div>
				  
				   <div class="form-group col-md-6">
                    <label for="serial_no">Contact No*</label>
                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No" @if(!empty($row['contact_no'])) value="{{ $row['contact_no'] }}" @else value="{{ old('contact_no') }}" @endif  required>
                  </div>
				  
				   
				  
				   <div class="form-group col-md-12">
                    <label for="serial_no">Address*</label>
                   <input type="text" class="form-control" id="address" name="address" placeholder="Address" @if(!empty($row['address'])) value="{{ $row['address'] }}" @else value="{{ old('address') }}" @endif  required>
				  </div>
				  
				  
				   <div class="form-group col-md-6">
                    <label for="serial_no">Email*</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" @if(!empty($row['email'])) value="{{ $row['email'] }}" @else value="{{ old('email') }}" @endif  required>
                  </div>
				  
				  <div class="form-group col-md-6">
                    <label for="sort">Sort</label>
                    <input type="no" class="form-control" id="sort" name="sort" placeholder="Event Sort" @if(!empty($row['sort'])) value="{{ $row['sort'] }}" @else value="{{ old('sort') }}" @endif required>
                  </div>
                 
                  
				
				  
				 
                
                
                 <div class="form-group col-md-6">
                      <label for="link">Status</label>
                     <select class="form-control" id="status" name="status" required="">
                           <option value="">Select</option>
                           <option @if(empty($row['status']) || $row['status']=="1") selected="" @endif value="1">Active</option>
                           <option @if( $row['status']=="0") selected="" @endif value="0">InActive</option>
                    </select>
                    </div>
                  
                </div>
                </div>
                <!-- /.card-body -->

                <div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
                <!-- /.form-group -->
             
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>
        <!-- /.card -->

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script>
$(document).ready(function () {
	 $('#event_description').summernote()
    
    
	$('#event_title').on('keyup', function() {
	  var event_title = $(this).val();
	  var event_slug = generateSlug(event_title); 
	  $("#event_slug").val(event_slug);
	});
});

function generateSlug(event_title) {
        let slug = event_title.toLowerCase();
        slug = slug.replace(/[^a-z0-9\s-]/g, ''); // Remove special characters except spaces and hyphens
        slug = slug.replace(/\s+/g, '-'); // Replace spaces with hyphens
        slug = slug.replace(/^-+|-+$/g, ''); // Remove leading/trailing hyphens
        slug = slug.replace(/-+/g, '-'); // Replace multiple hyphens with a single hyphen
        return slug;
    }
</script>
@endsection