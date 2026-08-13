<section>
    <header class="mb-4">
        <h4 class="card-title card-title-dash mb-1">Profile Information</h4>
        <p class="text-muted small mb-0">
            <?php echo e(__("Update your account's profile information, photo, and email address.")); ?>

        </p>
    </header>

    <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
        <?php echo csrf_field(); ?>
    </form>

    <form method="post" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data" class="mt-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('patch'); ?>

        <!-- Profile Photo Field -->
        <div class="form-group mb-4">
            <label class="fw-semibold mb-2 d-block">Profile Photo</label>
            <div class="d-flex align-items-center gap-3">
                <img src="<?php echo e($user->profile_photo_url); ?>" alt="<?php echo e($user->name); ?>" class="rounded-circle border" style="width: 75px; height: 75px; object-fit: cover;">
                <div class="flex-grow-1">
                    <input type="file" id="profilepic" name="profilepic" accept="image/*" class="form-control">
                    <small class="text-muted mt-1 d-block">Allowed formats: JPG, PNG, WEBP (Max size: 2MB)</small>
                </div>
            </div>
            <?php $__errorArgs = ['profilepic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Name Field -->
        <div class="form-group mb-3">
            <label for="name" class="fw-semibold mb-1">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required autofocus autocomplete="name">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Email Field -->
        <div class="form-group mb-4">
            <label for="email" class="fw-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required autocomplete="username">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                <div class="mt-2">
                    <p class="text-muted small">
                        <?php echo e(__('Your email address is unverified.')); ?>

                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-underline small">
                            <?php echo e(__('Click here to re-send the verification email.')); ?>

                        </button>
                    </p>

                    <?php if(session('status') === 'verification-link-sent'): ?>
                        <div class="alert alert-success mt-2 small p-2">
                            <?php echo e(__('A new verification link has been sent to your email address.')); ?>

                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary text-white">Save Changes</button>

            <?php if(session('status') === 'profile-updated'): ?>
                <span 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-success small fw-semibold"
                >
                    Saved successfully!
                </span>
            <?php endif; ?>
        </div>
    </form>
</section><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>