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

<?php $__env->startSection('content'); ?>
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
                  <li class="breadcrumb-item"><a href="<?php echo e('/admin/dashboard'); ?>">Home</a></li>
                  <li class="breadcrumb-item active"><?php echo e($title); ?></li>
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
               <h3 class="card-title"><?php echo e($title); ?></h3>
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
                        <?php if($prevId!=0): ?>
                        <a href="<?php echo e(url('admin/add-edit-category/'.$prevId)); ?>" class="btn btn-primary btn-animated-link"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Previous Category</a>
                        <?php endif; ?>
                        <?php if($nextId!=0): ?>
                        <a href="<?php echo e(url('admin/add-edit-category/'.$nextId)); ?>" class="btn btn-primary btn-animated-link"> Next Category  <i class="fas fa-arrow-right"></i> </a>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php if($errors->any()): ?>
                  <div class="alert alert-danger">
                     <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </ul>
                  </div>
                  <?php endif; ?>
                  <?php if(Session::has('success_message')): ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>Success:</strong> <?php echo e(Session::get('success_message')); ?>

                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <?php endif; ?>
                  <form name="categoryForm" id="categoryForm" action="<?php echo e(url('admin/add-edit-meeting')); ?>" method="post" enctype="multipart/form-data">
                     <?php echo csrf_field(); ?>
                     <?php if(!empty($row['id'])): ?>
                     <input type="hidden" name="id" value="<?php echo e($row['id']); ?>">
                     <?php endif; ?>
                     <div class="card-body">
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label for="category_name">Meeting Title*</label>
                              <input type="text" class="form-control" id="meeting_title" name="meeting_title" placeholder="Enter Meeting Title" <?php if(!empty($row['meeting_title'])): ?> value="<?php echo e($row['meeting_title']); ?>" <?php else: ?> value="<?php echo e(old('meeting_title')); ?>" <?php endif; ?> pattern="[-a-zA-Z0-9_\.]+" required>
                           </div>
                           <div class="form-group col-md-6">
                              <label for="meeting_type">Meeting Type</label>
                              <?php $meeting_types = meeting_types(); ?>
                              <select class="form-control" id="meeting_type" name="meeting_type" required="">
                                 <option value="">Select</option>
                                 <?php $__currentLoopData = $meeting_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option <?php if(!empty($row['meeting_type'])&& $row['meeting_type']==$meeting_type['slug']): ?> selected="" <?php endif; ?> value="<?php echo e($meeting_type['slug']); ?>"><?php echo e($meeting_type['name']); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                           <div class="form-group col-md-12">
                              <label class="col-md-4 control-label">Images: <small style="color:red">Image Dimensions (745 X 500)</small></label>
                              <div class="col-md-8">
                                 <table  class="table table-hover table-bordered table-striped" id="image-table" >
                                    <tbody>
                                       <tr>
                                          <th width="90%">Image</th>
                                          <th width="10%">Actions</th>
                                       </tr>
                                       <?php 
                                          $images = [];
                                          if(!empty($row['images'])){
                                          $images = explode(',',$row['images']);
                                          }
                                          ?>
                                       <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <tr class="blockIdWrap" id="uploaded-image-<?php echo e($key); ?>">
                                          <td>
                                             <img src="<?php echo e(asset('front/images/meetings/'.$img)); ?>" style="width:100px">
                                          </td>
                                          <td>
                                             <a class="btn btn-danger deleteImage" href="javascript:void(0);" data-key="<?php echo e($key); ?>" data-id="<?php echo e($row['id']); ?>" data-img="<?php echo e($img); ?>"><i class="fa fa-times"></i></a>
                                          </td>
                                       </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <tr class="blockIdWrap">
                                          <td>
                                             <input type="file" class="form-control" name="images[]">
                                          </td>
                                          <td><input type="button" id="addImageRow" value="Add More" /></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="form-group col-md-12">
                              <label class="col-md-4 control-label">Videos: <small style="color:red">youtube embed url</small></label>
                              <div class="col-md-8">
                                 <table  class="table table-hover table-bordered table-striped" id="video-table" >
                                    <tbody>
                                       <tr>
                                          <th width="90%">Youtube URL</th>
                                          <th width="10%">Actions</th>
                                       </tr>
                                       <?php 
                                          $videos = [];
                                          if(!empty($row['videos'])){
                                          $videos = explode(',',$row['videos']);
                                          }
                                          ?>
                                       <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <tr class="blockIdWrap">
                                          <td>
                                             <input type="text" class="form-control" name="videos[]" Placeholder="https://www.youtube.com/embed/wWLsiT9VTer" value="<?php echo e($video); ?>">
                                          </td>
                                          <td>
                                             <a  class="btn btn-danger imageRowRemove" href="javascript:void(0);">
                                                <i class="fa fa-times"></i>  
                                          </td>
                                       </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <tr class="blockIdWrap">
                                       <td>
                                       <input type="text" class="form-control" name="videos[]" Placeholder="https://www.youtube.com/embed/wWLsiT9VTer">
                                       </td>
                                       <td><input type="button" id="addVideoRow" value="Add More" /></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="form-group col-md-12">
                           <label for="event_description">Meeting Description</label>
                           <textarea class="form-control" rows="3" id="meeting_description" name="description" placeholder="Enter Meeting Description"><?php if(!empty($row['description'])): ?> <?php echo e($row['description']); ?> <?php else: ?> <?php echo e(old('description')); ?> <?php endif; ?></textarea>
                           </div>
                           <div class="form-group col-md-6">
                           <label for="event_date">Meeting Date</label>
                           <input type="date" class="form-control" id="meeting_date" name="meeting_date" placeholder="Meeting Date" <?php if(!empty($row['meeting_date'])): ?> value="<?php echo e($row['meeting_date']); ?>" <?php else: ?> value="<?php echo e(old('meeting_date')); ?>" <?php endif; ?> required>
                           </div>
                           <div class="form-group col-md-6">
                           <label for="location">Meeting Location</label>
                           <input type="text" class="form-control" id="location" name="location" placeholder="Meeting location" <?php if(!empty($row['location'])): ?> value="<?php echo e($row['location']); ?>" <?php else: ?> value="<?php echo e(old('location')); ?>" <?php endif; ?> required>
                           </div>
                           <!-- <div class="form-group col-md-6">
                              <label for="meta_title">Meta Title</label>
                              <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" <?php if(!empty($row['meta_title'])): ?> value="<?php echo e($row['meta_title']); ?>" <?php else: ?> value="<?php echo e(old('meta_title')); ?>" <?php endif; ?> required>
                              </div>
                              <div class="form-group col-md-6">
                              <label for="meta_description">Meta Description</label>
                              <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Meta Description" <?php if(!empty($row['meta_description'])): ?> value="<?php echo e($row['meta_description']); ?>" <?php else: ?> value="<?php echo e(old('meta_description')); ?>" <?php endif; ?> required>
                              </div>
                              <div class="form-group col-md-6">
                              <label for="meta_keywords">Meta Keywords</label>
                              <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keywords" <?php if(!empty($row['meta_keywords'])): ?> value="<?php echo e($row['meta_keywords']); ?>" <?php else: ?> value="<?php echo e(old('meta_keywords')); ?>" <?php endif; ?> required>
                              </div> -->
                           <div class="form-group col-md-6">
                           <label for="meeting_sort">Sort</label>
                           <input type="no" class="form-control" id="meeting_sort" name="meeting_sort" placeholder="Enter Meeting Sort" <?php if(!empty($row['meeting_sort'])): ?> value="<?php echo e($row['meeting_sort']); ?>" <?php else: ?> value="<?php echo e(old('meeting_sort')); ?>" <?php endif; ?> required>
                           </div>
                           <div class="form-group col-md-6">
                           <label for="link">Status</label>
                           <select class="form-control" id="status" name="status" required="">
                           <option value="">Select</option>
                           <option <?php if(empty($row['status']) || $row['status']=="1"): ?> selected="" <?php endif; ?> value="1">Active</option>
                           <option <?php if( $row['status']=="0"): ?> selected="" <?php endif; ?> value="0">InActive</option>
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
<script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
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
				var deleteURL = "<?php echo e(url('admin/delete-meeting-image')); ?>/"+id+"?name="+name;
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/admin/meetings/add_edit_meeting.blade.php ENDPATH**/ ?>