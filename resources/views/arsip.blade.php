@extends('layouts.archive')

@section('title', 'Daftar Arsip | E-Arsip')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <span class="header-text">Daftar Arsip</span>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-primary" onclick="window.location.href='{{ url('upload') }}'">
                    <i class="fas fa-plus"></i> Tambah Arsip
                </button>
                <div class="d-flex">
                    <input type="text" id="searchInput" class="form-control search-input" placeholder="Cari dokumen...">
                </div>
            </div>
            <div class="table-responsive mb-5">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Nama Surat</th>
                            <th>Kategori</th>
                            <th>Tanggal Unggah</th>
                            <th>Deskripsi</th>
                            <th>Berkas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="documentTableBody">
                        @foreach($uploads as $index => $upload)
                            <tr id="dokumen-{{ $upload->id }}">
                                <td>{{ $uploads->firstItem() + $index }}</td>
                                <td>{{ $upload->nomor_dokumen }}</td>
                                <td>{{ $upload->nama_dokumen }}</td>
                                <td>{{ $upload->kategori }}</td>
                                <td>{{ $upload->tanggal_unggah->format('Y-m-d') }}</td>
                                <td>{{ $upload->deskripsi }}</td>
                                <td>
                                    <a href="{{ Storage::url($upload->file_path) }}" target="_blank" class="btn btn-view btn-sm" data-toggle="modal" data-target="#documentModal" data-document="{{ Storage::url($upload->file_path) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('dokumen.edit', $upload->id) }}" class="btn btn-edit btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-delete btn-sm" onclick="deleteDocument({{ $upload->id }})">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="noResultRow" style="display: none;">
                <p class="text-center">Dokumen tidak ditemukan.</p>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center custom-pagination">
                {{ $uploads->links('pagination::bootstrap-4') }}
            </div>

            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentModalLabel">Document View</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                        <iframe id="documentIframe" src="" width="100%" height="100%" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: '{{ session('error') }}',
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

@section('styles')
    <link rel="stylesheet" href="{{ asset('CSS/custom-pagination.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('javascript/custom-pagination.js') }}"></script>
@endsection
