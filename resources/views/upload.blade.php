@extends('layouts.document')

@section('title', 'Unggah Dokumen')

@section('header')
<div class="header">
  Unggah Dokumen
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data" id="uploadForm">
    @csrf
    <div class="form-group">
      <label for="nomor_dokumen">Nomor Dokumen</label>
      <input type="text" class="form-control" id="nomor_dokumen" name="nomor_dokumen" placeholder="Masukkan nomor surat..." required>
    </div>
    <div class="form-group">
      <label for="nama_dokumen">Nama Dokumen</label>
      <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" placeholder="Masukkan nama surat..." required>
    </div>
    <div class="form-group">
      <label for="kategori">Kategori</label>
      <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan kategori surat..." required>
    </div>
    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi surat..."></textarea>
    </div>
    <div class="form-group">
      <label for="tanggal_unggah">Tanggal Unggah</label>
      <input type="date" class="form-control" id="tanggal_unggah" name="tanggal_unggah" required>
    </div>
    <div class="mb-3">
      <label for="unggah" class="form-label">Unggah File</label>
      <input class="form-control" type="file" id="unggah" name="unggah" required>
      <p class="file-description">File yang dapat diunggah berformat PDF dengan ukuran maksimal 20 MB.</p>
    </div>
    <div class="form-group text-center">
      <button type="submit" class="btn btn-primary">Unggah</button>
    </div>
</form>

@if($errors->any())
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: '@foreach ($errors->all() as $error){{ $error }} @endforeach',
      confirmButtonText: 'OK'
    });
  </script>
@endif

@if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '{{ session('success') }}',
      confirmButtonText: 'OK'
    });
  </script>
@endif
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.getElementById('unggah');
    var fileLabel = fileInput.nextElementSibling;

    fileInput.addEventListener('change', function(e) {
      var fileName = e.target.files[0].name;
      fileLabel.textContent = fileName;
    });
  });
</script>
@endsection
