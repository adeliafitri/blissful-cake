<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        //jumlah produk
        $produk_kategori = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->selectRaw('product_categories.category_name, products.product_name, products.description, products.price, products.image, COUNT(products.category_id) as total_produk')
        ->groupBy('product_categories.category_name', 'products.product_name', 'products.description', 'products.price', 'products.image')
        ->get();
        // dd($produk_kategori);
        $chartData = [];

        foreach ($produk_kategori as $data) {
            $chartData[] = [
                'category_name' => $data->category_name,
                'product_name' => $data->product_name,
                'description' => $data->description,
                'price' => $data->price,
                'image' => $data->image,
                'total_produk' => $data->total_produk,
            ];
        }

        $testimoni = Testimoni::all();

        return view('pages.user.index')->with([
            'chartData' => $chartData,
            'testimoni' => $testimoni
        ]);
    }
}
