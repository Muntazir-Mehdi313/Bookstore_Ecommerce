@extends('admin.layout')

@section('admin-dashboard-product')
<div class="main-panel">
    <div class="content-wrapper">

        <x-toast />

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
                                <a href="{{ route('product.create') }}" class="btn btn-primary text-white">
                                    <i class="mdi mdi-plus"></i> Add New Product
                                </a>

                                <a href="{{ route('product.export') }}" class="btn btn-outline-primary">
                                    <i class="mdi mdi-download"></i> Export CSV
                                </a>
                            </div>
                        </div>

                        <!-- Filter Bar -->
                        <div class="mb-4 pb-3 border-bottom">
                            <form method="GET" action="{{ route('product.index') }}" class="d-flex align-items-center gap-2">
                                <label for="categoryFilter" class="fw-semibold mb-0 me-2">Category:</label>
                                <select id="categoryFilter" name="category_id" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                                    <option value="0">All Categories</option>
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $selectedCat === $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @if($selectedCat > 0)
                                <a href="{{ route('product.index') }}" class="btn btn-sm btn-light">Clear</a>
                                @endif
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
                                    @forelse($products as $product)
                                    <tr>
                                        <!-- Small Product Thumbnail -->
                                        <td>
                                            <img src="{{ $product->images->first()?->url ?? 'https://via.placeholder.com/44?text=No+Img' }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="rounded border" 
                                                 style="width: 44px; height: 44px; object-fit: cover;"
                                                 onerror="this.onerror=null;this.src='https://via.placeholder.com/44?text=No+Img';">
                                        </td>
                                        <td><h6>#{{ $product->id }}</h6></td>
                                        <td><h6 class="fw-bold mb-0">{{ $product->name }}</h6></td>
                                        <td><span class="badge badge-opacity-primary">{{ $product->category->name }}</span></td>
                                        <td><h6 class="fw-semibold mb-0">${{ number_format($product->price, 2) }}</h6></td>
                                        <td class="text-center">
                                            <a href="{{ route('product.show', $product) }}" class="btn btn-info btn-sm text-white me-1">
                                                <i class="mdi mdi-eye"></i> View
                                            </a>
                                            <a href="{{ route('product.edit', $product) }}" class="btn btn-warning btn-sm text-white me-1">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('product.destroy', $product) }}"
                                                  method="POST"
                                                  class="d-inline-block"
                                                  onsubmit="return confirm('Are you sure you want to delete this product?');">
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
                                        <td colspan="6" class="text-center text-muted py-4">No products found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            {{ $products->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection