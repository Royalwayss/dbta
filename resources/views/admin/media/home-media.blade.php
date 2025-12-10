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
            <h1>Home Media Management</h1>
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
                <form name="categoryForm" id="categoryForm" action="{{ url('admin/add-edit-home-media') }}" method="post" enctype="multipart/form-data">@csrf
               
                <div class="card-body">
                  <div class="row">
				
                  
				  <div class="form-group col-md-12">
                              <label class="col-md-4 control-label">Images: <small style="color:red">Image Dimensions (745 X 500)</small></label>
                              <div class="col-md-12">
                                 <table  class="table table-hover table-bordered table-striped" id="image-table" >
                                    <tbody>
                                       <tr>
                                          <th width="35%">Image</th>
                                          <th width="20%">Sort</th>
                                          <th width="25%">Status</th>
                                          <th width="20%">Actions</th>
                                       </tr>
                                      
										
                                       @foreach($images as $key=>$media_image)
                                       <tr class="blockIdWrap" id="media-file-{{ $media_image['id'] }}">
                                          <td>
										  <input type="hidden" name="media_id[]" value="{{ $media_image['id'] }}">
                                             <img src="{{ asset('front/images/home-media/'.$media_image['media_file']) }}" style="width:100px">
                                          </td>
										  <td>
										     <input type="numer" name="edit_media_sort_{{ $media_image['id'] }}" class="form-control" value="{{ $media_image['sort'] }}" required>
										  </td>
										  <td>
										     <select class="form-control"  name="edit_status_{{ $media_image['id'] }}" required="">
												   <option value="">Select</option>
												   <option  value="1" @if($media_image['status'] == '1') selected @endif  >Active</option>
												   <option value="0" @if($media_image['status'] == '0') selected @endif>InActive</option>
											</select>
                                          <td>
                                             <a class="btn btn-danger deleteHomeMedia" href="javascript:void(0);"  data-id="{{ $media_image['id'] }}" ><i class="fa fa-times"></i></a>
                                          </td>
                                       </tr>
                                       @endforeach
                                      
                                       <tr class="blockIdWrap">
                                          <td>
                                             <input type="file" class="form-control" name="images[]">
                                          </td>
										   <td>
										     <input type="numer" name="media_sort[]" class="form-control">
										  </td>
										  <td>
										     <select class="form-control"  name="status[]" required="">
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
                
				   <div class="form-group col-md-12">
                              <label class="col-md-12 control-label">Videos:</label>
                              <div class="col-md-12">
                                 <table  class="table table-hover table-bordered table-striped" id="video-table" >
                                    <tbody>
                                       <tr>
                                          <th width="35%">Embed Link</th>
                                          <th width="20%">Sort</th>
                                          <th width="25%">Status</th>
                                          <th width="20%">Actions</th>
                                       </tr>
                                      
										
                                       @foreach($videos as $key=>$video)
                                       <tr class="blockIdWrap" id="media-file-{{ $video['id'] }}">
                                          <td>
										  <input type="hidden" name="video_id[]" value="{{ $video['id'] }}">
                                             <input type="url" class="form-control" name="edit_video_url[]" value="{{ $video['media_file'] }}" >
                                          </td>
										  <td>
										     <input type="numer" name="edit_video_sort_{{ $video['id'] }}" class="form-control" value="{{ $video['sort'] }}" required>
										  </td>
										  <td>
										     <select class="form-control"  name="edit_video_status_{{ $video['id'] }}" required="">
												  
												  <option  value="1" @if($video['status'] == '1') selected @endif  >Active</option>
												   <option value="0" @if($video['status'] == '0') selected @endif>InActive</option>
											</select>
											
										
											
											
											
                                          <td>
                                             <a class="btn btn-danger deleteHomeMedia" href="javascript:void(0);"  data-id="{{ $video['id'] }}" ><i class="fa fa-times"></i></a>
                                          </td>
                                       </tr>
                                       @endforeach
                                      
                                       <tr class="blockIdWrap">
                                          <td>
                                             <input type="url" class="form-control" name="video_url[]" >
                                          </td>
										   <td>
										     <input type="numer" name="video_sort[]" class="form-control">
										  </td>
										  <td>
										     <select class="form-control"  name="video_status[]" required="">
												   <option value="">Select</option>
												   <option  value="1" selected  >Active</option>
												   <option value="0">InActive</option>
											</select>
										  </td>
                                          <td><input type="button" id="addVideoRow" value="Add More" /></td>
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
				<input type="numer" name="media_sort[]" class="form-control">
			</td>
			<td>
					<select class="form-control"  name="status[]" required="">
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



<table class="table table-hover table-bordered table-striped videosamplerow" style="display:none;">
	<tbody>
		<tr class="appenderTr blockIdWrap">
			<tr class="appenderTr blockIdWrap">
			 <td>
                                             <input type="url" class="form-control" name="video_url[]" >
                                          </td>
										   <td>
										     <input type="numer" name="video_sort[]" class="form-control">
										  </td>
										  <td>
										     <select class="form-control"  name="video_status[]" required="">
												   <option value="">Select</option>
												   <option  value="1" selected  >Active</option>
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
			row.appendTo('#image-table');        
		});
        $('.imageRowRemove').on("click", function() {
			$(this).parents("tr").remove();
		});
		
		
		$("#addVideoRow").click(function() {        
			var row = jQuery('.videosamplerow tr').clone(true);
			row.appendTo('#video-table');        
		});
		
		
		
		
		
		
		
		$('.deleteHomeMedia').on("click", function() {
			   $('.preloader').show();
				var id = $(this).attr("data-id");
				var deleteURL = "{{ url('admin/delete-home-media') }}/"+id;
				$.ajax({
					url:deleteURL,
					type:'get',
					success:function(data) { 
						$("#media-file-"+id).remove();
					}
				});
			     $('.preloader').hide();
		
	
     });
		
	
});


</script>
@endsection