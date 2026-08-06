<style>
    /* Custom Navbar Styling - Dark Glassmorphism Premium */
    .navbar-custom {
        background: rgba(15, 23, 42, 0.85) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 0.8rem 1.5rem;
    }

    .navbar-custom .navbar-brand {
        color: #ffffff !important;
        font-weight: 800;
        font-size: 1.25rem;
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .navbar-custom .brand-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        border-radius: 0.625rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.1rem;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .navbar-custom .nav-link {
        color: #94a3b8 !important;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.5rem 1rem !important;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .navbar-custom .nav-link:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.05);
    }

    .navbar-custom .nav-link.active {
        color: #818cf8 !important;
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.25);
    }

    /* Profile / User Dropdown Pill */
    .navbar-custom .user-pill {
        background: rgba(30, 41, 59, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.35rem 0.85rem;
        border-radius: 50rem;
        color: #f8fafc;
        transition: all 0.2s ease;
    }

    .navbar-custom .user-pill:hover {
        border-color: rgba(99, 102, 241, 0.4);
        background: rgba(30, 41, 59, 1);
    }

    .navbar-custom .avatar-circle {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #6366f1;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .navbar-custom .dropdown-menu {
        background-color: #1e293b !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
        margin-top: 0.5rem;
    }

    .navbar-custom .dropdown-item {
        color: #cbd5e1 !important;
        font-weight: 500;
        font-size: 0.875rem;
        padding: 0.6rem 1.2rem;
        border-radius: 0.5rem;
    }

    .navbar-custom .dropdown-item:hover {
        background-color: rgba(99, 102, 241, 0.15) !important;
        color: #818cf8 !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        {{-- LOGO --}}
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            <div class="brand-icon">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <span>POS<span style="color: #818cf8;"></span></span>
        </a>

        {{-- TOGGLER UNTUK MOBILE --}}
        <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent">
            <i class="bi bi-list fs-2"></i>
        </button>

        {{-- MENU NAVIGATION --}}
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
    <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">
        <i class="bi bi-people-fill me-1"></i> Users
    </a>
</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" href="{{ url('/produk') }}">
                        <i class="bi bi-box-fill"></i> Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('penjualan*') ? 'active' : '' }}"
                        href="{{ url('/penjualan') }}">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i> penjualan
                    </a>
                </li>
            </ul>

            {{-- USER DROPDOWN (Kiri/Kanan) --}}
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                <div class="dropdown">
                    <button class="btn user-pill d-flex align-items-center gap-2 dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar-circle">
                            {{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}
                        </div>
                        <span class="fw-semibold small text-white">{{ Auth::user()->name ?? 'kuda' }}</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end p-2">
                        @if (Route::has('profile.edit'))
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2"
                                    href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-1"></i> Profil
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-secondary opacity-25">
                            </li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="dropdown-item text-danger d-flex align-items-center gap-2 w-100 border-0 bg-transparent text-start">
                                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
