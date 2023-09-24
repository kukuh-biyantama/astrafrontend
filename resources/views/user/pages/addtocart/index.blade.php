@extends('user.layout.mother')

@section('title', 'Page Title')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-3"><a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                        <hr>
                        <div class="row">
                            <div class="col-lg-7">
                                <!-- Display cart item details -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    <img src="{{ asset('storage/'.$cartItems->image) }}" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                </div>
                                                <div class="ms-3">
                                                    <h5>{{ $cartItems->title }}</h5>
                                                    <p class="small mb-0">{{ $cartItems->description }}</p>
                                                </div>
                                                <form action="{{ route('rating.store', $cartItems->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div style="margin-left:10% ">
                                                        <label for="alamat_pengiriman" class="form-label">Rating Buku</label>
                                                        <input type="number" name="rating" id="rating" class="form-control" >
                                                    </div>
                                                    <button type="submit" style="margin-top: 10%; margin-left:10%">berikan rating</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Quantity and Total Price Form -->
                                <form id="priceCalculatorForm" action="{{ route('transaksi.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="id_users" value="{{ $id_users }}">
                                    <input type="hidden" name="id_books" value="{{ $cartItems->id }}">
                                    
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Pembeli:</label>
                                        <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman:</label>
                                        {{-- <input type="text" class="form-control" id="alamat_pengiriman" name="alamat_pengiriman"> --}}
                                        <textarea name="alamat_pengiriman" class="form-control" id="alamat_pengiriman" cols="30" rows="10"></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity:</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="itemPrice" class="form-label">Item Price:</label>
                                        <input type="number" class="form-control" id="itemPrice" name="item_price" value="{{ $cartItems->price }}" readonly>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" id="calculateTotal">Total Seluruh</button>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="totalPrice" class="form-label">Total Price:</label>
                                        <input type="text" class="form-control" id="totalPrice" readonly name="biaya">
                                    </div>

                                    <button type="submit">Belanja</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript to update the rating value -->
<script>
    // Assuming you have jQuery loaded
    $(document).ready(function() {
        $('#rating').change(function() {
            // You can access the rating value using $(this).val()
            var rating = $(this).val();
            console.log('Selected rating: ' + rating);

            // You can implement an AJAX call here to save the rating to the server
            // Example AJAX call (you need to define your route and controller):
            // $.ajax({
            //     url: '/ratings/{book}', // Define the correct URL
            //     method: 'POST',
            //     data: {
            //         rating: rating,
            //     },
            //     success: function(response) {
            //         // Handle the success response
            //     },
            //     error: function(error) {
            //         // Handle errors
            //     },
            // });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.getElementById('quantity');
        const itemPriceInput = document.getElementById('itemPrice');
        const calculateButton = document.getElementById('calculateTotal');
        const totalPriceInput = document.getElementById('totalPrice');

        calculateButton.addEventListener('click', function () {
            const quantity = parseInt(quantityInput.value, 10);
            const pricePerItem = parseFloat(itemPriceInput.value);

            if (!isNaN(quantity) && !isNaN(pricePerItem)) {
                const totalPrice = quantity * pricePerItem;
                totalPriceInput.value = totalPrice;
            } else {
                totalPriceInput.value = 'Invalid Input';
            }
        });
    });
</script>
@endsection
