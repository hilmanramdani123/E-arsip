<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['posts'];

    public function uploads()
    {
        return $this->hasMany(Upload::class, 'kategori', 'id');
    }
}
