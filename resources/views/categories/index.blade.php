@extends('admin.layout')

@section('admin-dashboard-category')
<div class="main-panel">
    <div class="content-wrapper">

        <x-toast />

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="card-title card-title-dash mb-0">Categories</h3>
                                <p class="card-subtitle card-subtitle-dash">Manage product categories</p>
                            </div>
                            <div>
                                <a href="{{ route('categories.create') }}" class="btn btn-primary text-white me-2">
                                    <i class="mdi mdi-plus"></i> Add New Category
                                </a>
                                <a href="{{ route('categories.export') }}" class="btn btn-outline-primary">
                                    <i class="mdi mdi-download"></i> Export CSV
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table select-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            <h6>{{ $category->id }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="fw-bold mb-0">{{ $category->name }}</h6>
                                        </td>
                                        <td>
                                            <p class="text-muted mb-0">{{ $category->description ?? 'N/A' }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm text-white me-1">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}"
                                                  method="POST"
                                                  class="d-inline-block"
                                                  onsubmit="return confirm('Delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm text-white">
                                                    <i class="mdi mdi-delete"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">No categories found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            {{ $categories->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection