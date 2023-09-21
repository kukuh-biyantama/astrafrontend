<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    route::get('/dashboard/admin', function () {
        return view('admin.pages.index');
    })->name('dashboard.admin');

    //tambah kategori buku
    Route::get('/indexkategori', [WebController::class, 'indexkategori'])->name('kategori.index');
    Route::get('/tambah/formkategori', [WebController::class, 'tambahkategori'])->name('kategori.addkat');
    Route::post('/postkategori', [WebController::class, 'postkategori'])->name('kategori.post');
    Route::put('/update/kategori/{id}', [WebController::class, 'updatekategori'])->name('kategori.update');
    Route::delete('/delete/kategori/{id}', [WebController::class, 'deletekategori'])->name('kategori.delete');
    Route::get('/edit/kategori/{id}', [WebController::class, 'editkategori'])->name('kategori.edit');

    //books store
    Route::get('/indexbooks', [WebController::class, 'indexbooks'])->name('books.index');
    Route::get('/books/add/', [WebController::class, 'addbooks'])->name('books.add');
    Route::post('/store/books', [WebController::class, 'bookstore'])->name('books.store');
    Route::get('/edit/kategoribooks/{id}', [WebController::class, 'editbooks'])->name('books.edit');
    Route::put('/update/books/{id}', [WebController::class, 'updatebooks'])->name('books.update');
    Route::delete('/delete/books/{id}', [WebController::class, 'deletebooks'])->name('books.delete');

    //transaction 
    Route::get('/indextransaction', [WebController::class, 'indextransaction'])->name('transaction.index');
    Route::delete('/delete/transaksi/{id}', [WebController::class, 'deletetransaksi'])->name('transaction.delete');
    Route::put('/update/transaksi/{id}', [WebController::class, 'updatetransaksi'])->name('transaksi.update');
});
Route::middleware(['auth', 'role:user'])->group(function () {
    route::get('/dashboard/user', [UserController::class, 'index'])->name('dashboard.user');
    route::get('/cart/{id}', [UserController::class, 'cart'])->name('dashboard.cart');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
