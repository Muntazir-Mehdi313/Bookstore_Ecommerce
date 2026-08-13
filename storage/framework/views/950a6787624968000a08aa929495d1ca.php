

<?php $__env->startSection('admin-dashboard-product'); ?>
<div class="main-panel">
    <div class="content-wrapper">

        <?php if (isset($component)) { $__componentOriginal7cfab914afdd05940201ca0b2cbc009b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $attributes = $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $component = $__componentOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">

                        <!-- Title and Top Toolbar -->
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="card-title card-title-dash mb-0">Product Management</h3>
                                <p class="card-subtitle card-subtitle-dash">Manage products, pricing, and details</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <!-- Direct Button Link to Dedicated Add Product Page -->
                                <a href="<?php echo e(route('product.create')); ?>" class="btn btn-primary text-white">
                                    <i class="mdi mdi-plus"></i> Add New Product
                                </a>

                                <a href="<?php echo e(route('product.export')); ?>" class="btn btn-outline-primary">
                                    <i class="mdi mdi-download"></i> Export CSV
                                </a>
                            </div>
                        </div>

                        <!-- Filter Bar -->
                        <div class="mb-4 pb-3 border-bottom">
                            <form method="GET" action="<?php echo e(route('product.index')); ?>" class="d-flex align-items-center gap-2">
                                <label for="categoryFilter" class="fw-semibold mb-0 me-2">Category:</label>
                                <select id="categoryFilter" name="category_id" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                                    <option value="0">All Categories</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>" <?php echo e($selectedCat === $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($selectedCat > 0): ?>
                                <a href="<?php echo e(route('product.index')); ?>" class="btn btn-sm btn-light">Clear</a>
                                <?php endif; ?>
                            </form>
                        </div>

                        <!-- Products Table with Image Column -->
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <!-- Small Product Thumbnail -->
                                        <td>
                                            <img src="<?php echo e($product->images->first()?->url ?? 'https://via.placeholder.com/44?text=No+Img'); ?>" 
                                                 alt="<?php echo e($product->name); ?>" 
                                                 class="rounded border" 
                                                 style="width: 44px; height: 44px; object-fit: cover;"
                                                 onerror="this.onerror=null;this.src='https://via.placeholder.com/44?text=No+Img';">
                                        </td>
                                        <td><h6>#<?php echo e($product->id); ?></h6></td>
                                        <td><h6 class="fw-bold mb-0"><?php echo e($product->name); ?></h6></td>
                                        <td><span class="badge badge-opacity-primary"><?php echo e($product->category->name); ?></span></td>
                                        <td><h6 class="fw-semibold mb-0">$<?php echo e(number_format($product->price, 2)); ?></h6></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('product.show', $product)); ?>" class="btn btn-info btn-sm text-white me-1">
                                                <i class="mdi mdi-eye"></i> View
                                            </a>
                                            <a href="<?php echo e(route('product.edit', $product)); ?>" class="btn btn-warning btn-sm text-white me-1">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <form action="<?php echo e(route('product.destroy', $product)); ?>"
                                                  method="POST"
                                                  class="d-inline-block"
                                                  onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm text-white">
                                                    <i class="mdi mdi-delete"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No products found.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <?php echo e($products->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/product/index.blade.php ENDPATH**/ ?>