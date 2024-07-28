@extends('layouts.archive')

@section('title', 'Daftar Kategori | E-Arsip')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <span class="header-text">Daftar Kategori</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Jumlah Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTableBody">
                        @foreach($categories as $index => $category)
                            <tr id="kategori-{{ $category->kategori }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->kategori }}</td>
                                <td>{{ $category->total }}</td>
                                <td>
                                    <a href="{{ route('kategori.show', $category->kategori) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="noResultRow" style="display: none;">
                <p class="text-center">Kategori tidak ditemukan.</p>
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
@endsection
