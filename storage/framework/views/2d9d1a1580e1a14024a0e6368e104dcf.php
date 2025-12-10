<?php $__env->startSection('content'); ?>
<style>

/* Action Icon Hover Effect */
a .fas {
  transition: color 0.3s ease, transform 0.3s ease;
}

a:hover .fas {
  color: #1E90FF; /* Vibrant blue color on hover */
  transform: scale(1.2); /* Slightly enlarge icon */
}

/* Action Icons for Better Visibility */
a .fas.fa-toggle-on {
  color: #28a745; /* Green for Active */
}

a .fas.fa-toggle-off {
  color: #dc3545; /* Red for Inactive */
}

a .fas.fa-edit {
  color: #ffc107; /* Yellow for Edit */
}

a .fas.fa-trash {
  color: #dc3545; /* Red for Delete */
}

a .fas.fa-unlock {
  color: #17a2b8; /* Teal for Update Role */
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Banners Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e('/admin/dashboard'); ?>">Home</a></li>
            <li class="breadcrumb-item active">Banners</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php if(Session::has('success_message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success:</strong> <?php echo e(Session::get('success_message')); ?>

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php endif; ?>
            <div class="card">
              <?php if($bannersModule['edit_access']==1 || $bannersModule['full_access']==1): ?>
              <div class="card-header">
                <h3 class="card-title">Banners</h3>
                <a style="max-width: 150px; float:right; display: inline-block;" href="<?php echo e(url('admin/add-edit-banner')); ?>" class="btn btn-block btn-primary">Add Banner</a>
              </div>
              <?php endif; ?>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="banners" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        Link
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Sort
                    </th>
                    <th>
                        Actions
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($banner['id']); ?>

                        </td>
                        <td>
                            <a target="_blank" href="<?php echo e(url('front/images/banners/'.$banner['image'])); ?>"><img style="width:50px;" src="<?php echo e(asset('front/images/banners/'.$banner['image'])); ?>"></a>
                        </td>
                        <td>
                            <?php echo e($banner['type']); ?>

                        </td>
                        <td>
                            <?php echo e($banner['link']); ?>

                        </td>
                        <td>
                            <?php echo e($banner['title']); ?>

                        </td>
                        <td>
                            <?php echo e($banner['sort']); ?>

                        </td>
                        <td>
                           <?php if($bannersModule['edit_access']==1 || $bannersModule['full_access']==1): ?>
                            <?php if($banner['status']==1): ?>
                                <a class="updateBannerStatus" id="banner-<?php echo e($banner['id']); ?>" banner_id="<?php echo e($banner['id']); ?>" style='color:#3f6ed3' href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                              <?php else: ?>
                                <a class="updateBannerStatus" id="banner-<?php echo e($banner['id']); ?>" banner_id="<?php echo e($banner['id']); ?>" style="color:grey" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                              <?php endif; ?>
                          <?php endif; ?>
                          <?php if($bannersModule['edit_access']==1 || $bannersModule['full_access']==1): ?>
                            &nbsp;&nbsp;
                            <a style='color:#3f6ed3;' href="<?php echo e(url('admin/add-edit-banner/'.$banner['id'])); ?>"><i class="fas fa-edit"></i></a>
                            &nbsp;&nbsp;
                          <?php endif; ?>
                          <?php if($bannersModule['full_access']==1): ?>
                            <a style='color:#3f6ed3;' class="confirmDelete" title="Delete Banner" href="javascript:void(0)" record="banner" recordid="<?php echo e($banner['id']); ?>"><i class="fas fa-trash"></i></a>
                          <?php endif; ?>
                        </td>
                    </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/admin/banners/banners.blade.php ENDPATH**/ ?>