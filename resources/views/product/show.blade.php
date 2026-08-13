@extends('admin.layout')

@section('admin-product-view')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="mb-3">
            <a href="{{ route('product.index') }}" class="btn btn-light btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back to Products
            </a>
        </div>

        <!-- Product Overview Header Card -->
        <div class="row mb-4">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge badge-opacity-primary mb-2">{{ $product->category->name }}</span>
                                <h2 class="fw-bold mb-2">{{ $product->name }}</h2>
                                <h3 class="text-primary fw-bold mb-3">${{ number_format($product->price, 2) }}</h3>
                                <p class="text-muted fs-6 mb-0">{{ $product->description }}</p>
                            </div>
                        </div>
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