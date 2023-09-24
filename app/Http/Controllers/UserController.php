<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\book;
use App\Models\transaksi;
use Illuminate\Support\Facades\Auth;
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
        $id_users = Auth::id();
        $cartItems = book::find($id);
        //dd($cartItems);
        return view('user.pages.addtocart.index', compact('cartItems', 'id_users'));
    }

    public function transaksistore(Request $request)
    {
        $validatedData = $request->validate([
            'id_books' => 'required',
            'id_users' => 'required',
            'nama_pembeli' => 'required',
            'alamat_pengiriman' => 'required',
            'quantity' => 'required',
            'biaya' => 'required'
        ]);
        $postData = [
            'id_books' => $validatedData['id_books'],
            'id_users' => $validatedData['id_users'],
            'nama_pembeli' => $validatedData['nama_pembeli'],
            'alamat_pengiriman' => $validatedData['alamat_pengiriman'],
            'total_buku' => $validatedData['quantity'],
            'biaya' => $validatedData['biaya']
        ];
        $response = Http::post('http://127.0.0.1:8080/api/posttransaksi', $postData);
        if ($response->successful()) {
            return redirect()->route('dashboard.user')->with('success', 'belanja diproses');
        } else {
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function storerating(Request $request, $id)
    {
        $data = book::findorfail($id);
        $data->update([
            'rating' => $request->input('rating')
        ]);
        return redirect()->route('dashboard.user')->with('success', 'menambahkan rating terimakasih');
    }
}
