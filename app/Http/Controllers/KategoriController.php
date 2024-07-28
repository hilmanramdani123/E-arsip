<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class KategoriController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $categories = Upload::select('kategori', DB::raw('count(*) as total'))
            ->where('user_id', $userId)
            ->groupBy('kategori')
            ->get();

        return view('kategori', compact('categories'));
    }

    public function show($kategori)
    {
        $userId = Auth::id();
        $suratPerKategori = Upload::where('kategori', $kategori)
            ->where('user_id', $userId)
            ->paginate(50);
        return view('kategori_show', compact('suratPerKategori', 'kategori'));
    }



    public function edit($kategori, $id)
    {
        $surat = Upload::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('edit', compact('surat', 'kategori'));
    }

    public function update(Request $request, $kategori, $id)
    {
        $surat = Upload::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $surat->update($request->all());

        return redirect()->route('kategori.show', $kategori)->with('success', 'Surat berhasil diperbarui');
    }
}
