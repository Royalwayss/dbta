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
            <h1>Executive Body Management</h1>
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
                  <a href="<?php echo e(url('admin/add-edit-executive-body/'.$prevId)); ?>" class="btn btn-primary btn-animated-link"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Previous Download</a>
                <?php endif; ?>
                <?php if($nextId!=0): ?>
                  <a href="<?php echo e(url('admin/add-edit-executive-body/'.$nextId)); ?>" class="btn btn-primary btn-animated-link"> Next Download  <i class="fas fa-arrow-right"></i> </a>
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
                <form name="categoryForm" id="categoryForm" action="<?php echo e(url('admin/add-edit-executive-body')); ?>" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                <?php if(!empty($row['id'])): ?>
                  <input type="hidden" name="id" value="<?php echo e($row['id']); ?>">
                <?php endif; ?>
                <div class="card-body">
                  <div class="row">
				  
				 <div class="form-group col-md-6">
                    <label for="destination">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" <?php if(!empty($row['name'])): ?> value="<?php echo e($row['name']); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?> required >
                  </div>
				 
				  <div class="form-group col-md-6">
                    <label for="destination">Destination</label>
                    <input type="text" class="form-control" id="destination" name="destination" placeholder="Enter Destination" <?php if(!empty($row['destination'])): ?> value="<?php echo e($row['destination']); ?>" <?php else: ?> value="<?php echo e(old('destination')); ?>" <?php endif; ?> >
                  </div>
				    
				  
				    <div class="form-group col-md-6">
                    <label for="image">Profile<small style="color:red"> Image Dimensions (306 X 340)</small></label>
                    <input type="file" class="form-control" id="image" name="image">
					<?php if(!empty($row['image'])): ?>
					<a target="_block" href="<?php echo e(asset('front/images/executive-body/'.$row['image'])); ?>">View Profile</a>
				   <?php endif; ?>
                  </div>
                

                   
				  <div class="form-group col-md-6">
                    <label for="sort">Sort</label>
                    <input type="no" class="form-control" id="sort" name="sort" placeholder="Sort" <?php if(!empty($row['sort'])): ?> value="<?php echo e($row['sort']); ?>" <?php else: ?> value="<?php echo e(old('sort')); ?>" <?php endif; ?> required>
                  </div>
                 

                 <div class="form-group col-md-6">
                      <label for="link">Status</label>
                      <select class="form-control"  name="status" required="">
						   <label for="status">Status*</label>
						   <option  value="1" <?php if(empty($row['status']) || $row['status'] == '1'): ?> selected <?php endif; ?>  >Active</option>
						   <option value="0" <?php if($row['status'] == '0'): ?> selected <?php endif; ?>>InActive</option>
					</select>
                    </div>
					
				  <div class="form-group col-md-6">
                      <label for="link">Show In Home</label>
                      <select class="form-control"  name="show_on_home" required="">
						   <label for="status">Status*</label>
						   <option  value="1" <?php if(empty($row['show_on_home']) || $row['show_on_home'] == '1'): ?> selected <?php endif; ?>  >Yes</option>
						   <option value="0" <?php if($row['show_on_home'] == '0'): ?> selected <?php endif; ?>>No</option>
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
<script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
<script>
$(document).ready(function () {
	 $('#caselaws_description').summernote()
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/admin/executive_body/add_edit_executive_body.blade.php ENDPATH**/ ?>