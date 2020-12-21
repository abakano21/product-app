@extends('layouts.app')

@section('content')

<div class="container">

    <div class="py-2">

        <div class="dropdown dropright">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Language
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ $data['product']->path('en', request()->segment(3)) }}">EN</a>
                <a class="dropdown-item" href="{{ $data['product']->path('ar', request()->segment(3)) }}">AR</a>
            </div>
        </div>

        <div class="dropdown dropright mt-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Region
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ $data['product']->path(request()->segment(2), 'ae') }}">UAE</a>
                <a class="dropdown-item" href="{{ $data['product']->path(request()->segment(2), 'sa') }}">Saudi Arabia</a>
            </div>
        </div>

    </div>
</div>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8 col-sm-2">
            <div class="card">
                <div class="card-header">{{ __('Product Page') }}</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm">
                            <img class="shadow img-fluid" src="{{ $data['product']['image'] }}" alt="product image">
                        </div>
                        <div class="col-sm">
                            <div class="media-body p-2">
                                <h3 class="mt-0">{{ $data['product']['productTitle']}}</h3>
                                Price: {{ $data['product']['price'] }} {{ $data['product']['currency'] }}<br>
                                <div class="stock">
                                    @if($data['product']['quantity'] > 0) 
                                        In stock: {{ $data['product']['quantity'] }}
                                    @else 
                                        <span class="text-danger">Not available</span>
                                    @endif
                                    
                                </div>
                                <div class="action">
                                    <button id="add-product" class="btn btn-success btn-sm">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert2@7.12.10/dist/sweetalert2.all.js"></script>
    
<script>
    let addProduct = document.getElementById('add-product');
    addProduct.addEventListener("click", function() {
        swal({
            type: 'success',
            title: 'Added to cart',
            showConfirmButton: false,
            timer: 1500
        } ).then(function (hello) {
            // Send axios to server to update
        });
    })
</script>
@endsection
