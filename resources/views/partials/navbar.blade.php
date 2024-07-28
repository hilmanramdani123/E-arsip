<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('image/ptpn1.jpg') }}" width="50" height="50" class="d-inline-block align-top rounded-circle" alt="Logo PTPN">
            <span class="text-white ml-3">SIARDI</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto navbar-center">
                <li class="nav-item"><a class="nav-link" href="{{ url('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('arsip') }}">Arsip</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('kategori') }}">Kategori</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <!-- Tampilkan nama pemilik akun hanya pada layar yang lebih besar dari md -->
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-none d-md-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user-circle mr-1"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); confirmLogout();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <!-- Tampilkan tombol Logout pada layar yang lebih kecil dari md -->
                    <li class="nav-item d-md-none">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); confirmLogout();">
                            <i class=""></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari halaman!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
