@extends('layouts.applogin')

@section('title', '¿Olvidaste tu contraseña?')

@section('content')
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
      background: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .forgot-card {
      background: white;
      border-radius: 16px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
      display: flex;
      max-width: 1000px;
      width: 90%;
      overflow: hidden;
      min-height: 600px;
    }

    .forgot-left {
      flex: 1;
      background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 60px 40px;
      position: relative;
    }

    .illustration-container {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .illustration-container img {
      width: 100%;
      max-width: 350px;
      height: auto;
      object-fit: contain;
      z-index: 2;
      position: relative;
    }

    .forgot-right {
      flex: 1;
      padding: 60px 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .forgot-title {
      font-size: 32px;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 12px;
      line-height: 1.2;
    }

    .forgot-subtitle {
      color: #6b7280;
      font-size: 15px;
      margin-bottom: 35px;
      line-height: 1.6;
      font-weight: 400;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #374151;
      margin-bottom: 8px;
    }

    .form-control {
      width: 100%;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      padding: 12px 16px;
      font-size: 15px;
      transition: all 0.3s ease;
      background: #f9fafb;
      box-sizing: border-box;
      color: #1f2937;
    }

    .form-control:focus {
      border-color: #10b981;
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
      background: white;
      outline: none;
    }

    .form-control::placeholder {
      color: #9ca3af;
      font-size: 15px;
    }

    .form-control.is-invalid {
      border-color: #ef4444;
      background: #fef2f2;
    }

    .btn-send {
      background: #10b981;
      border: none;
      border-radius: 8px;
      padding: 14px 24px;
      font-size: 15px;
      font-weight: 600;
      color: white;
      transition: all 0.3s ease;
      cursor: pointer;
      width: 100%;
      margin-top: 10px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .btn-send:hover {
      background: #059669;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    }

    .btn-send:active {
      transform: translateY(0);
    }

    .invalid-feedback {
      color: #ef4444;
      font-size: 13px;
      margin-top: 6px;
      display: block;
      font-weight: 500;
    }

    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-success {
      background: #d1fae5;
      border: 1px solid #10b981;
      color: #047857;
    }

    .login-link {
      text-align: center;
      margin-top: 25px;
      padding-top: 20px;
      border-top: 1px solid #e5e7eb;
    }

    .login-link a {
      color: #10b981;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: color 0.3s ease;
    }

    .login-link a:hover {
      color: #059669;
      text-decoration: underline;
    }

    .login-link a i {
      margin-right: 6px;
    }

    @media (max-width: 992px) {
      .forgot-card {
        max-width: 800px;
      }

      .forgot-left,
      .forgot-right {
        padding: 50px 35px;
      }
    }

    @media (max-width: 768px) {
      .forgot-card {
        flex-direction: column;
        margin: 20px;
        min-height: auto;
        max-width: 500px;
      }

      .forgot-left {
        padding: 40px 30px;
        min-height: 250px;
      }

      .illustration-container img {
        max-width: 250px;
      }

      .forgot-title {
        font-size: 26px;
      }

      .forgot-subtitle {
        font-size: 14px;
        margin-bottom: 25px;
      }

      .forgot-right {
        padding: 40px 30px;
      }
    }

    @media (max-width: 480px) {
      .forgot-card {
        margin: 10px;
      }

      .forgot-left {
        padding: 30px 20px;
        min-height: 200px;
      }

      .illustration-container img {
        max-width: 200px;
      }

      .forgot-right {
        padding: 30px 20px;
      }

      .forgot-title {
        font-size: 24px;
      }
    }
  </style>

  <div class="forgot-card">
    <div class="forgot-left">
      <div class="illustration-container">
        <img src="https://wwwp.ugc.edu.co/sede/bogota/pages/restablecer/app/imagenes/restablecer.png"
          alt="Recuperar contraseña">
      </div>
    </div>

    <div class="forgot-right">
      <h2 class="forgot-title">¿Olvidaste tu contraseña?</h2>
      <p class="forgot-subtitle">
        No te preocupes, ingresa tu correo electrónico y te enviaremos un enlace para recuperar tu contraseña.
      </p>

      @if (session('status'))
        <div class="alert alert-success" role="alert">
          <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
          <label for="email" class="form-label">Correo electrónico</label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" placeholder="tu@ejemplo.com" required autocomplete="email" autofocus>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <button type="submit" class="btn-send">
          <i class="fas fa-paper-plane me-2"></i>Enviar enlace de recuperación
        </button>
      </form>

      <div class="login-link">
        <a href="{{ route('login') }}">
          <i class="fas fa-arrow-left"></i>Volver al inicio de sesión
        </a>
      </div>

    </div>
  </div>
@endsection