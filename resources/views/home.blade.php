@extends('layouts.app')

@section('content')
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="hero-content text-center">
                        <h1 class="display-4 animate__animated animate__fadeInUp"><q>Sistem Informasi Arsip Digital Optimalisasi Aset Sub bag Kawasan!</q></h1>
                        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">SiArdi adalah solusi yang dikembangkan khusus untuk Optimalisasi Aset Sub Bagian Kawasan PTPN I Regional 2 dalam mengelola dan menyimpan arsip digital dengan aman dan efisien. Aplikasi ini dirancang untuk memenuhi kebutuhan dalam pengaturan, pencarian, dan akses dokumen serta file penting dengan cepat dan mudah.</p>
                        <a href="{{ url('upload') }}" class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">Mulai Mengarsip</a>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1">
                    <div class="hero-illustration animate__animated animate__fadeInRight animate__delay-1s">
                        <img src="{{ asset('image/logo-arsip.png') }}" alt="logo-arsip" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
