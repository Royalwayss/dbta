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
          <h1 class="m-0">Contacts Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e('/admin/dashboard'); ?>">Home</a></li>
            <li class="breadcrumb-item active">Contacts</li>
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
             
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Subject</th>
                     
                      <th>Date</th>
                      <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td><?php echo e($row['id']); ?></td>
                      <td><?php echo e($row['name']); ?></td>
                      <td><?php echo e($row['email']); ?></td>
                      <td><?php echo e($row['mobile']); ?></td>
                      <td><?php echo e($row['subject']); ?></td>
                      
                    <td><?php echo e(date("M j, Y, g:i a", strtotime($row['created_at']))); ?></td>
                    <td ><a <?php if($row['view_status'] == 0): ?> style="color:red" <?php else: ?> style="color:green" <?php endif; ?> href="<?php echo e(asset('admin/view-contact/'.$row['id'])); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
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
<?php echo $__env->make('admin.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/admin/contacts/contacts.blade.php ENDPATH**/ ?>