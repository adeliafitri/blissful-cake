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
        ->selectRaw('DISTINCT product_categories.category_name, products.product_name, products.description, products.price, products.image, COUNT(products.category_id) as total_produk')
        ->groupBy('product_categories.category_name', 'products.product_name', 'products.description', 'products.price', 'products.image')
        ->get();
        // dd($produk_kategori);
        $groupedProduk = collect($produk_kategori)->groupBy('category_name');
        // dd($groupedProduk);
        $chartData = [];

        foreach ($groupedProduk as $category => $products) {
            $total_produk = $products->count();
            $chartData[] = [
                'category_name' => $category,
                'total_produk' => $total_produk,
                'products' => $products->toArray(),
                // 'product_name' => $data->product_name,
                // 'description' => $data->description,
                // 'price' => $data->price,
                // 'image' => $data->image,
                // 'total_produk' => $data->total_produk,
            ];
        }
        // dd($chartData);
        $testimoni = Testimoni::all();

        return view('pages.user.index')->with([
            'chartData' => $chartData,
            'testimoni' => $testimoni
        ]);
    }
}
