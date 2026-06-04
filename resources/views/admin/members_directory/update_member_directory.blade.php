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
          <h1>Update Members Directory</h1>
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
    <section class="row">
      <div class="col-md-6">
        <div class="container-fluid">

          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Export Member Directory</h3>

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


                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success:</strong> {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <form  action="{{ url('admin/export-member-directory') }}" method="post" enctype="multipart/form-data">@csrf
                  @if(!empty($row['id']))
                  <input type="hidden" name="id" value="{{ $row['id'] }}">
                  @endif
                  <div class="card-body">
                    <div class="row">

                      <div class="form-group col-md-6">
                        <label for="from_serial_no">From Serial No</label>
                        <input type="number" class="form-control" id="from_serial_no" name="from_serial_no" placeholder="From Serial No">
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="to_serial_no">To Serial No</label>
                        <input type="number" class="form-control" id="to_serial_no" name="to_serial_no" placeholder="To Serial No">
                      </div>

                       

                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div>
                    <button type="submit" class="btn btn-primary">Export Excel Sheet</button>
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
      </div>

     <div class="col-md-6">
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
                <form  action="{{ url('admin/import-member-directory') }}" method="post" enctype="multipart/form-data">@csrf
                  @if(!empty($row['id']))
                  <input type="hidden" name="id" value="{{ $row['id'] }}">
                  @endif
                  <div class="card-body">
                    <div class="row">

                      <div class="form-group col-md-12">
                        <label for="file">File (xlsx)</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                      </div>
					  
					 
                       

                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div>
                    <button type="submit" class="btn btn-primary">Import Excel Sheet</button>
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
      </div>

</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {});
</script>
@endsection