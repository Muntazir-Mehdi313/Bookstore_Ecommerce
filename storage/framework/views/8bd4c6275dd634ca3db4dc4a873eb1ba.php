

<?php $__env->startSection('title', 'My Profile Settings — NovelPoint'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5" style="max-width: 800px; margin: 0 auto; padding: 40px 20px;">
    <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Account Settings</h2>

    <div style="background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <form method="post" action="<?php echo e(route('profile.update')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('patch'); ?>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; margin-bottom: 5px;">Name</label>
                <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; margin-bottom: 5px;">Email Address</label>
                <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <button type="submit" style="background: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                Save Changes
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/user/profile.blade.php ENDPATH**/ ?>