<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-0" style="background: #ffffff; border-right: 1px solid #e5e7eb;">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link-modern text-center">
        <div class="brand-logo-circle">
            <img src="{{ asset('backend/dist/img/escudo.png')}}" alt="Logo">
        </div>
        <span class="brand-text-modern">Mobi UFPSO</span>
        <small class="brand-subtitle">Sistema de Flota</small>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="sidebar-search-wrapper">
            <div class="input-group">
                <span class="search-icon">
                    <i class="fas fa-search"></i>
                </span>
                <input class="form-control search-input" type="search" placeholder="Search" aria-label="Search">
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{route('home')}}"
                        class="nav-link-clean {{ Request::is('home') || Request::is('/') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- GESTIÓN PRINCIPAL -->
                <li class="nav-header-clean">GESTIÓN PRINCIPAL</li>

                <!-- Conductores -->
                <li class="nav-item">
                    <a href="{{route('conductores.index')}}"
                        class="nav-link-clean {{ Request::is('conductores*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-user-tie"></i>
                        <span>Conductores</span>
                    </a>
                </li>

                <!-- Contratos -->
                <li class="nav-item">
                    <a href="{{route('contratos.index')}}"
                        class="nav-link-clean {{ Request::is('contratos*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-file-contract"></i>
                        <span>Contratos</span>
                    </a>
                </li>

                <!-- Empresas -->
                <li class="nav-item">
                    <a href="{{route('empresas.index')}}"
                        class="nav-link-clean {{ Request::is('empresas*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-building"></i>
                        <span>Empresas</span>
                    </a>
                </li>

                <!-- Licencias -->
                <li class="nav-item">
                    <a href="{{route('licencias.index')}}"
                        class="nav-link-clean {{ Request::is('licencias*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-id-card"></i>
                        <span>Licencias</span>
                    </a>
                </li>

                <!-- VEHÍCULOS -->
                <li class="nav-header-clean">VEHÍCULOS</li>

                <!-- Marcas -->
                <li class="nav-item">
                    <a href="{{route('marcas.index')}}"
                        class="nav-link-clean {{ Request::is('marcas*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-tag"></i>
                        <span>Marcas</span>
                    </a>
                </li>

                <!-- Tipo Vehículos -->
                <li class="nav-item">
                    <a href="{{route('tipo_vehiculos.index')}}"
                        class="nav-link-clean {{ Request::is('tipo_vehiculos*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-list-alt"></i>
                        <span>Tipo Vehículos</span>
                    </a>
                </li>

                <!-- Vehículos -->
                <li class="nav-item">
                    <a href="{{route('vehiculos.index')}}"
                        class="nav-link-clean {{ Request::is('vehiculos*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-car"></i>
                        <span>Vehículos</span>
                        <span class="badge-new">New</span>
                    </a>
                </li>

                <!-- OPERACIONES -->
                <li class="nav-header-clean">OPERACIONES</li>

                <!-- Combustible -->
                <li class="nav-item">
                    <a href="{{route('recarga_combustibles.index')}}"
                        class="nav-link-clean {{ Request::is('recarga_combustibles*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-gas-pump"></i>
                        <span>Combustible</span>
                    </a>
                </li>

                <!-- Rutas -->
                <li class="nav-item">
                    <a href="{{route('rutas.index')}}"
                        class="nav-link-clean {{ Request::is('rutas*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-route"></i>
                        <span>Rutas</span>
                    </a>
                </li>

                <!-- Viajes -->
                <li class="nav-item">
                    <a href="{{route('viajes.index')}}"
                        class="nav-link-clean {{ Request::is('viajes*') ? 'active' : '' }}">
                        <i class="nav-icon-clean fas fa-map-marked-alt"></i>
                        <span>Viajes</span>
                    </a>
                </li>

                <!-- CONFIGURACIÓN -->
                <li class="nav-header-clean">CONFIGURACIÓN</li>

                <!-- Settings -->
                <li class="nav-item">
                    <a href="#" class="nav-link-clean">
                        <i class="nav-icon-clean fas fa-cog"></i>
                        <span>Settings</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </a>
                </li>

                <!-- Spacer -->
                <li style="height: 2rem;"></li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Modern Clean Sidebar Styles -->
<style>
    /* Sidebar Main */
    .main-sidebar {
        transition: all 0.3s ease;
    }

    /* Brand Link Modern */
    .brand-link-modern {
        display: block;
        padding: 1.5rem 1rem;
        text-decoration: none;
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.2s ease;
    }

    .brand-link-modern:hover {
        background: #f9fafb;
    }

    .brand-logo-circle {
        width: 48px;
        height: 48px;
        margin: 0 auto 10px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .brand-logo-circle img {
        width: 30px;
        height: 30px;
        border-radius: 8px;
    }

    .brand-text-modern {
        display: block;
        font-weight: 700;
        font-size: 1rem;
        color: #1f2937;
        margin-bottom: 2px;
    }

    .brand-subtitle {
        display: block;
        font-size: 0.75rem;
        color: #9ca3af;
    }

    /* Search Wrapper */
    .sidebar-search-wrapper {
        padding: 1rem 1rem 0.5rem;
    }

    .sidebar-search-wrapper .input-group {
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        z-index: 10;
        font-size: 14px;
    }

    .search-input {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        font-size: 14px;
        color: #6b7280;
        transition: all 0.2s ease;
    }

    .search-input::placeholder {
        color: #9ca3af;
    }

    .search-input:focus {
        background: #ffffff;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        outline: none;
    }

    /* Nav Headers */
    .nav-header-clean {
        padding: 1rem 1rem 0.5rem;
        font-size: 11px;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 0.5rem;
    }

    /* Nav Items */
    .nav-sidebar .nav-item {
        margin-bottom: 2px;
    }

    /* Nav Links Clean */
    .nav-link-clean {
        display: flex;
        align-items: center;
        padding: 0.65rem 1rem;
        color: #4b5563;
        font-size: 14px;
        font-weight: 500;
        border-radius: 8px;
        margin: 0 0.75rem;
        transition: all 0.2s ease;
        position: relative;
        text-decoration: none;
    }

    .nav-link-clean:hover {
        background: #f3f4f6;
        color: #1f2937;
    }

    .nav-link-clean.active {
        background: #d1fae5;
        color: #047857;
    }

    .nav-link-clean.active .nav-icon-clean {
        color: #10b981;
    }

    /* Nav Icons */
    .nav-icon-clean {
        font-size: 18px;
        width: 20px;
        margin-right: 12px;
        color: #6b7280;
        transition: color 0.2s ease;
    }

    .nav-link-clean:hover .nav-icon-clean {
        color: #374151;
    }

    /* Nav Text */
    .nav-link-clean span {
        flex: 1;
    }

    /* Nav Arrow */
    .nav-arrow {
        font-size: 12px;
        color: #9ca3af;
        margin-left: auto;
    }

    /* Badge New */
    .badge-new {
        background: #10b981;
        color: white;
        font-size: 10px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 12px;
        margin-left: auto;
    }

    /* Scrollbar */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 10px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .brand-text-modern {
            font-size: 0.9rem;
        }

        .nav-link-clean {
            font-size: 13px;
            padding: 0.6rem 0.8rem;
        }
    }
</style>

<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>