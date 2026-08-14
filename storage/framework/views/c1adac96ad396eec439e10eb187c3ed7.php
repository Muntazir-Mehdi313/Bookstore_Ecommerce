<?php if(session('success') || session('error')): ?>
    <?php $type = session('success') ? 'success' : 'error'; ?>

    <div id="flashToast" class="toast toast-<?php echo e($type); ?>">
        <?php echo e(session($type)); ?>

    </div>

    <script>
        setTimeout(function () {
            var toast = document.getElementById('flashToast');
            if (toast) {
                toast.classList.add('toast-hide');
                setTimeout(function () { toast.remove(); }, 400);
            }
        }, 3000);
    </script>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/components/toast.blade.php ENDPATH**/ ?>