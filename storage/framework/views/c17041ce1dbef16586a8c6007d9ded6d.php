<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banners Management</h1>
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
                  <a href="<?php echo e(url('admin/add-edit-banner/'.$prevId)); ?>" class="btn btn-primary btn-animated-link"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Previous Banner</a>
                <?php endif; ?>
                <?php if($nextId!=0): ?>
                  <a href="<?php echo e(url('admin/add-edit-banner/'.$nextId)); ?>" class="btn btn-primary btn-animated-link"> Next Banner  <i class="fas fa-arrow-right"></i> </a>
                <?php endif; ?>
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
                <form class="forms-sample" action="<?php echo e(url('admin/add-edit-banner/request')); ?>" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                    <?php if(!empty($banner['id'])): ?>
                      <input type="hidden" name="id" value="<?php echo e($banner['id']); ?>">
                    <?php endif; ?>
                    <div class="row">
                    <div class="form-group col-md-6">
                      <label for="link">Banner Type</label>
                      <select class="form-control" id="type" name="type" required="">
                        <option value="">Select</option>
                        
                        <option <?php if(!empty($banner['type'])&& $banner['type']=="Slider"): ?> selected="" <?php endif; ?> value="Slider">Top Slider</option>
                      <!--  <option <?php if(!empty($banner['type'])&& $banner['type']=="Category"): ?> selected="" <?php endif; ?> value="Category">Category Banner</option>
                        <option <?php if(!empty($banner['type'])&& $banner['type']=="Single"): ?> selected="" <?php endif; ?> value="Single">Single banner</option>
                        <option <?php if(!empty($banner['type'])&& $banner['type']=="Instagram"): ?> selected="" <?php endif; ?> value="Instagram">Instagram banner</option>
                        <option <?php if(!empty($banner['type'])&& $banner['type']=="Featured"): ?> selected="" <?php endif; ?> value="Featured">Featured banner</option> -->
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="admin_image">Desktop Banner Image</label><small><strong> (dimisions - 1245x460)</strong></small> <br>
                      <input type="file" class="form-control" id="image" name="image">
                       
					  <?php if(!empty($banner['image'])): ?>
                        <a target="_blank" href="<?php echo e(url('front/images/banners/'.$banner['image'])); ?>">View Image</a>
                      <?php endif; ?>
					  
                    </div>

                  <!--  <div class="form-group col-md-6">
                      <label for="admin_image">Mobile Banner Image<br>
					 <small> <strong>Desktop Top Slider - 770x660</strong></small></label>
                      <input type="file" class="form-control" id="mobile_image" name="mobile_image">
                      
                      <?php if(!empty($banner['mobile_banner'])): ?>
                        <a target="_blank" href="<?php echo e(url('front/images/banners/'.$banner['mobile_banner'])); ?>">View Image</a>
                      <?php endif; ?>
                    </div> -->

                    <div class="form-group col-md-6">
                      <label for="link">Banner Link</label>
                      <input type="text" class="form-control" id="link" placeholder="Enter Banner Link" name="link" <?php if(!empty($banner['link'])): ?> value="<?php echo e($banner['link']); ?>" <?php else: ?> value="<?php echo e(old('link')); ?>" <?php endif; ?>>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="title">Banner Title</label>
                      <input type="text" class="form-control" id="title" placeholder="Enter Banner Title" name="title" <?php if(!empty($banner['title'])): ?> value="<?php echo e($banner['title']); ?>" <?php else: ?> value="<?php echo e(old('title')); ?>" <?php endif; ?>>
                    </div>
                  <!--  <div class="form-group col-md-6">
                      <label for="alt">Banner Alternate Text</label>
                      <input type="text" class="form-control" id="alt" placeholder="Enter Banner Alternate Text" name="alt" <?php if(!empty($banner['alt'])): ?> value="<?php echo e($banner['alt']); ?>" <?php else: ?> value="<?php echo e(old('alt')); ?>" <?php endif; ?>>
                    </div> -->
                    <div class="form-group col-md-6">
                      <label for="sort">Banner Sort</label>
                      <input type="number" class="form-control" id="sort" placeholder="Enter Banner Sort" name="sort" <?php if(!empty($banner['sort'])): ?> value="<?php echo e($banner['sort']); ?>" <?php else: ?> value="<?php echo e(old('sort')); ?>" <?php endif; ?>>
                    </div>
					
					
					
					
					<div class="form-group col-md-6">
                      <label for="link">Status</label>
                      <select class="form-control" id="status" name="status" required="">
                        <option value="">Select</option>
                        
                        <option <?php if(!empty($banner['status'])&& $banner['status']=="1"): ?> selected="" <?php endif; ?> value="1">Active</option>
                        <option <?php if(!empty($banner['status'])&& $banner['status']=="0"): ?> selected="" <?php endif; ?> value="0">InActive</option>
                    
                      </select>
                    </div>
                    </div>
					
					
					
					
					
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                <!-- /.form-group -->
              </div>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/admin/banners/add_edit_banner.blade.php ENDPATH**/ ?>