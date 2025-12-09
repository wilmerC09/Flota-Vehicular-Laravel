<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-1">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Barra de búsqueda rápida mejorada -->
        <li class="nav-item d-none d-md-block">
            <form class="form-inline" action="#" method="GET">
                <div class="input-group input-group-sm modern-search">
                    <input class="form-control form-control-navbar" type="search" name="search"
                        placeholder="Buscar vehículos, conductores..." aria-label="Buscar">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </li>

        <!-- Notificaciones dinámicas -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" title="Notificaciones">
                <i class="far fa-bell" style="font-size: 1.2rem;"></i>
                @php
                    $notificaciones = $licenciasPorVencer ?? collect();
                    $totalNotificaciones = $notificaciones->count();
                @endphp
                @if ($totalNotificaciones > 0)
                    <span class="badge badge-danger navbar-badge animated-badge">{{ $totalNotificaciones }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right modern-dropdown">
                <span class="dropdown-item dropdown-header"
                    style="background: #667eea; color: white; font-weight: 600;">
                    <i class="fas fa-bell mr-1"></i> {{ $totalNotificaciones }} Notificaciones
                </span>
                <div class="dropdown-divider"></div>

                @forelse($notificaciones as $licencia)
                    <a href="{{ route('licencias.index') }}" class="dropdown-item notification-item">
                        <i class="fas fa-exclamation-circle text-warning mr-2"></i>
                        Licencia <strong>{{ $licencia->numero_licencia }}</strong> vence pronto
                        <span class="float-right text-muted text-sm">
                            {{ \Carbon\Carbon::parse($licencia->fecha_vencimiento)->diffForHumans() }}
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                @empty
                    <div class="dropdown-item text-center text-muted py-3">
                        <i class="fas fa-check-circle text-success mr-2"></i>
                        No hay notificaciones pendientes
                    </div>
                @endforelse

                <a href="{{ route('licencias.index') }}" class="dropdown-item dropdown-footer"
                    style="background: #f8f9fa; font-weight: 500;">
                    Ver todas las licencias
                </a>
            </div>
        </li>

        <!-- Dropdown de perfil de usuario mejorado -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                <div class="user-avatar-icon"
                    style="width: 36px; height: 36px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-user" style="color: white; font-size: 16px;"></i>
                </div>
                <span class="d-none d-md-inline ml-2"
                    style="font-weight: 500; color: #2d3748;">{{ Auth::user()->name ?? 'Usuario' }}</span>
                <i class="fas fa-chevron-down ml-2" style="font-size: 0.8rem; color: #6b7280;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right modern-dropdown">
                <!-- User header -->
                <li class="user-header-modern" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <div class="user-avatar-large"
                        style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; border: 3px solid rgba(255, 255, 255, 0.4);">
                        <i class="fas fa-user" style="color: white; font-size: 32px;"></i>
                    </div>
                    <p class="mb-1" style="color: white; font-weight: 600; font-size: 17px;">
                        {{ Auth::user()->name ?? 'Usuario Invitado' }}
                    </p>
                    <small class="text-white" style="opacity: 0.9;">{{ Auth::user()->email ?? 'usuario@ejemplo.com'
                        }}</small>
                    @auth
                        <small class="d-block mt-1 text-white" style="opacity: 0.8;">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Miembro desde {{ Auth::user()->created_at?->format('M Y') }}
                        </small>
                    @endauth
                </li>

                <!-- Menu Body -->
                <li class="user-body-modern">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-sm btn-block mb-2"
                                style="background: #d1fae5; color: #047857; border: 1px solid #10b981; font-weight: 500;">
                                <i class="fas fa-user mr-2"></i>Mi Perfil
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="#" class="btn btn-outline-secondary btn-sm btn-block">
                                <i class="fas fa-cog mr-2"></i>Configuración
                            </a>
                        </div>
                    </div>
                </li>

                <!-- Menu Footer -->
                <li class="user-footer-modern">
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm btn-block"
                        onclick="event.preventDefault(); if(confirm('¿Estás seguro de cerrar sesión?')) { document.getElementById('logout-form').submit(); }">
                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Estilos mejorados para el navbar moderno -->
<style>
    /* Navbar principal limpio */
    .main-header.navbar {
        border-bottom: 1px solid #dee2e6;
    }

    /* Links del navbar */
    .navbar-nav .nav-link {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
        border-radius: 6px;
        margin: 0 0.25rem;
    }

    .navbar-nav .nav-link:hover {
        background-color: #f8f9fa;
    }

    /* Imagen/Ícono de usuario mejorado */
    .user-avatar-icon {
        transition: all 0.3s ease;
    }

    .user-avatar-icon:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    /* Dropdown moderno */
    .modern-dropdown {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        border: none;
        overflow: hidden;
        min-width: 300px;
    }

    /* Header del dropdown de usuario */
    .user-header-modern {
        padding: 25px;
        text-align: center;
    }

    .user-avatar-large {
        transition: all 0.3s ease;
    }

    .user-avatar-large:hover {
        background: rgba(255, 255, 255, 0.3) !important;
        transform: scale(1.05);
    }

    /* Body del dropdown */
    .user-body-modern {
        padding: 20px;
        background-color: #f8f9fa;
    }

    /* Footer del dropdown */
    .user-footer-modern {
        padding: 15px;
        background-color: #f8f9fa;
    }

    /* Búsqueda moderna */
    .modern-search .form-control-navbar {
        border-radius: 20px 0 0 20px;
        padding-left: 15px;
        font-size: 14px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .modern-search .form-control-navbar:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }

    .modern-search .btn-navbar {
        border-radius: 0 20px 20px 0;
        padding: 0 15px;
        border: 1px solid #ced4da;
        border-left: none;
        background: white;
        color: #007bff;
        transition: all 0.3s ease;
    }

    .modern-search .btn-navbar:hover {
        background: #007bff;
        color: white;
    }

    /* Badge de notificaciones animado */
    .animated-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 3px 6px;
        position: absolute;
        right: 5px;
        top: 5px;
        animation: pulse-badge 2s infinite;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.4);
    }

    @keyframes pulse-badge {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.15);
        }
    }

    /* Items de notificación */
    .notification-item {
        padding: 12px 15px;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
        border-left-color: #667eea;
        padding-left: 18px;
    }

    /* Botones del dropdown */
    .user-body-modern .btn {
        transition: all 0.3s ease;
    }

    .user-body-modern .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .modern-search {
            display: none !important;
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 0.75rem;
        }

        .user-image-modern {
            margin-right: 0;
        }
    }

    /* Smooth scroll */
    * {
        scroll-behavior: smooth;
    }
</style>