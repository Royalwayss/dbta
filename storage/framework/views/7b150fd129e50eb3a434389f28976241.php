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
               <h1 class="m-0">Events Management</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo e('/admin/dashboard'); ?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li class="breadcrumb-item active">Events</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
                  <div class="card-header">
                     <h3 class="card-title">Events</h3>
                     <?php if($eventsModule['edit_access']==1 || $eventsModule['full_access']==1): ?>
                     <!-- <a style="max-width: 150px; float:right; display: inline-block;" href="<?php echo e(url('admin/export-categories')); ?>" class="btn btn-block btn-primary">Export Categories</a>
                        &nbsp; -->
                     <a style="max-width: 150px; margin-top: 0px ; display: inline-block; float:right; margin-right: 10px;" href="<?php echo e(url('admin/add-edit-event')); ?>" class="btn btn-block btn-primary">Add Event</a>
                     <?php endif; ?>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Event Title</th>
                              <th>Event Date</th>
                              <th>Sort</th>
                              <th>Created on</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr>
                              <td><?php echo e($event['id']); ?></td>
                              <td><?php echo e($event['event_title']); ?></td>
                              <td><?php echo e(date("d-m-Y", strtotime($event['event_date']))); ?></td>
							    <td><?php echo e($event['event_sort']); ?></td>
                                <td><?php echo e(date("d-m-Y, g:i a", strtotime($event['created_at']))); ?></td>
                            
							  <td>
                                 <?php if($eventsModule['edit_access']==1 || $eventsModule['full_access']==1): ?>
                                 <?php if($event['status']==1): ?>
                                 <a class="updateStatus" data-table="events" id="status-<?php echo e($event['id']); ?>" data-id="<?php echo e($event['id']); ?>" style='color:#3f6ed3' href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                                 <?php else: ?>
                                 <a class="updateStatus" data-table="events" id="status-<?php echo e($event['id']); ?>"  data-id="<?php echo e($event['id']); ?>" style="color:grey" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                 <?php endif; ?>
                                 <?php endif; ?>
                                 <?php if($eventsModule['edit_access']==1 || $eventsModule['full_access']==1): ?>
                                 &nbsp;&nbsp;
                                 <a style='color:#3f6ed3;' href="<?php echo e(url('admin/add-edit-event/'.$event['id'])); ?>"><i class="fas fa-edit"></i></a>
                                 &nbsp;&nbsp;
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
<?php echo $__env->make('admin.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/admin/events/events.blade.php ENDPATH**/ ?>