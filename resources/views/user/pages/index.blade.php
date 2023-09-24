@extends('user.layout.mother')
 
@section('title', 'Page Title')
 
@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($data['data'] as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge -->
                        <div class="badge bg-primary text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image -->
                        <img src="{{ asset('storage/' . $product['image']) }}" alt="Image" style="width: 100%; height:200px">
                        <!-- Product details -->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name -->
                                <h5 class="fw-bolder">{{ $product['title'] }}</h5>
                                <!-- Product reviews -->
                                @if ($product['rating'] > 0)
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $product['rating'])
                                                <div class="bi-star-fill"></div>
                                            @else
                                                <div class="bi-star"></div>
                                            @endif
                                        @endfor
                                    </div>
                                @endif
                                <!-- Product price -->
                                <span class="">Rp {{ $product['price'] }}</span>
                            </div>
                        </div>
                        <!-- Product actions -->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('dashboard.cart', $product['id']) }}">Add to cart</a></div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <button type="button" class="btn btn-outline-danger mt-auto" data-bs-toggle="modal" data-bs-target="#productModal{{$product['id']}}">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
            @endforeach
            @foreach ($data['data'] as $product)
            <!-- Modal -->
            <div class="modal fade" id="productModal{{$product['id']}}" tabindex="-1" aria-labelledby="productModalLabel{{$product['id']}}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel{{$product['id']}}">Product Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Product details content goes here for item with ID {{$product['id']}} -->
                            <h5 class="fw-bolder">{{$product['title']}}</h5>
                            <p>{{$product['description']}}</p>
                            <p>Price: ${{$product['price']}}</p>
                            <!-- Add more product details here -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection