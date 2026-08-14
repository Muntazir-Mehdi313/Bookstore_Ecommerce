 

<?php $__env->startSection('admin-dashboard-profile'); ?> 
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="font-weight-bold">Profile Settings</h3>
                <p class="text-muted mb-0">Manage your account credentials, avatar, and personal details.</p>
            </div>
        </div>

        <div class="row">
            <!-- Profile Information Card -->
            <div class="col-lg-8 grid-margin stretch-card mb-4">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>

            <!-- Password Update Card -->
            <div class="col-lg-8 grid-margin stretch-card mb-4">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="col-lg-8 grid-margin stretch-card mb-4">
                <div class="card card-rounded shadow-sm border-danger">
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/profile/edit.blade.php ENDPATH**/ ?>