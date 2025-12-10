<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $__env->make('front.elements.meta-tag', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
	<?php echo $__env->make('front.elements.style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>
<body>
	<?php echo $__env->make('front.elements.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
	<?php echo $__env->yieldContent('content'); ?>
	<?php echo $__env->make('front.elements.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('front.elements.script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/front/layout/layout.blade.php ENDPATH**/ ?>