<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Upload extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'nomor_dokumen',
        'nama_dokumen',
        'kategori',
        'deskripsi',
        'tanggal_unggah',
        'file_path',
        'user_id',
    ];

    protected $casts = [
        'tanggal_unggah' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFilePath()
    {
        return Storage::url($this->file_path);
    }
}

