<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $query = Category::query();

        // Cek apakah ada parameter pencarian
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('category_name', 'like', '%' . $searchTerm . '%');
            });
        }

        $product_categories = $query->paginate(5);

        $startNumber = ($product_categories->currentPage() - 1) * $product_categories->perPage() + 1;

        return view('pages.admin.productCategory.productCategory', [
            'data' => $product_categories,
            'startNumber' => $startNumber,
        ])->with('success', 'Data Kategori Produk Ditemukan');
    }

    public function create() {
        return view('pages.admin.productCategory.addProductCategory');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'category_name' => 'required|string',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        try {
            Category::create([
                'category_name' => $request->category_name,

            ]);

            return redirect()->route('productCategories')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Data Gagal Ditambahkan: '.$e->getMessage()])->withInput();
        }
    }

    public function edit($id) {
        $product_categories = Category::find($id);
        return view('pages.admin.productCategory.editProductCategory', [
            'success' => 'Data Ditemukan',
            'data' => $product_categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'category_name' => 'required|string',
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        try {
            $product_categories = Category::find($id);
            $product_categories->update([
                'category_name' => $request->category_name,
            ]);

            return redirect()->route('productCategories')->with([
                'success' => 'Data Berhasil Diupdate',
                'data' => $product_categories
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage(), $e->getTrace()); // Tambahkan ini untuk melihat pesan kesalahan
            return redirect()->route('productCategories.edit', $id)->with('error', 'Data Gagal Diupdate: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            Category::where('id', $id)->delete();

            return redirect()->route('productCategories')
                ->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('productCategories')
                ->with('error', 'Data gagal dihapus: ' . $e->getMessage());
        }
    }

    public function getCategories()
    {
        $categories = DB::table('product_categories')->pluck('category_name', 'id');
        return view('pages.addproduct', compact('categories'));
    }

}
