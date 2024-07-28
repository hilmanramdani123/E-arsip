@extends('layouts.document')

@section('title', 'Edit Surat')

@section('header')
<div class="header">
  Edit Dokumen
</div>
@endsection

@section('content')
  <form action="{{ route('dokumen.update', $upload->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="nomor_dokumen">Nomor Dokumen</label>
      <input type="text" class="form-control" id="nomor_dokumen" name="nomor_dokumen" value="{{ $upload->nomor_dokumen }}" required>
    </div>
    <div class="form-group">
      <label for="nama_dokumen">Nama Dokumen</label>
      <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" value="{{ $upload->nama_dokumen }}" required>
    </div>
    <div class="form-group">
      <label for="kategori">Kategori</label>
      <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $upload->kategori }}" required>
    </div>
    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $upload->deskripsi }}</textarea>
    </div>
    <div class="form-group">
      <label for="unggah">File</label>
      <div class="input-group">
        <input type="text" class="form-control" id="unggah" value="{{ basename($upload->file_path) }}" readonly>
        <div class="input-group-append">
          <a href="{{ asset('storage/' . $upload->file_path) }}" target="_blank" class="btn btn-outline-secondary">
            <i class="fas fa-eye"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="form-group text-center">
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ route('dokumen.index') }}" class="btn btn-secondary">Batal</a>
    </div>
  </form>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.getElementById('unggah');
    var fileNameInput = document.getElementById('unggah_nama');

    fileInput.addEventListener('change', function(e) {
      var fileName = e.target.files[0].name;
      fileNameInput.value = fileName;
    });
  });
</script>
@endsection
