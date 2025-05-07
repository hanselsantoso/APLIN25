<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-light">
            <div class="card-body">
                <h2 class="card-title">Welcome to Product Management System</h2>
                <p class="lead">Manage your product inventory and categories efficiently.</p>
            </div>
        </div>
    </div>
</div> <!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary h-100">
            <div class="card-body text-center">
                <h1 class="display-4">{{ $totalCategories ?? 0 }}</h1>
                <h5>Total Categories</h5>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="{{ route('categories.index') }}" class="text-white">View All <i
                        class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success h-100">
            <div class="card-body text-center">
                <h1 class="display-4">{{ $totalProducts ?? 0 }}</h1>
                <h5>Total Products</h5>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="{{ route('products.index') }}" class="text-white">View All <i
                        class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning h-100">
            <div class="card-body text-center">
                <h1 class="display-4">{{ $lowStockCount ?? 0 }}</h1>
                <h5>Low Stock Items</h5>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="#low-stock" class="text-white">View Details <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-info h-100">
            <div class="card-body text-center">
                <h1 class="display-4">Rp {{ number_format($totalValue ?? 0, 2, ',', '.') }}</h1>
                <h5>Inventory Value</h5>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <span class="text-white">Total Stock Value</span>
            </div>
        </div>
    </div>
</div> <!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2"> <a href="{{ route('categories.create') }}"
                            class="btn btn-outline-primary w-100 py-3"> <i class="bi bi-folder-plus"></i> Add New
                            Category </a> </div>
                    <div class="col-md-3 mb-2"> <a href="{{ route('products.create') }}"
                            class="btn btn-outline-success w-100 py-3"> <i class="bi bi-plus-circle"></i> Add New
                            Product </a> </div>
                    <div class="col-md-3 mb-2"> <a href="{{ route('categories.index') }}"
                            class="btn btn-outline-secondary w-100 py-3"> <i class="bi bi-list"></i> Manage Categories
                        </a> </div>
                    <div class="col-md-3 mb-2"> <a href="{{ route('products.index') }}"
                            class="btn btn-outline-secondary w-100 py-3"> <i class="bi bi-bag"></i> Manage Products </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Recent Categories -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Categories</h5> <a href="{{ route('categories.index') }}"
                    class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body"> @if(isset($categories) && $categories->count() > 0) <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Products</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> @foreach($categories as $category) <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td> <a href="{{ route('categories.show', $category) }}"
                                        class="btn btn-sm btn-info">View</a> </td>
                            </tr> @endforeach </tbody>
                    </table>
                </div> @else <div class="alert alert-info"> No categories found. <a
                        href="{{ route('categories.create') }}">Create your first category</a>. </div>
                @endif </div>
        </div>
    </div>
    <!-- Recent Products -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Products</h5>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                @if(isset($products) && $products->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            @if($product->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $product) }}"
                                                class="btn btn-sm btn-info">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        No products found. <a href="{{ route('products.create') }}">Add your first
                            product</a>.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div> <!-- Low Stock Alert -->
<div class="row" id="low-stock">
    <div class="col-12 mb-4">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Low Stock Alerts</h5>
            </div>
            <div class="card-body"> @if(isset($lowStockProducts) && $lowStockProducts->count() > 0) <div
                    class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody> @foreach($lowStockProducts as $product) <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td><span class="text-danger fw-bold">{{ $product->stock }}</span></td>
                                <td> <a href="{{ route('products.edit', $product) }}"
                                        class="btn btn-sm btn-warning">Update Stock</a> </td>
                            </tr> @endforeach </tbody>
                    </table>
                </div> @else <p class="mb-0">No products with low stock. Your inventory levels are healthy!</p> @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"> @endsection
