<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $count_produk = Product::count();
        $total_category = Category::count();
        $total_stok = Product::sum('stock');
        $jumlah_testimoni = Testimoni::count();
        $total_harga = Product::sum('price');

        //jumlah produk
        $produk_kategori = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->selectRaw('product_categories.category_name, COUNT(products.category_id) as total_produk')
        ->groupBy('product_categories.category_name')
        ->pluck('total_produk', 'category_name');
        // dd($produk_kategori);
        $chartData = [];

        foreach ($produk_kategori as $kategori => $total_produk) {
            $chartData[] = ['name' => $kategori, 'y' => $total_produk];
        }

        //jumlah stock
        $produk_stock = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->selectRaw('product_categories.category_name, SUM(products.stock) as jumlah_produk')
        ->groupBy('product_categories.category_name')
        ->pluck('jumlah_produk', 'category_name');
        // dd($produk_kategori);
        $chartStock = [];

        foreach ($produk_stock as $kategori => $jumlah_produk) {
            $chartStock[] = ['name' => $kategori, 'y' => floatval($jumlah_produk)];
        }
        return view('pages.admin.dashboard', compact(
            'count_produk', 'total_category', 'total_stok', 'jumlah_testimoni', 'total_harga'
        ))->with([
            'chartData' => json_encode($chartData),
            'chartStock' => json_encode($chartStock),
        ]);
    }
}
