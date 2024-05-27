@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">ADD PRODUCT</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addProduct"><i class="fa fa-plus"></i> Add New Products</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Alert Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key => $product)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->brand}}</td>
                                    <td>{{ number_format($product->price,2) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        @if($product->alert_stock >= $product->quantity)
                                            <span class="badge bg-danger">Low Stock > {{$product->alert_stock}}</span>
                                        @else
                                            <span class="badge bg-success">{{ $product->alert_stock }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editproduct{{ $product->id }}"><i class="fa fa-edit"></i>Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteproduct{{ $product->id }}"><i class="fa fa-trash"></i>Del</a>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal of Edit product Detail --}}
                                <div class="modal right fade" id="editproduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                {{ $product->id }}
                                            </div>
                                            <div class="modal-body">
                                            <form action="{{ route('products.update',$product->id) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" id="name" name="product_name" value="{{ $product->product_name}}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="brand" class="form-label">Brand</label>
                                                    <input type="text" name="brand" id="brand" value="{{ $product->brand}}" class="form-control">
                                                </div>
                                            
                                                <div class="mb-3">
                                                    <label for="price" class="form-label">Price</label>
                                                    <input type="number" class="form-control" value="{{ $product->price}}" id="price" name="price" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="quantity" class="form-label">Quantity</label>
                                                    <input type="number" class="form-control" value="{{ $product->quantity}}" id="quantity" name="quantity" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="stock" class="form-label">Alert Stock</label>
                                                    <input type="number" class="form-control" value="{{ $product->alert_stock}}" id="stock" name="alert_stock" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea name="description" id="description"  cols="30" rows="2" class="form-control">{{ $product->description }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update Product</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Delete Section --}}
                                <div class="modal right fade" id="deleteproduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Delete product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                {{ $product->id }}
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete {{ $product->product_name }}?</p>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {{$products->links()}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>SEARCH product</h4>
                    </div>
                    <div class="card-body">
                        <!-- Search form can be added here -->
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal for Adding New Product --}}
<div class="modal right fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control">
                    </div>
                   
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Alert Stock</label>
                        <input type="number" class="form-control" id="stock" name="alert_stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .modal.right .modal-dialog {
        top: 0;
        right: 0;
        margin-right: 5vh;
    }
    .modal.fade:not(.in).right.modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }
</style>
