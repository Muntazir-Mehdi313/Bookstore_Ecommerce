@extends('admin.layout')

@section('admin-dashboard-product')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="mb-3">
            <a href="{{ route('product.index') }}" class="btn btn-light btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back to Products
            </a>
        </div>

        <div class="row">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-1">Add New Product</h4>
                        <p class="text-muted small mb-4">Fill out the details below to add a new product to your store.</p>

                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Product Name -->
                            <div class="form-group mb-3">
                                <label class="fw-semibold mb-1">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Enter product name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Price & Category Row -->
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-semibold mb-1">Price ($) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required placeholder="0.00">
                                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label class="fw-semibold mb-1">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label class="fw-semibold mb-1">Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required placeholder="Write product description">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Book Attributes Section -->
                            <div class="card bg-light border mb-4">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-3">Book Details / Attributes</h6>

                                    <div class="row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Author</label>
                                            <input type="text" name="author" value="{{ old('author') }}" placeholder="e.g. J.K. Rowling" class="form-control form-control-sm @error('author') is-invalid @enderror">
                                            @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Publisher</label>
                                            <input type="text" name="publisher" value="{{ old('publisher') }}" placeholder="e.g. Bloomsbury" class="form-control form-control-sm @error('publisher') is-invalid @enderror">
                                            @error('publisher') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Language</label>
                                            <input type="text" name="language" value="{{ old('language') }}" placeholder="e.g. English" class="form-control form-control-sm @error('language') is-invalid @enderror">
                                            @error('language') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">ISBN</label>
                                            <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="e.g. 978-3-16-148410-0" class="form-control form-control-sm @error('isbn') is-invalid @enderror">
                                            @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Page Count</label>
                                            <input type="number" name="number_of_pages" value="{{ old('number_of_pages') }}" placeholder="e.g. 350" class="form-control form-control-sm @error('number_of_pages') is-invalid @enderror">
                                            @error('number_of_pages') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="col-md-4 form-group mb-3">
                                            <label class="fw-semibold small mb-1">Edition</label>
                                            <input type="text" name="edition" value="{{ old('edition') }}" placeholder="e.g. 1st Edition" class="form-control form-control-sm @error('edition') is-invalid @enderror">
                                            @error('edition') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Image Selection Card -->
                            <div class="card bg-light border mb-4">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-3">Product Image</h6>

                                    <div class="form-group mb-3">
                                        <label class="fw-semibold small mb-1">Option 1: Upload Image File</label>
                                        <input type="file" name="image_file" accept="image/*" class="form-control @error('image_file') is-invalid @enderror">
                                        @error('image_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="text-center my-2 text-muted fw-bold small">- OR -</div>

                                    <div class="form-group mb-0">
                                        <label class="fw-semibold small mb-1">Option 2: Paste Image URL</label>
                                        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://example.com/image.jpg" class="form-control @error('image_url') is-invalid @enderror">
                                        @error('image_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex align-items-center gap-2">
                                <button type="submit" class="btn btn-primary text-white me-2">Save Product</button>
                                <a href="{{ route('product.index') }}" class="btn btn-light">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection