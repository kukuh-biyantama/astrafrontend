<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\book;
use App\Models\transaksi;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    //user index

    public function index()
    {
        $response = Http::get('http://127.0.0.1:8080/api/getbooks');

        // Check if the request was successful (status code 2xx)
        if ($response->successful()) {
            // Get the JSON data from the response
            $data = $response->json();

            // Now, you can work with the data as needed
            // For example, you can return it as a JSON response
            return view('user.pages.index', ['data' => $data]);
        } else {
            // Handle the case where the request was not successful
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function cart($id)
    {
        $cartItems = book::find($id);
        //dd($cartItems);
        return view('user.pages.addtocart.index', compact('cartItems'));
    }
}
