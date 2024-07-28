<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function create()
    {
        return view('upload');
    }

    public function index()
    {
        $uploads = Upload::where('user_id', Auth::id())->paginate(50);
        return view('arsip', compact('uploads'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_dokumen' => 'required|string|max:255',
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_unggah' => 'required|date',
            'unggah' => 'required|file|max:20480|mimes:pdf',
        ], [
            'unggah.max' => 'Ukuran file tidak boleh melebihi 20MB.',
            'unggah.mimes' => 'File yang diunggah harus berformat PDF.',
        ]);

        try {
            $file = $request->file('unggah');
            $originalFilename = $file->getClientOriginalName();
            $uniqueFilename = pathinfo($originalFilename, PATHINFO_FILENAME) . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();

            $filePath = $file->storeAs('arsip', $uniqueFilename, ['disk' => 'public']);

            $upload = new Upload([
                'nomor_dokumen' => trim(strip_tags($validatedData['nomor_dokumen'])),
                'nama_dokumen' => trim(strip_tags($validatedData['nama_dokumen'])),
                'kategori' => trim(strip_tags($validatedData['kategori'])),
                'deskripsi' => trim(strip_tags($validatedData['deskripsi'])),
                'tanggal_unggah' => $validatedData['tanggal_unggah'],
                'file_path' => $filePath,
                'user_id' => Auth::id(), // Simpan user_id dari user yang sedang login
            ]);
            $upload->save();

            return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diunggah.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
