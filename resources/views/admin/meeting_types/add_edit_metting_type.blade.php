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
               <h1>Meeting Management</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{'/admin/dashboard'}}">Home</a></li>
                  <li class="breadcrumb-item active">{{ $title }}</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
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
                        <a href="{{ url('admin/add-edit-metting-type/'.$prevId) }}" class="btn btn-primary btn-animated-link"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Previous Metting Type</a>
                        @endif
                        @if($nextId!=0)
                        <a href="{{ url('admin/add-edit-metting-type/'.$nextId) }}" class="btn btn-primary btn-animated-link"> Next  Metting Type  <i class="fas fa-arrow-right"></i> </a>
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
                  <form name="categoryForm" id="categoryForm" action="{{ url('admin/add-edit-metting-type') }}" method="post" enctype="multipart/form-data">
                     @csrf
                     @if(!empty($row['id']))
                     <input type="hidden" name="id" value="{{ $row['id'] }}">
                     @endif
                     <div class="card-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label for="category_name">Meeting Type*</label>
                              <input type="text" class="form-control" id="meeting_type" name="name" placeholder="Enter Meeting Type" @if(!empty($row['name'])) value="{{ $row['name'] }}" @else value="{{ old('name') }}" @endif pattern="[-a-zA-Z0-9_\.]+" required>
                           </div>
                          
						   
                           <div class="form-group col-md-12">
                           <label for="event_description">Meeting Description</label>
                           <textarea class="form-control" rows="3" id="meeting_description" name="description" placeholder="Enter Meeting Description">@if(!empty($row['description'])) {{ $row['description'] }} @else {{ old('description') }} @endif</textarea>
                           </div>
                          
                         
						 
						   <div class="form-group col-md-6">
								<label for="image1">Image 1 (420 X 520)</label>
								<input type="file" class="form-control" id="image1" name="image1">
								@if(!empty($row['image1']))
								<a target="_block" href="{{ asset('front/assets/images/'.$row['image1']) }}">View Image</a>
							   @endif
                          </div>
						  
						  <div class="form-group col-md-6">
								<label for="image2">Image 2 (420 X 520)</label>
								<input type="file" class="form-control" id="image2" name="image2">
								@if(!empty($row['image2']))
								<a target="_block" href="{{ asset('front/assets/images/'.$row['image2']) }}">View Image</a>
							   @endif
                          </div>
						 
                          
                           <div class="form-group col-md-6">
                           <label for="sort">Sort</label>
                           <input type="no" class="form-control" id="sort" name="sort" placeholder="Enter Sort" @if(!empty($row['sort'])) value="{{ $row['sort'] }}" @else value="{{ old('sort') }}" @endif required>
                           </div>
						   
						   
						   <div class="form-group col-md-6">
							   <label for="link">Status</label>
							   <select class="form-control" id="show_in_home" name="show_in_home" required="">
								   <option value="">Select</option>
								   <option @if(empty($row['show_in_home']) || $row['show_in_home']=="1") selected="" @endif value="1">Yes</option>
								   <option @if( $row['show_in_home']=="0") selected="" @endif value="0">No</option>
							   </select>
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
<!-- Append Table Rows -->
<table class="table table-hover table-bordered table-striped imagesamplerow" style="display:none;">
<tbody>
<tr class="appenderTr blockIdWrap">
<td>
<input type="file" class="form-control" name="images[]">
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
         <td>
            <input type="text" class="form-control" name="videos[]" Placeholder="https://www.youtube.com/embed/wWLsiT9VTer">
         </td>
         <td class="text-center">
            <a  class="btn btn-danger videoRowRemove" href="javascript:void(0);"><i class="fa fa-times"></i>                                           </a>
         </td>
      </tr>
   </tbody>
</table>
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script>
	$(document).ready(function () {
		$('#meeting_description').summernote()
		
		$("#addImageRow").click(function() {        
			var row = jQuery('.imagesamplerow tr').clone(true);
			row.appendTo('#image-table');        
		});
		
		$('.imageRowRemove').on("click", function() {
			$(this).parents("tr").remove();
		});
		
		$('.deleteImage').on("click", function() {
			if(confirm('Are you sure you want to delete?')){
				var key = $(this).attr("data-key");
				var id = $(this).attr("data-id");
				var name = $(this).attr("data-img");
				var deleteURL = "{{ url('admin/delete-meeting-image') }}/"+id+"?name="+name;
				$.ajax({
					url:deleteURL,
					type:'get',
					success:function(data) {
						$("#uploaded-image-"+key).hide();
					}
				})
			}else{
				return false;
			}
		});
		
		$("#addVideoRow").click(function() {        
			var row = jQuery('.videosamplerow tr').clone(true);
			row.appendTo('#video-table');        
		});
		
		$(document).on('click','.videoRowRemove',function(){
			$(this).parents("tr").remove();
		});
	});
</script>
@endsection