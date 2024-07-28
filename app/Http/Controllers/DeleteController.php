<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DeleteController extends Controller
{
    public function destroy($id)
    {
        try {
            $upload = Upload::findOrFail($id);

            if ($upload->file_path) {
                $file_path = 'arsip/' . $upload->file_path;
                if (Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                } else {
                    Log::error('File does not exist: ' . $file_path);
                }
            }

            $upload->delete();

            return response()->json(['success' => 'Dokumen berhasil dihapus.']);
        } catch (\Exception $e) {
            Log::error('Error deleting document: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
