<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;
    protected $fillable = ['id_kategori', 'title', 'author', 'description', 'price', 'published_date', 'image'];

    public function kategoribuku()
    {
        return $this->belongsTo(kategoribuku::class, 'id_kategori', 'id');
    }
    public function booksInCart()
    {
        return $this->belongsToMany(book::class, 'cart_items')
            ->withPivot(['quantity']) // Assuming you want to store the quantity of each book in the cart
            ->withTimestamps(); // Assuming you want to track when books were added to the cart
    }
}
