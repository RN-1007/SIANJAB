<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('img/LogoMagetan.png') }}" alt="Logo Kabupaten Magetan"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Kabupaten Magetan</span>
    </a>

    <div class="sidebar">
        <div class="form-inline mt-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    {{-- Cek jika URL adalah root '/' --}}
                    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-header">Data</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Verifikasi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Verif Data Staf</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Veruf Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mahasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        {{-- Cek jika URL adalah 'data-staf' atau yang diawali dengan 'data-staf/' --}}
                        <a href="{{ url('/data-staf') }}"
                            class="nav-link {{ request()->is('data-staf*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Rekap / Data Staf
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/data-user') }}"
                            class="nav-link {{ request()->is('data-user*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Kunci Akses / Data User
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'user')
                    <li class="nav-item">
                        <a href="{{ url('/uraiantugasuser') }}"
                            class="nav-link {{ request()->is('uraiantugasuser*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Uraian Tugas User
                            </p>
                        </a>
                    </li>
                @endif
                {{-- <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Monev
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Fungsional
                        </p>
                    </a>
                </li> --}}

                {{-- Contoh untuk menu dropdown (parent) --}}
                @if (Auth::user()->role == 'admin')
                    <li
                        class="nav-item has-treeview {{ request()->is('skpd*') || request()->is('tusi*') || request()->is('struktur-jabatan*') || request()->is('uraian-tugas-tusi*') || request()->is('user-master*') || request()->is('data-uraian-tugas*') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('skpd*') || request()->is('tusi*') || request()->is('struktur-jabatan*') || request()->is('uraian-tugas-tusi*') || request()->is('user-master*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('skpd') }}"
                                    class="nav-link {{ request()->is('skpd*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data PD</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('struktur-jabatan') }}"
                                    class="nav-link {{ request()->is('struktur-jabatan*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Struktur Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user-master') }}"
                                    class="nav-link {{ request()->is('user-master*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data User</p>
                                </a>
                            </li>
                             <li class="nav-item">
                                <a href="{{ route('data-uraian-tugas') }}"
                                    class="nav-link {{ request()->is('data-uraian-tugas*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Uraian Tugas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('uraian-tugas-tusi') }}"
                                    class="nav-link {{ request()->is('uraian-tugas-tusi*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Setting User & Tusi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tusi') }}"
                                    class="nav-link {{ request()->is('tusi*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Tusi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>