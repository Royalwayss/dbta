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
            <h1>Media Management</h1>
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
                  <a href="{{ url('admin/add-edit-case-law-section/'.$prevId) }}" class="btn btn-primary btn-animated-link"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Previous Case law Section</a>
                @endif
                @if($nextId!=0)
                  <a href="{{ url('admin/add-edit-case-law-section/'.$nextId) }}" class="btn btn-primary btn-animated-link"> Next Case law Section  <i class="fas fa-arrow-right"></i> </a>
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
                <form name="categoryForm" id="categoryForm" action="{{ url('admin/add-edit-case-law-section') }}" method="post" enctype="multipart/form-data">@csrf
                @if(!empty($row['id']))
                  <input type="hidden" name="id" value="{{ $row['id'] }}">
                @endif
                <div class="card-body">
                  <div class="row">
				  <div class="form-group col-md-6">
                    <label for="section">Section*</label>
                    <input type="text" class="form-control" id="section" name="section" placeholder="Enter Section" @if(!empty($row['section'])) value="{{ $row['section'] }}" @else value="{{ old('section') }}" @endif required>
                  </div>
				  <div class="form-group col-md-6">
                    <label for="mediasort">Sort*</label>
                    <input type="number" class="form-control" id="sort" name="sort" placeholder="Enter Sort" @if(!empty($row['sort'])) value="{{ $row['sort'] }}" @else value="{{ old('sort') }}" @endif  required>
                  </div>
				  
				   <div class="form-group col-md-6">
					  <label for="status">Status*</label>
					 <select class="form-control"  name="status" required="">

						   <option  value="1" @if(empty($row['status']) || $row['status'] == '1') selected @endif  >Active</option>
						   <option value="0" @if($row['status'] == '0') selected @endif>InActive</option>
					</select>
				   </div>
                  
				  <div class="form-group col-md-12">
                              <label class="col-md-4 control-label">Files: </label>
                              <div class="col-md-12">
                                 <table  class="table table-hover table-bordered table-striped" id="pdf-table" >
                                    <tbody>
                                       <tr>
                                          <th width="20%">Pdf</th>
                                          <th width="40%">Title</th>
                                          <th width="10%">Sort</th>
                                          <th width="15%">Status</th>
                                          <th width="10%">Actions</th>
                                       </tr>
                                      
                                       @foreach(@$row['pdf_files'] as $key=>$pdf)
                                       <tr class="blockIdWrap" id="pdf-file-{{ $pdf['id'] }}">
                                          <td>
										     <input type="hidden" name="pdf_id[]" value="{{ $pdf['id'] }}">
                                             <a target="_blank" href="{{ asset('front/pdf/caselaws//'.$pdf['file']) }}" >View File </a>
                                          </td>
										  <td>
										     <input type="numer" name="edit_title_{{ $pdf['id'] }}" class="form-control" value="{{ $pdf['title'] }}" required>
										  </td>
										  <td>
										     <input type="numer" name="edit_sort_{{ $pdf['id'] }}" class="form-control" value="{{ $pdf['sort'] }}" required>
										  </td>
										  <td>
										     <select class="form-control"  name="edit_status_{{ $pdf['id'] }}" required="">
												   <option value="">Select</option>
												   <option  value="1" @if($pdf['status'] == '1') selected @endif  >Active</option>
												   <option value="0" @if($pdf['status'] == '0') selected @endif>InActive</option>
											</select>
                                          <td>
                                             <a class="btn btn-danger deleteFile" href="javascript:void(0);"  data-id="{{ $pdf['id'] }}" ><i class="fa fa-times"></i></a>
                                          </td>
                                       </tr>
                                       @endforeach
                                       <tr class="blockIdWrap">
                                          <td>
                                             <input type="file" class="form-control" name="files[]">
                                          </td>
										  <td>
										     <input type="text" name="title[]" class="form-control">
										  </td>
										   <td>
										     <input type="numer" name="pdf_sort[]" class="form-control">
										  </td>
										  <td>
										     <select class="form-control"  name="pdf_status[]" required="">
												   <option value="">Select</option>
												   <option  value="1" selected  >Active</option>
												   <option value="0">InActive</option>
											</select>
										  </td>
                                          <td><input type="button" id="addImageRow" value="Add More" /></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
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
  
<table class="table table-hover table-bordered table-striped imagesamplerow" style="display:none;">
	<tbody>
		<tr class="appenderTr blockIdWrap">
			<td>
				<input type="file" class="form-control" name="images[]">
			</td>
			<td>
				 <input type="text" name="title[]" class="form-control">
			 </td>
			<td>
				<input type="numer" name="pdf_sort[]" class="form-control">
			</td>
			<td>
					<select class="form-control"  name="pdf_status[]" required="">
					<option value="">Select</option>
					<option  value="1" selected >Active</option>
					<option value="0">InActive</option>
					</select>
			</td>
			<td class="text-center">
				<a  class="btn btn-danger imageRowRemove" href="javascript:void(0);"><i class="fa fa-times"></i>                                           </a>
			</td>
		</tr>
	</tbody>
</table> 
  
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script>
$(document).ready(function () {
	   $("#addImageRow").click(function() {        
			var row = jQuery('.imagesamplerow tr').clone(true);
			row.appendTo('#pdf-table');        
		});
        $('.imageRowRemove').on("click", function() {
			$(this).parents("tr").remove();
		});
		
		$('.deleteFile').on("click", function() {
			   $('.preloader').show();
				var id = $(this).attr("data-id");
				var deleteURL = "{{ url('admin/delete-law-section-pdf') }}/"+id;
				$.ajax({
					url:deleteURL,
					type:'get',
					success:function(data) { 
						$("#pdf-file-"+id).remove();
					}
				});
			     $('.preloader').hide();
		
	
     });
		
	
});


</script>
@endsection