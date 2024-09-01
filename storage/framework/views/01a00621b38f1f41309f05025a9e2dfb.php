

<?php $__env->startSection('title', 'Student Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="sidebar">
        <!-- Student-specific navigation -->
    </div>
    <div class="main-content">
        <?php echo $__env->yieldContent('dashboard-content'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\student-clearance-system\resources\views/layouts/student.blade.php ENDPATH**/ ?>