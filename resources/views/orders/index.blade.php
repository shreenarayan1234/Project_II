@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">ORDERED PRODUCTS</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addProduct"><i class="fa fa-plus"></i> Add New Products</a>
                    </div>
                    <form action="{{ route('orders.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Dis (%)</th>
                                    <th>Total</th>
                                    <th><a href="#" class="btn btn-sm btn-success add_more rounded-circle"><i class="fa fa-plus"></i></a></th>
                                </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <select name="product_id[]" id="product_id" class="form-control product_id">
                                        <option value="">Select Item</option>
                                        @foreach ($products as $product)
                                        <option data-price="{{$product->price}}" 
                                            value="{{$product->id}}">
                                            {{$product->product_name}}
                                        </option>
                                        @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" id="quantity" 
                                        class="form-control quantity">
                                    </td>
                                    <td>
                                        <input type="number" name="price[]" id="price" 
                                        class="form-control price">
                                    </td>
                                    <td>
                                        <input type="number" name="discount[]" id="discount" 
                                        class="form-control discount">
                                    </td>
                                    <td>
                                        <input type="number" name="total_amount[]" id="total_amount" 
                                        class="form-control total_amount">
                                    </td>
                                    <td><a href="#" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times"></i></a></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>TOTAL <b class="total">0.00</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="panel">
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <td>
                                            <label for="">Customer Name</label>
                                            <input type="text" name="customer_name" id="" class="form-control">
                                        </td>
                                        <td>
                                            <label for="">Customer Phone</label>
                                            <input type="number" name="customer_phone" id="" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                                    <td>
                                        Payment Method <br/>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="cash" checked="checked">
                                            <label for="payment_method"><i class="fa fa-money-bill text-success"></i>Cash</label>
                                        </span>

                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="bank transform">
                                            <label for="payment_method"><i class="fa fa-university text-danger"></i>Bank Transfer</label>
                                        </span>

                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="credit Card">
                                            <label for="payment_method"><i class="fa fa-credit-card text-info"></i>Credit Card</label>
                                        </span>
                                    </td><br/>
                                    <td>
                                        Payment 
                                        <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                                    </td>
                                    <td>
                                        Returning Change 
                                        <input type="number" readonly name="balance" id="balance" class="form-control">
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-md btn-block mt-3">Save</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-md btn-block mt-2">Calculator</button>
                                    </td>
                                    <td>
                                        <a href="#" class="text-center mt-2"><i class="fa fa-sign-out-alt"></i> Logout</a>
                                    </td>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
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
    .radio-item input[type="radio"] {
    visibility: hidden;
    width: 20px;
    height: 20px;
    margin: 0 5px 0 5px;
    padding: 0;
    cursor: pointer;
    position: relative;
}

/* before style */
.radio-item input[type="radio"]:before {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: inline-block;
    visibility: visible;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid rgb(150, 150, 150);
    background: radial-gradient(circle, rgb(255, 255, 255) 0%, rgb(240, 240, 240) 100%);
    content: '';
    transition: all 0.3s ease;
    cursor: pointer;
}

/* after style */
.radio-item input[type="radio"]::after {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: inline-block;
    border-radius: 50%;
    visibility: hidden;
    width: 12px;
    height: 12px;
    background: radial-gradient(circle, rgb(144, 238, 144) 0%, rgb(34, 139, 34) 100%);
    content: '';
    transition: all 0.3s ease;
    cursor: pointer;
}

.radio-item input[type="radio"]:checked:before {
    border-color: green;
    background: radial-gradient(circle, rgb(255, 255, 255) 0%, rgb(144, 238, 144) 100%);
}

.radio-item input[type="radio"]:checked:after {
    visibility: visible;
    transform: translate(-50%, -50%) scale(1.2);
}
.radio-item label{
    display: inline-block;
    margin: 0;
    padding: 0;
    line-height: 25px;
    height: 25px;
    cursor: pointer;
}
</style>
@section('script')
    <!-- <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     alert(1);
        // });

        // $(document).ready(function(){
        //     $(document).on('click', '.add_more', function(event){
        //         event.preventDefault();  // Prevent the default anchor behavior
        //         alert(0);
        //     });

        $('.add_more').on('click',function(){
            var product = $('.product_id').html();
            var numberfrow = ($('.addMoreProduct tr').length - 0) + 1;
            var tr = '<tr><td class="no">' +numberfrow + '</td>'+ 
                '<td><select class="form-control product_id" name="product_id[]">' + product + 
                '</select></td>' +
                '<td><input type="number" name="quantity[]" class="form-control"></td>' +
                '<td><input type="number" name="price[]" class="form-control"></td>' +
                '<td><input type="number" name="discount[]" class="form-control"></td>' +
                '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>' + 
                '<td><a class="btn btn-danger btn-sm delete rounded-circle"><i class="fa fa-times-circle"></i></a></td>' ;
                $('.addMoreProduct').append(tr);
        });

        //Delete a row
        $('.addMoreProduct').delegate('.delete', 'click', function(){
            $(this).parent().parent().remove();
        })
        function TotalAmount(){
            var total = 0;
            $('.total_amount').each(function(i, e){
                var amount = $(this).val() - 0;
                total +=amount;
            });
            $('.total').html(total);
        }

        $('.addMoreProduct').delegate('.product_id','change',function(){
            var tr = $(this).parent().parent();
            var price = tr.find('.product_id option:selected').attr('data-price');
            tr.find('.price').val(price);
            var qty = tr.find('.qunatity').val() - 0;
            var disc = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;
            var total_amount = (qty * price) - ((qty * price * disc)/100);
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });
    </script> -->
    <script>
          $(document).ready(function() {
            // Add more products row
            $('.add_more').on('click', function() {
                var product = $('.product_id').html();
                var numberfrow = ($('.addMoreProduct tr').length - 0) + 1;
                var tr = '<tr><td class="no">' + numberfrow + '</td>' +
                    '<td><select class="form-control product_id" name="product_id[]">' + product + '</select></td>' +
                    '<td><input type="number" name="quantity[]" class="form-control quantity"></td>' +
                    '<td><input type="number" name="price[]" class="form-control price"></td>' +
                    '<td><input type="number" name="discount[]" class="form-control discount"></td>' +
                    '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>' +
                    '<td><a href="#" class="btn btn-danger btn-sm delete rounded-circle"><i class="fa fa-times-circle"></i></a></td></tr>';
                $('.addMoreProduct').append(tr);
            });

            // Delete a row
            $('.addMoreProduct').delegate('.delete', 'click', function() {
                $(this).parent().parent().remove();
                TotalAmount();
            });

            // Calculate total amount for each row
            $('.addMoreProduct').delegate('.product_id, .quantity, .discount', 'change', function() {
                var tr = $(this).closest('tr');
                var price = tr.find('.product_id option:selected').data('price');
                tr.find('.price').val(price);

                var qty = tr.find('.quantity').val() - 0;
                var disc = tr.find('.discount').val() - 0;
                var total_amount = (qty * price) - ((qty * price * disc) / 100);
                tr.find('.total_amount').val(total_amount);

                TotalAmount();
            });

            // Calculate the total amount
            function TotalAmount() {
                var total = 0;
                $('.total_amount').each(function(i, e) {
                    var amount = $(this).val() - 0;
                    total += amount;
                });
                $('.total').html(total.toFixed(2));
            }
        });
        $('#paid_amount').keyup(function(){
            // alert(1);
            var total = $('.total').html();
            var paid_amount = $(this).val();
            var tot = paid_amount -total;
            $('#balance').val(tot).toFixed(2);
        })
    </script>
@endsection
