<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\kategoribuku;
use Illuminate\Support\Facades\Http;

class WebController extends Controller
{
    //kategori
    public function indexkategori()
    {
        // Send a GET request to the API endpoint
        $response = Http::get('http://127.0.0.1:8080/api/getkategori');

        // Check if the request was successful (status code 2xx)
        if ($response->successful()) {
            // Get the JSON data from the response
            $data = $response->json();

            // Now, you can work with the data as needed
            // For example, you can return it as a JSON response
            return view('admin.pages.kategori.index', ['data' => $data]);
        } else {
            // Handle the case where the request was not successful
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function tambahkategori()
    {
        return view('admin.pages.kategori.tambahkategori');
    }

    public function postkategori(Request $request)
    {
        $validatedData = $request->validate([
            'nama_buku' => 'required|String',
            'jenis_buku' => 'required|String',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/images');
            $foto = str_replace('public/', '', $gambarPath);
        } else {
            return response()->json(['error' => 'No image file provided'], 400);
        }
        $postData = [
            'nama_buku' => $validatedData['nama_buku'],
            'jenis_buku' => $validatedData['jenis_buku'],
            'gambar' => $foto,
        ];
        $response = Http::post('http://127.0.0.1:8080/api/postkategori', $postData);
        if ($response->successful()) {
            return redirect()->route('kategori.index')->with('success', 'data telah ditambahkan');
        } else {
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function editkategori($id)
    {
        $response = Http::get('http://127.0.0.1:8080/api/edit/kategori/' . $id);

        if ($response->successful()) {
            $data = $response->json();
            return view('admin.pages.kategori.editkategori', ['data' => $data]);
        } else {
            // Handle the case where the request was not successful
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function updatekategori(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama_buku' => 'required|string',
            'jenis_buku' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        // Handle file upload if a new image is provided
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/images');
            $foto = str_replace('public/', '', $gambarPath);
        }
        // Prepare the data to be sent in the PUT request
        $postData = [
            'nama_buku' => $validatedData['nama_buku'],
            'jenis_buku' => $validatedData['jenis_buku'],
            'gambar' => $foto
        ];

        // Make the PUT request to the external API
        $response = Http::put('http://127.0.0.1:8080/api/update/kategori/' . $id, $postData);

        if ($response->successful()) {
            // Successfully updated on the external API
            return redirect()->route('kategori.index')->with('success', 'Data has been updated successfully');
        } else {
            // Handle the case where the API request failed
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function deletekategori($id)
    {
        $request =  Http::delete('http://127.0.0.1:8080/api/delete/kategori/' . $id);
        if ($request->successful()) {
            // Successfully updated on the external API
            return redirect()->route('kategori.index')->with('success', 'Data has been deleted successfully');
        } else {
            // Handle the case where the API request failed
            return response()->json(['error' => 'API request failed'], $request->status());
        }
    }

    //controller buku
    public function indexbooks()
    {
        $response = Http::get('http://127.0.0.1:8080/api/getbooks');

        // Check if the request was successful (status code 2xx)
        if ($response->successful()) {
            // Get the JSON data from the response
            $data = $response->json();

            // Now, you can work with the data as needed
            // For example, you can return it as a JSON response
            return view('admin.pages.books.index', ['data' => $data]);
        } else {
            // Handle the case where the request was not successful
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function addbooks()
    {
        $data = kategoribuku::all();
        return view('admin.pages.books.addbooks', compact('data'));
    }

    public function bookstore(Request $request)
    {
        $validatedData = $request->validate([
            'id_kategori' => 'required',
            'title' => 'required|String',
            'author' => 'required|String',
            'description' => 'required',
            'price' => 'required',
            'published_date' => 'required|date',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/images');
            $foto = str_replace('public/', '', $gambarPath);
        } else {
            return response()->json(['error' => 'No image file provided'], 400);
        }
        $postData = [
            'id_kategori' => $validatedData['id_kategori'],
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'published_date' => $validatedData['published_date'],
            'image' => $foto,
        ];
        $response = Http::post('http://127.0.0.1:8080/api/postbooks', $postData);
        if ($response->successful()) {
            return redirect()->route('books.index')->with('success', 'data telah ditambahkan');
        } else {
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function editbooks($id)
    {
        $response = Http::get('http://127.0.0.1:8080/api/edit/books/' . $id);

        if ($response->successful()) {
            $data = $response->json();
            $jbook = kategoribuku::all();
            return view('admin.pages.books.editbooks', compact('jbook'), ['data' => $data]);
        } else {
            // Handle the case where the request was not successful
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function updatebooks(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_kategori' => 'required',
            'title' => 'required|String',
            'author' => 'required|String',
            'description' => 'required',
            'price' => 'required',
            'published_date' => 'required|date',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/images');
            $foto = str_replace('public/', '', $gambarPath);
        } else {
            return response()->json(['error' => 'No image file provided'], 400);
        }
        $postData = [
            'id_kategori' => $validatedData['id_kategori'],
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'published_date' => $validatedData['published_date'],
            'image' => $foto,
        ];
        $response = Http::put('http://127.0.0.1:8080/api/update/books/' . $id, $postData);
        if ($response->successful()) {
            return redirect()->route('books.index')->with('success', 'data telah diupdate');
        } else {
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }
    public function deletebooks($id)
    {
        $request =  Http::delete('http://127.0.0.1:8080/api/delete/books/' . $id);
        if ($request->successful()) {
            // Successfully updated on the external API
            return redirect()->route('books.index')->with('success', 'Data has been deleted successfully');
        } else {
            // Handle the case where the API request failed
            return response()->json(['error' => 'API request failed'], $request->status());
        }
    }

    //controller transaksi
    public function indextransaction()
    {
        $response = Http::get('http://127.0.0.1:8080/api/gettransaksi');

        // Check if the request was successful (status code 2xx)
        if ($response->successful()) {
            // Get the JSON data from the response
            $data = $response->json();

            // Now, you can work with the data as needed
            // For example, you can return it as a JSON response
            return view('admin.pages.transaksi.index', ['data' => $data]);
        } else {
            // Handle the case where the request was not successful
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }

    public function deletetransaksi($id)
    {
        $request =  Http::delete('http://127.0.0.1:8080/api/delete/transaksi/' . $id);
        if ($request->successful()) {
            // Successfully updated on the external API
            return redirect()->route('transaction.index')->with('success', 'Data has been deleted successfully');
        } else {
            // Handle the case where the API request failed
            return response()->json(['error' => 'API request failed'], $request->status());
        }
    }


    public function updatetransaksi(Request $request, $id)
    {
        $validatedata = $request->validate([
            'status' => 'required', // Add validation rules as needed
        ]);
        $postData = [
            'status' => $validatedata['status']
        ];
        $response = Http::put('http://127.0.0.1:8080/api/update/transaksi/' . $id, $postData);
        if ($response->successful()) {
            return redirect()->route('transaction.index')->with('success', 'data telah diupdate');
        } else {
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }
}
