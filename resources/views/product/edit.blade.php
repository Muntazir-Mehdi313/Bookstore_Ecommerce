@extends('admin.layout')

@section('admin-product-view')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="mb-3">
            <a href="{{ route('product.index') }}" class="btn btn-light btn-sm">
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

                        <form method="POST" action="{{ route('product.update', $product) }}">
                            @csrf
                            @method('PUT')

                            <!-- Product Name -->
                            <div class="form-group mb-3">
                                <label class="fw-semibold mb-1">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required placeholder="Enter product name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Price & Category Row -->
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-semibold mb-1">Price ($) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required placeholder="0.00">
                                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-semibold mb-1">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label class="fw-semibold mb-1">Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required placeholder="Write product description">{{ old('description', $product->description) }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Book Attributes Section -->
                            <div class="card bg-light border mb-4">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-3">Book Details / Attributes</h6>
                                    
                                    <div class="row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Author</label>
                                            <input type="text" name="author" value="{{ old('author', $product->attributes->author ?? '') }}" placeholder="e.g. J.K. Rowling" class="form-control form-control-sm @error('author') is-invalid @enderror">
                                            @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Publisher</label>
                                            <input type="text" name="publisher" value="{{ old('publisher', $product->attributes->publisher ?? '') }}" placeholder="e.g. Bloomsbury" class="form-control form-control-sm @error('publisher') is-invalid @enderror">
                                            @error('publisher') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Language</label>
                                            <input type="text" name="language" value="{{ old('language', $product->attributes->language ?? '') }}" placeholder="e.g. English" class="form-control form-control-sm @error('language') is-invalid @enderror">
                                            @error('language') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">ISBN</label>
                                            <input type="text" name="isbn" value="{{ old('isbn', $product->attributes->isbn ?? $product->attributes->ISBN ?? '') }}" placeholder="e.g. 978-3-16-148410-0" class="form-control form-control-sm @error('isbn') is-invalid @enderror">
                                            @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Page Count</label>
                                            <input type="number" name="number_of_pages" min="1" value="{{ old('number_of_pages', $product->attributes->number_of_pages ?? '') }}" placeholder="e.g. 350" class="form-control form-control-sm @error('number_of_pages') is-invalid @enderror">
                                            @error('number_of_pages') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Edition</label>
                                            <input type="text" name="edition" value="{{ old('edition', $product->attributes->edition ?? '') }}" placeholder="e.g. 1st Edition" class="form-control form-control-sm @error('edition') is-invalid @enderror">
                                            @error('edition') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex align-items-center gap-2">
                                <button type="submit" class="btn btn-primary text-white me-2">Update Product</button>
                                <a href="{{ route('product.index') }}" class="btn btn-light">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Quick Overview Sidebar -->
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <span class="badge badge-opacity-primary mb-2">{{ $product->category->name }}</span>
                        <h5 class="fw-bold mb-2">{{ $product->name }}</h5>
                        <h4 class="text-primary fw-bold mb-0">${{ number_format($product->price, 2) }}</h4>
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
                            <h4 class="card-title card-title-dash mb-0">Product Images ({{ $product->images->count() }})</h4>

                            <!-- Add Image Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-primary text-white dropdown-toggle" type="button" id="addImageDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="mdi mdi-plus"></i> Add Image
                                </button>
                                <div class="dropdown-menu dropdown-menu-end p-3 shadow" aria-labelledby="addImageDropdown" style="width: 300px;">
                                    <form method="POST" action="{{ route('product.images.store', $product) }}" enctype="multipart/form-data">
                                        @csrf
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

                        @if($product->images->isEmpty())
                            <p class="text-muted text-center py-4">No images uploaded for this product yet.</p>
                        @else
                            <div class="row g-3">
                                @foreach($product->images as $img)
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card border h-100">
                                            <div style="height: 180px; overflow: hidden;" class="d-flex align-items-center justify-content-center bg-light rounded-top">
                                                <img src="{{ $img->url }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 100%; object-fit: contain;" onerror="this.onerror=null;this.src='https://via.placeholder.com/220?text=No+Image';">
                                            </div>
                                            <div class="card-body p-3 text-center">
                                                <span class="badge badge-opacity-secondary mb-2">#{{ $img->id }}</span>
                                                <div class="d-flex justify-content-center gap-1 mt-2">
                                                    <!-- Edit Image URL Dropdown -->
                                                    <div class="dropdown">
                                                        <button class="btn btn-warning btn-sm text-white dropdown-toggle" type="button" id="editImg{{ $img->id }}" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                                            Edit
                                                        </button>
                                                        <div class="dropdown-menu p-3 shadow" aria-labelledby="editImg{{ $img->id }}" style="width: 250px;">
                                                            <form method="POST" action="{{ route('product.images.update', $img) }}">
                                                                @csrf @method('PUT')
                                                                <div class="form-group mb-2">
                                                                    <label class="form-label small fw-semibold">Image URL</label>
                                                                    <input type="url" name="image_url" value="{{ $img->image_path }}" class="form-control form-control-sm" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-warning text-white btn-sm w-100">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <form method="POST" action="{{ route('product.images.destroy', $img) }}" onsubmit="return confirm('Delete this image?');" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm text-white">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection