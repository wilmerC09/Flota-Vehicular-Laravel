@extends('layouts.applogin')

@section('title', 'Register')

@push('styles')
  <style>
    .login-page {
      background: #f8f9fa;
      height: 100vh;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-container {
      background: white;
      border-radius: 16px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 1000px;
      width: 100%;
      display: flex;
      min-height: 600px;
      max-height: 85vh;
    }

    .login-left {
      flex: 1;
      background-image: url('{{ asset('backend/dist/img/city bus.png') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
      min-width: 450px;
    }

    .login-left::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(31, 41, 55, 0.1) 100%);
    }

    .login-right {
      flex: 1;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: white;
      min-width: 400px;
      overflow: hidden;
    }

    .welcome-text {
      text-align: center;
      margin-bottom: 1rem;
    }

    .welcome-text h4 {
      color: #1f2937;
      margin-bottom: 0.3rem;
      font-weight: 700;
      font-size: 1.4rem;
    }

    .welcome-text p {
      color: #6b7280;
      margin: 0;
      font-size: 0.85rem;
    }

    .form-group {
      margin-bottom: 0.75rem;
      position: relative;
    }

    .form-control {
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      padding: 0.7rem 0.9rem 0.7rem 2.8rem;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      height: auto;
      color: #1f2937;
    }

    .form-control:focus {
      border-color: #10b981;
      box-shadow: 0 0 0 0.15rem rgba(16, 185, 129, 0.15);
      outline: none;
    }

    .input-icon {
      position: absolute;
      left: 0.9rem;
      top: 50%;
      transform: translateY(-50%);
      color: #6b7280;
      z-index: 3;
      font-size: 0.95rem;
    }

    .btn-login {
      background: #10b981;
      border: none;
      border-radius: 8px;
      padding: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      font-size: 0.95rem;
      color: white;
    }

    .btn-login:hover {
      background: #059669;
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
      color: white;
    }

    .terms-checkbox {
      display: flex;
      align-items: flex-start;
      margin-bottom: 0.9rem;
      font-size: 0.82rem;
    }

    .form-check {
      display: flex;
      align-items: flex-start;
    }

    .form-check-input {
      border-color: #d1d5db;
      cursor: pointer;
      margin-top: 0.2rem;
      flex-shrink: 0;
    }

    .form-check-input:checked {
      background-color: #10b981;
      border-color: #10b981;
    }

    .form-check-label {
      color: #6b7280;
      cursor: pointer;
      user-select: none;
      line-height: 1.4;
      word-wrap: break-word;
      overflow-wrap: break-word;
    }

    .form-check-label a {
      color: #10b981;
      text-decoration: none;
      white-space: nowrap;
    }

    .form-check-label a:hover {
      color: #059669;
      text-decoration: underline;
    }

    .social-login {
      margin: 1rem 0 0 0;
    }

    .divider {
      position: relative;
      text-align: center;
      margin: 1rem 0 0.9rem 0;
    }

    .divider:before {
      content: '';
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      height: 1px;
      background: #e5e7eb;
    }

    .divider span {
      background: white;
      padding: 0 1rem;
      color: #6b7280;
      font-size: 0.85rem;
      position: relative;
    }

    .btn-google-modern {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      padding: 0.7rem 1rem;
      background: white;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      color: #1f2937;
      font-weight: 500;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      text-decoration: none;
      gap: 0.8rem;
    }

    .btn-google-modern:hover {
      background: #f9fafb;
      border-color: #d1d5db;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      transform: translateY(-1px);
      color: #1f2937;
      text-decoration: none;
    }

    .google-logo {
      width: 20px;
      height: 20px;
    }

    .login-footer {
      text-align: center;
      padding-top: 0.8rem;
      margin-top: 0.8rem;
      border-top: 1px solid #e5e7eb;
      font-size: 0.9rem;
    }

    .login-footer a {
      color: #10b981;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .login-footer a:hover {
      color: #059669;
      text-decoration: none;
    }

    .login-footer p {
      margin-bottom: 0.5rem;
      color: #6b7280;
    }

    .invalid-feedback {
      display: block;
      font-size: 0.8rem;
      margin-top: 0.3rem;
      color: #ef4444;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
      .login-left {
        min-width: 350px;
      }

      .login-right {
        min-width: 350px;
        padding: 2rem;
      }
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        max-width: 450px;
        min-height: auto;
        max-height: 95vh;
      }

      .login-left {
        flex: none;
        height: 200px;
        min-width: auto;
      }

      .login-right {
        padding: 2rem 1.5rem;
        min-width: auto;
      }

      .welcome-text h4 {
        font-size: 1.5rem;
      }

      .welcome-text {
        margin-bottom: 1.2rem;
      }

      .form-group {
        margin-bottom: 0.8rem;
      }
    }

    @media (max-width: 480px) {
      .login-page {
        padding: 10px;
      }

      .login-container {
        border-radius: 12px;
        max-height: 98vh;
      }

      .login-left {
        height: 150px;
      }

      .login-right {
        padding: 1.5rem 1rem;
      }

      .form-group {
        margin-bottom: 0.8rem;
      }

      .welcome-text h4 {
        font-size: 1.3rem;
      }
    }
  </style>
@endpush

@section('content')

  <body class="login-page">
    <div class="login-container">
      <div class="login-left"></div>

      <div class="login-right">
        <div class="welcome-text">
          <h4>¡Únete a nosotros!</h4>
          <p>Crea tu cuenta para comenzar</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="form-group">
            <i class="fas fa-user input-icon"></i>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
              placeholder="Nombre completo" value="{{ old('name') }}" required autofocus>
            @error('name')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <i class="fas fa-envelope input-icon"></i>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
              placeholder="Correo electrónico" value="{{ old('email') }}" required>
            @error('email')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
              placeholder="Contraseña" required>
            @error('password')
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña"
              required>
          </div>

          <div class="terms-checkbox d-flex align-items-start">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="terms" id="terms" value="agree" required>
              <label class="form-check-label ms-2" for="terms">
                Acepto los <a href="#">términos y condiciones</a> y la <a href="#">política de privacidad</a>
              </label>
            </div>
          </div>

          <button type="submit" class="btn btn-login btn-block w-100">
            <i class="fas fa-user-plus me-2"></i>Crear Cuenta
          </button>
        </form>

        <div class="social-login">
          <div class="divider">
            <span>O continúa con</span>
          </div>

          <a href="#" class="btn-google-modern">
            <svg class="google-logo" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                fill="#4285F4" />
              <path
                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                fill="#34A853" />
              <path
                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                fill="#FBBC05" />
              <path
                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                fill="#EA4335" />
            </svg>
            Continuar con Google
          </a>
        </div>

        <div class="login-footer">
          <p>
            <a href="{{ route('login') }}">
              <i class="fas fa-sign-in-alt me-1"></i>¿Ya tienes una cuenta? Inicia sesión
            </a>
          </p>
        </div>
      </div>
    </div>
  </body>
@endsection