@extends('user.layout.mother')
 
@section('title', 'Page Title')

@section('content')
<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-7">
                                <h5 class="mb-3"><a href="#!" class="text-body"><i
                                            class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <p class="mb-1">Shopping cart</p>
                                        <p class="mb-0">You have {{ $cartItems->count() }} items in your cart</p>
                                    </div>
                                    <div>
                                        <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                                                class="text-body">price <i
                                                    class="fas fa-angle-down mt-1"></i></a></p>
                                    </div>
                                </div>
                                <!-- Display cart item details -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    <img
                                                        src="{{ asset('storage/'.$cartItems->image) }}"
                                                        class="img-fluid rounded-3" alt="Shopping item"
                                                        style="width: 65px;">
                                                </div>
                                                <div class="ms-3">
                                                    <h5>{{ $cartItems->title }}</h5>
                                                    <p class="small mb-0">{{ $cartItems->description }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <div style="width: 50px;">
                                                    {{-- <h5 class="fw-normal mb-0">{{ $cartItems->pivot->quantity }}</h5> --}}
                                                </div>
                                                <div style="width: 80px;">
                                                    <h5 class="mb-0">Rp{{ $cartItems->price }}</h5>
                                                </div>
                                                <a href="#!" style="color: #cecece;"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add rating input field -->
                                <!-- Add rating input field -->
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating:</label>
                                    <input type="number" class="form-control" id="rating" name="rating" min="1" max="5">
                                </div>

                                
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

@endsection
