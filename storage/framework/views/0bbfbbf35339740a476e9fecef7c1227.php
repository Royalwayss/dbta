<?php $__env->startSection('content'); ?>
<!-- breadcrumb start -->
<div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li>
                <i class="fa-solid fa-angle-right"></i>
            </li>
            <li>404 - Page Not Found</li>
        </ul>
    </div>
</div> 
<!-- breadcrumb end -->
<section class="bg-light text-black text-center py-5 about-header">
    <div class="container">
        <h2 class="text-danger">404 - Page Not Found</h2>
        <p class="lead">Oops! The page you're looking for doesn't exist or might have been moved.</p>
    </div>
</section>

<section class="container my-5 about-content">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 text-center">
            <img src="<?php echo e(asset('front/images/404.png')); ?>" alt="Page Not Found" class="img-fluid mb-4" style="max-height: 300px;">
            <p class="mb-4"><!-- We couldn't find the page you were looking for. This might be due to an outdated link or a typo in the URL. --></p>
            <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary px-4">Go to Homepage</a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/errors/404.blade.php ENDPATH**/ ?>