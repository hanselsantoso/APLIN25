@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $product->name }}</h4>
                <div>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5>Product Details</h5>
                        <dl class="row">
                            <dt class="col-sm-3">Name:</dt>
                            <dd class="col-sm-9">{{ $product->name }}</dd>

                            <dt class="col-sm-3">Category:</dt>
                            <dd class="col-sm-9">
                                <a href="{{ route('categories.show', $product->category) }}">
                                    {{ $product->category->name }}
                                </a>
                            </dd>

                            <dt class="col-sm-3">Description:</dt>
                            <dd class="col-sm-9">{{ $product->description ?? 'No description provided.' }}</dd>

                            <dt class="col-sm-3">Price:</dt>
                            <dd class="col-sm-9">Rp {{ number_format($product->price, 2, ',', '.') }}</dd>

                            <dt class="col-sm-3">Stock:</dt>
                            <dd class="col-sm-9">
                                @if($product->stock < 5)
                                    <span class="text-danger fw-bold">{{ $product->stock }}</span>
                                @elseif($product->stock < 10)
                                    <span class="text-warning fw-bold">{{ $product->stock }}</span>
                                @else
                                    {{ $product->stock }}
                                @endif
                            </dd>

                            <dt class="col-sm-3">Status:</dt>
                            <dd class="col-sm-9">
                                @if($product->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </dd>

                            <dt class="col-sm-3">Created At:</dt>
                            <dd class="col-sm-9">{{ $product->created_at->format('F d, Y \a\t h:i A') }}</dd>

                            <dt class="col-sm-3">Last Updated:</dt>
                            <dd class="col-sm-9">{{ $product->updated_at->format('F d, Y \a\t h:i A') }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil"></i> Edit Product
                                    </a>
                                    <a href="{{ route('categories.show', $product->category) }}" class="btn btn-primary">
                                        <i class="bi bi-folder"></i> View Category
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="bi bi-trash"></i> Delete Product
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
