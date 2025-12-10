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
            <h1>Media Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e('/admin/dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active"><?php echo e($title); ?></li>
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
                  <a href="<?php echo e(url('admin/add-edit-media/'.$prevId)); ?>" class="btn btn-primary btn-animated-link"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Previous Media</a>
                <?php endif; ?>
                <?php if($nextId!=0): ?>
                  <a href="<?php echo e(url('admin/add-edit-media/'.$nextId)); ?>" class="btn btn-primary btn-animated-link"> Next Media  <i class="fas fa-arrow-right"></i> </a>
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
                <form name="categoryForm" id="categoryForm" action="<?php echo e(url('admin/add-edit-committee')); ?>" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                <?php if(!empty($row['title'])): ?>
                  <input type="hidden" name="id" value="<?php echo e($row['id']); ?>">
                <?php endif; ?>
                <div class="card-body">
                  <div class="row">
				  <div class="form-group col-md-6">
                    <label for="title">Title*</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" <?php if(!empty($row['title'])): ?> value="<?php echo e($row['title']); ?>" <?php else: ?> value="<?php echo e(old('title')); ?>" <?php endif; ?> pattern="[-a-zA-Z0-9_\.]+" required>
                  </div>
				  <div class="form-group col-md-6">
                    <label for="sort">Sort*</label>
                    <input type="number" class="form-control" id="sort" name="sort" placeholder="Enter Sort" <?php if(!empty($row['sort'])): ?> value="<?php echo e($row['sort']); ?>" <?php else: ?> value="<?php echo e(old('sort')); ?>" <?php endif; ?>  required>
                  </div>
				  
				  
				  <div class="form-group col-md-6">
					 <select class="form-control"  name="committee_status" required="">
						   <label for="status">Status*</label>
						   <option  value="1" <?php if(empty($row['status']) || $row['status'] == '1'): ?> selected <?php endif; ?>  >Active</option>
						   <option value="0" <?php if($row['status'] == '0'): ?> selected <?php endif; ?>>InActive</option>
					</select>
				   </div>
				  
                  
				  <div class="form-group col-md-12">
                              <label class="col-md-4 control-label">Members: <small style="color:red">Image Dimensions (250 X 280)</small></label>
                              <div class="col-md-12">
                                 <table  class="table table-hover table-bordered table-striped" id="image-table" >
                                    <tbody>
                                       <tr>
                                          <th width="15%">Profile</th>
                                          <th width="20%">Name</th>
                                          <th width="20%">Destinations</th>
                                          <th width="10%">Sort</th>
                                          <th width="15%">Status</th>
                                          <th width="15%">Actions</th>
                                       </tr>
                                       <?php 
                                          $images = [];
                                          if(!empty($row['images'])){
                                          $images = explode(',',$row['images']);
                                          }
                                          ?>
                                       <?php if(isset($row['committee_members'])): ?>
									   <?php $__currentLoopData = $row['committee_members']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$committee_member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <tr class="blockIdWrap" id="member-profile-<?php echo e($committee_member['id']); ?>">
                                          <td>
										  <input type="hidden" name="member_id[]" value="<?php echo e($committee_member['id']); ?>">
                                             <img src="<?php echo e(asset('front/images/committees/members/'.$committee_member['profile'])); ?>" style="width:100px">
                                          </td>
										   <td>
										     <input type="numer" name="edit_name<?php echo e($committee_member['id']); ?>" class="form-control" value="<?php echo e($committee_member['name']); ?>" required>
										  </td>
										   <td>
										     <input type="numer" name="edit_destination<?php echo e($committee_member['id']); ?>" class="form-control" value="<?php echo e($committee_member['destination']); ?>" >
										  </td>
										  <td>
										     <input type="numer" name="edit_sort<?php echo e($committee_member['id']); ?>" class="form-control" value="<?php echo e($committee_member['sort']); ?>" required>
										  </td>
										  <td>
										     <select class="form-control"  name="edit_status<?php echo e($committee_member['id']); ?>" required="">
												   <option value="">Select</option>
												   <option  value="1" <?php if($committee_member['status'] == '1'): ?> selected <?php endif; ?>  >Active</option>
												   <option value="0" <?php if($committee_member['status'] == '0'): ?> selected <?php endif; ?>>InActive</option>
											</select>
											</td>
                                          <td>
                                             <a class="btn btn-danger deleteImage" href="javascript:void(0);"  data-id="<?php echo e($committee_member['id']); ?>" ><i class="fa fa-times"></i></a>
                                          </td>
                                       </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									   <?php endif; ?>
                                       <tr class="blockIdWrap">
                                          <td>
                                             <input type="file" class="form-control" name="images[]">
                                          </td>
										  <td>
										     <input type="numer" name="name[]" class="form-control">
										  </td>
										   <td>
										     <input type="numer" name="destination[]" class="form-control">
										  </td>
										  <td>
										     <input type="numer" name="member_sort[]" class="form-control">
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
										     <input type="numer" name="name[]" class="form-control">
										  </td>
										   <td>
										     <input type="numer" name="destination[]" class="form-control">
										  </td>
										  <td>
										     <input type="numer" name="member_sort[]" class="form-control">
										  </td>
										  <td>
										     <select class="form-control"  name="status[]" required="">
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
  
<script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
<script>
$(document).ready(function () {
	   $("#addImageRow").click(function() {        
			var row = jQuery('.imagesamplerow tr').clone(true);
			row.appendTo('#image-table');        
		});
        $('.imageRowRemove').on("click", function() {
			$(this).parents("tr").remove();
		});
		
		$('.deleteImage').on("click", function() {
			   $('.preloader').show();
				var id = $(this).attr("data-id");
				var deleteURL = "<?php echo e(url('admin/delete-member')); ?>/"+id;
				$.ajax({
					url:deleteURL,
					type:'get',
					success:function(data) { 
						$("#member-profile-"+id).remove();
					}
				});
			     $('.preloader').hide();
		
	
     });
		
	
});


</script>
<?php $__env->stopSection(); ?><style>
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

<?php echo $__env->make('admin.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/admin/committees/add_edit_committee.blade.php ENDPATH**/ ?>