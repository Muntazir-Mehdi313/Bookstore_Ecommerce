@extends('admin.layout')

@section('admin-category-edit')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card mx-auto">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-4">Edit Category</h4>

                        <form method="POST" action="{{ route('categories.update', $category) }}" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name" class="fw-semibold mb-1">Category Name</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="description" class="fw-semibold mb-1">Description</label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2 text-white">Update Category</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection