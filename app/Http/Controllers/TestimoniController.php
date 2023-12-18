<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{
    public function index(Request $request){
        $query = Testimoni::query();

        // Cek apakah ada parameter pencarian
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        $testimoni = $query->paginate(5);

        $startNumber = ($testimoni->currentPage() - 1) * $testimoni->perPage() + 1;

        return view('pages.admin.testimoni.testimoni', [
            'data' => $testimoni,
            'startNumber' => $startNumber,
        ])->with('success', 'Data Testimoni Ditemukan');
    }

    public function store(Request $request) {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'job' => 'required|string',
            'message' => 'required|string',
        ]);
        // dd($validate);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        try {
            Testimoni::create([
                'name' => $request->name,
                'job' => $request->job,
                'message' => $request->message,
            ]);
            // dd($testimoni);
            return redirect('')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => 'Data Gagal Ditambahkan: '.$e->getMessage()])->withInput();
        }
    }
}
