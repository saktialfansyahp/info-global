<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_colors'; // Menyebutkan nama tabel yang sesuai

    protected $fillable = [
        'product_id',
        'color_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function scopeSortByAscending($query, $by){
        return $query->join('products', 'product_colors.product_id', '=', 'products.id')
            ->join('colors', 'product_colors.color_id', '=', 'colors.id')
            ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->orderBy($by, 'asc');
    }
    public function scopeSortByDescending($query, $by){
        return $query->join('products', 'product_colors.product_id', '=', 'products.id')
            ->join('colors', 'product_colors.color_id', '=', 'colors.id')
            ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->orderBy($by, 'desc');
    }

}
