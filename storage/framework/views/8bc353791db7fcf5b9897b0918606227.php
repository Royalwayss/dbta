<style>
  /* Sidebar Link Base Styles */
.nav-sidebar .nav-link {
  transition: all 0.3s ease;
  position: relative;
  padding-left: 15px; /* Adjust for new bullet design */
}

/* Hover Effect with Gradient */
.nav-sidebar .nav-link:hover {
  background: linear-gradient(90deg, #ff7e5f, #feb47b); /* Gradient hover background */
  color: #fff !important; /* White text */
  border-radius: 5px;
  padding-left: 20px; /* Indentation on hover for dynamic look */
  box-shadow: 0px 4px 8px rgba(255, 126, 95, 0.4); /* Subtle glow */
}

/* Custom Bullet/Icon on Hover */
.nav-sidebar .nav-link:hover::before {
  /*content: '\2022';*/ /* Custom bullet (circle) */
  content: '';
  color: #fff; /* White bullet */
  font-size: 20px; /* Larger size for prominence */
  position: absolute;
  left: 5px; /* Position near the text */
  top: 50%;
  transform: translateY(-50%);
}

/* Active Tab Style */
.nav-sidebar .nav-link.active {
  background: linear-gradient(90deg, #00c6ff, #0072ff); /* Blue gradient for active tab */
  color: #fff !important; /* White text for active */
  border-radius: 5px;
  box-shadow: 0px 4px 8px rgba(0, 198, 255, 0.4); /* Glow effect */
  padding-left: 20px;
}

/* Custom Bullet/Icon for Active Tab */
.nav-sidebar .nav-link.active::before {
  /*content: '\2714';*/ /* Checkmark icon for active tab */
  content: ''; /* Remove the checkmark icon */
  color: #fff; /* White bullet/icon */
  font-size: 20px;
  position: absolute;
  left: 5px;
  top: 50%;
  transform: translateY(-50%);
}

/* Animated Underline Effect on Hover */
.nav-sidebar .nav-link::after {
  content: '';
  position: absolute;
  bottom: 3px;
  left: 15px;
  right: 15px;
  height: 2px;
  background: transparent;
  transition: all 0.3s ease;
}

/* Show Underline on Hover */
.nav-sidebar .nav-link:hover::after {
  /*background: #fff;*/ /* White underline */
}

/* Submenu Items Hover Effect */
.nav-sidebar .nav-treeview .nav-item .nav-link:hover {
  background-color: #ff9e80; /* Soft orange for submenu hover */
  color: #fff !important;
  border-radius: 5px;
}

/* Submenu Active Style */
.nav-sidebar .nav-treeview .nav-item .nav-link.active {
  background-color: #ff7043; /* Deeper orange for active submenu */
  color: #fff !important;
  border-radius: 5px;
}
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo e(url('admin/dashboard')); ?>" class="brand-link" style="background-color:#fff; border:0px !important;">
    <img src="<?php echo e(asset('front/assets/images/dtba-logo.png')); ?>"  class="brand-image" style="width:120px; height:auto; max-height:100% !important; border:0px !important;">
    <!-- <span class="brand-text font-weight-light">Admin Panel</span> -->
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if(!empty(Auth::guard('admin')->user()->image)): ?>
          <img src="<?php echo e(asset('admin/images/photos/'.Auth::guard('admin')->user()->image)); ?>" class="img-circle elevation-2" alt="User Image">
        <?php else: ?>
          <img src="<?php echo e(asset('admin/images/no-image.png')); ?>" class="img-circle elevation-2" alt="User Image"> 
        <?php endif; ?>
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo e(Auth::guard('admin')->user()->name); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <?php if(Session::get('page')=="dashboard"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
        <li class="nav-item">
          <a href="<?php echo e(url('admin/dashboard')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
		
		
		<?php if(Session::get('page')=="banners"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/banners')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Banners
            </p>
          </a>
        </li>
		
		
		<?php if(Session::get('page')=="events"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/events')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Events
            </p>
          </a>
        </li>
		
		<?php if(Session::get('page')=="mettings"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/meetings')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Mettings
            </p>
          </a>
        </li>
		
		<?php if(Session::get('page')=="newsletters"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/newsletters')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Newsletters
            </p>
          </a>
        </li>
		
		
		<?php if(Session::get('page')=="downloads"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/downloads')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Downloads
            </p>
          </a>
        </li>
		
		
		<?php if(Session::get('page')=="media"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/media')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Media
            </p>
          </a>
        </li>
		
		
		
		<?php if(Session::get('page')=="home-media"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/home-media')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Home Media 
            </p>
          </a>
        </li>
		
		
		
		<?php if(Session::get('page')=="committees"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/committees')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Committees
            </p>
          </a>
        </li>
		
		
		<?php if(Session::get('page')=="case-laws"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/case-laws')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Case Laws
            </p>
          </a>
        </li>
		
		<?php if(Session::get('page')=="executive-body"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/executive-body')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Executive Body
            </p>
          </a>
        </li>
		
	
		<?php if(Session::get('page')=="contacts"): ?>
            <?php $active="active" ?>
        <?php else: ?>
            <?php $active = "" ?>
        <?php endif; ?>
		
		<li class="nav-item">
          <a href="<?php echo e(url('admin/contacts')); ?>" class="nav-link <?php echo e($active); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Contacts
            </p>
          </a>
        </li>
       
      
       
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/admin/layout/sidebar.blade.php ENDPATH**/ ?>