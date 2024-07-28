<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

class EditController extends Controller
{
    public function edit($id)
    {
        $upload = Upload::findOrFail($id);
        return view('edit', compact('upload'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nomor_dokumen' => 'required|string|max:255',
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'unggah' => 'nullable|file|max:10240|mimes:pdf',
        ], [
            'unggah.max' => 'Ukuran file tidak boleh melebihi 10MB.',
            'unggah.mimes' => 'File yang diunggah harus berformat PDF.',
        ]);

        try {
            $upload = Upload::findOrFail($id);

            $upload->nomor_dokumen = trim(strip_tags($validatedData['nomor_dokumen']));
            $upload->nama_dokumen = trim(strip_tags($validatedData['nama_dokumen']));
            $upload->kategori = trim(strip_tags($validatedData['kategori']));
            $upload->deskripsi = trim(strip_tags($validatedData['deskripsi']));

            if ($request->hasFile('unggah')) {
                if ($upload->file_path) {
                    Storage::disk('public')->delete($upload->file_path);
                }

                $file = $request->file('unggah');
                $filePath = $file->store('arsip', ['disk' => 'public']);
                $upload->file_path = $filePath;
            }

            $upload->save();

            return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
