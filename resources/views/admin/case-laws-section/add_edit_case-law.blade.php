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
            <h1>Case Laws Management</h1>
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
                  <a href="{{ url('admin/add-edit-case-law/'.$prevId) }}" class="btn btn-primary btn-animated-link"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Previous Download</a>
                @endif
                @if($nextId!=0)
                  <a href="{{ url('admin/add-edit-case-law/'.$nextId) }}" class="btn btn-primary btn-animated-link"> Next Download  <i class="fas fa-arrow-right"></i> </a>
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
                <form name="categoryForm" id="categoryForm" action="{{ url('admin/add-edit-case-law') }}" method="post" enctype="multipart/form-data">@csrf
                @if(!empty($row['id']))
                  <input type="hidden" name="id" value="{{ $row['id'] }}">
                @endif
                <div class="card-body">
                  <div class="row">
				  <div class="form-group col-md-6">
                    <label for="category_name">Title*</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" @if(!empty($row['title'])) value="{{ $row['title'] }}" @else value="{{ old('title') }}" @endif  required>
                  </div>
				  
				    <div class="form-group col-md-6">
                    <label for="pdf">Pdf</label>
                    <input type="file" class="form-control" id="pdf" name="pdf">
					@if(!empty($row['pdf']))
					<a target="_block" href="{{ asset('front/pdf/caselaws/'.$row['pdf']) }}">View Pdf</a>
				   @endif
                  </div>
                

				  
				  <div class="form-group col-md-12">
                           <label for="event_description">Description</label>
                           <textarea class="form-control" rows="3" id="caselaws_description" name="description" placeholder="Enter Meeting Description">@if(!empty($row['description'])) {{ $row['description'] }} @else {{ old('description') }} @endif</textarea>
                           </div>
				  
				  
				  
				  
                 
                   
				  <div class="form-group col-md-6">
                    <label for="sort">Sort</label>
                    <input type="no" class="form-control" id="sort" name="sort" placeholder="Sort" @if(!empty($row['sort'])) value="{{ $row['sort'] }}" @else value="{{ old('sort') }}" @endif required>
                  </div>
                 

				
                 
                 <div class="form-group col-md-6">
                      <label for="link">Status</label>
                      <select class="form-control"  name="status" required="">
						   <label for="status">Status*</label>
						   <option  value="1" @if(empty($row['status']) || $row['status'] == '1') selected @endif  >Active</option>
						   <option value="0" @if($row['status'] == '0') selected @endif>InActive</option>
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
	 $('#caselaws_description').summernote()
});
</script>
@endsection