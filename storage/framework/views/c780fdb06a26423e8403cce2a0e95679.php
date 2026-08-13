

<?php $__env->startSection('admin-product-view'); ?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="mb-3">
            <a href="<?php echo e(route('product.index')); ?>" class="btn btn-light btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back to Products
            </a>
        </div>

        <!-- Edit Product Details Card -->
        <div class="row mb-4">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-1">Edit Product</h4>
                        <p class="text-muted small mb-4">Update the details below and save your changes.</p>

                        <form method="POST" action="<?php echo e(route('product.update', $product)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <!-- Product Name -->
                            <div class="form-group mb-3">
                                <label class="fw-semibold mb-1">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('name', $product->name)); ?>" required placeholder="Enter product name">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Price & Category Row -->
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-semibold mb-1">Price ($) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="price" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('price', $product->price)); ?>" required placeholder="0.00">
                                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-semibold mb-1">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $product->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label class="fw-semibold mb-1">Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="4" required placeholder="Write product description"><?php echo e(old('description', $product->description)); ?></textarea>
                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Book Attributes Section -->
                            <div class="card bg-light border mb-4">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-3">Book Details / Attributes</h6>
                                    
                                    <div class="row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Author</label>
                                            <input type="text" name="author" value="<?php echo e(old('author', $product->attributes->author ?? '')); ?>" placeholder="e.g. J.K. Rowling" class="form-control form-control-sm <?php $__errorArgs = ['author'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['author'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Publisher</label>
                                            <input type="text" name="publisher" value="<?php echo e(old('publisher', $product->attributes->publisher ?? '')); ?>" placeholder="e.g. Bloomsbury" class="form-control form-control-sm <?php $__errorArgs = ['publisher'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['publisher'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Language</label>
                                            <input type="text" name="language" value="<?php echo e(old('language', $product->attributes->language ?? '')); ?>" placeholder="e.g. English" class="form-control form-control-sm <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">ISBN</label>
                                            <input type="text" name="isbn" value="<?php echo e(old('isbn', $product->attributes->isbn ?? $product->attributes->ISBN ?? '')); ?>" placeholder="e.g. 978-3-16-148410-0" class="form-control form-control-sm <?php $__errorArgs = ['isbn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['isbn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Page Count</label>
                                            <input type="number" name="number_of_pages" min="1" value="<?php echo e(old('number_of_pages', $product->attributes->number_of_pages ?? '')); ?>" placeholder="e.g. 350" class="form-control form-control-sm <?php $__errorArgs = ['number_of_pages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['number_of_pages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Edition</label>
                                            <input type="text" name="edition" value="<?php echo e(old('edition', $product->attributes->edition ?? '')); ?>" placeholder="e.g. 1st Edition" class="form-control form-control-sm <?php $__errorArgs = ['edition'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['edition'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex align-items-center gap-2">
                                <button type="submit" class="btn btn-primary text-white me-2">Update Product</button>
                                <a href="<?php echo e(route('product.index')); ?>" class="btn btn-light">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Quick Overview Sidebar -->
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <span class="badge badge-opacity-primary mb-2"><?php echo e($product->category->name); ?></span>
                        <h5 class="fw-bold mb-2"><?php echo e($product->name); ?></h5>
                        <h4 class="text-primary fw-bold mb-0">$<?php echo e(number_format($product->price, 2)); ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Gallery Card -->
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title card-title-dash mb-0">Product Images (<?php echo e($product->images->count()); ?>)</h4>

                            <!-- Add Image Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-primary text-white dropdown-toggle" type="button" id="addImageDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="mdi mdi-plus"></i> Add Image
                                </button>
                                <div class="dropdown-menu dropdown-menu-end p-3 shadow" aria-labelledby="addImageDropdown" style="width: 300px;">
                                    <form method="POST" action="<?php echo e(route('product.images.store', $product)); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group mb-2">
                                            <label class="form-label small fw-semibold">Upload Image File</label>
                                            <input type="file" name="image_file" accept="image/*" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label small fw-semibold">OR Image URL</label>
                                            <input type="url" name="image_url" placeholder="Paste image address" class="form-control form-control-sm">
                                        </div>
                                        <button type="submit" class="btn btn-primary text-white btn-sm w-100">Save Image</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php if($product->images->isEmpty()): ?>
                            <p class="text-muted text-center py-4">No images uploaded for this product yet.</p>
                        <?php else: ?>
                            <div class="row g-3">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card border h-100">
                                            <div style="height: 180px; overflow: hidden;" class="d-flex align-items-center justify-content-center bg-light rounded-top">
                                                <img src="<?php echo e($img->url); ?>" alt="<?php echo e($product->name); ?>" class="img-fluid" style="max-height: 100%; object-fit: contain;" onerror="this.onerror=null;this.src='https://via.placeholder.com/220?text=No+Image';">
                                            </div>
                                            <div class="card-body p-3 text-center">
                                                <span class="badge badge-opacity-secondary mb-2">#<?php echo e($img->id); ?></span>
                                                <div class="d-flex justify-content-center gap-1 mt-2">
                                                    <!-- Edit Image URL Dropdown -->
                                                    <div class="dropdown">
                                                        <button class="btn btn-warning btn-sm text-white dropdown-toggle" type="button" id="editImg<?php echo e($img->id); ?>" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                                            Edit
                                                        </button>
                                                        <div class="dropdown-menu p-3 shadow" aria-labelledby="editImg<?php echo e($img->id); ?>" style="width: 250px;">
                                                            <form method="POST" action="<?php echo e(route('product.images.update', $img)); ?>">
                                                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                                <div class="form-group mb-2">
                                                                    <label class="form-label small fw-semibold">Image URL</label>
                                                                    <input type="url" name="image_url" value="<?php echo e($img->image_path); ?>" class="form-control form-control-sm" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-warning text-white btn-sm w-100">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <form method="POST" action="<?php echo e(route('product.images.destroy', $img)); ?>" onsubmit="return confirm('Delete this image?');" class="d-inline">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm text-white">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/product/edit.blade.php ENDPATH**/ ?>