@extends('layouts.applogin')

@section('title', 'Restablecer Contraseña')

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
  
  .reset-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    display: flex;
    max-width: 1000px;
    width: 90%;
    overflow: hidden;
    min-height: 600px;
  }
  
  .reset-left {
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
  
  .reset-right {
    flex: 1;
    padding: 60px 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  
  .reset-title {
    font-size: 32px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 12px;
    line-height: 1.2;
  }
  
  .reset-subtitle {
    color: #6b7280;
    font-size: 15px;
    margin-bottom: 35px;
    line-height: 1.5;
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
  
  .btn-reset {
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
  
  .btn-reset:hover {
    background: #059669;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
  }
  
  .btn-reset:active {
    transform: translateY(0);
  }
  
  .invalid-feedback {
    color: #ef4444;
    font-size: 13px;
    margin-top: 6px;
    display: block;
    font-weight: 500;
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
    .reset-card {
      max-width: 800px;
    }
    
    .reset-left,
    .reset-right {
      padding: 50px 35px;
    }
  }
  
  @media (max-width: 768px) {
    .reset-card {
      flex-direction: column;
      margin: 20px;
      min-height: auto;
      max-width: 500px;
    }
    
    .reset-left {
      padding: 40px 30px;
      min-height: 250px;
    }
    
    .illustration-container img {
      max-width: 250px;
    }
    
    .reset-title {
      font-size: 26px;
    }
    
    .reset-subtitle {
      font-size: 14px;
      margin-bottom: 25px;
    }
    
    .reset-right {
      padding: 40px 30px;
    }
  }
  
  @media (max-width: 480px) {
    .reset-card {
      margin: 10px;
    }
    
    .reset-left {
      padding: 30px 20px;
      min-height: 200px;
    }
    
    .illustration-container img {
      max-width: 200px;
    }
    
    .reset-right {
      padding: 30px 20px;
    }
    
    .reset-title {
      font-size: 24px;
    }
  }
</style>

<div class="reset-card">
  <div class="reset-left">
    <div class="illustration-container">
      <img src="https://wwwp.ugc.edu.co/sede/bogota/pages/restablecer/app/imagenes/restablecer.png" alt="Restablecer contraseña">
    </div>
  </div>
  
  <div class="reset-right">
    <h2 class="reset-title">Restablecer Contraseña</h2>
    <p class="reset-subtitle">
      Ingresa tu nueva contraseña para recuperar el acceso a tu cuenta.
    </p>

    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

      <div class="form-group">
        <label for="email" class="form-label">Correo electrónico</label>
        <input id="email" 
               type="email" 
               class="form-control @error('email') is-invalid @enderror" 
               name="email" 
               value="{{ $email ?? old('email') }}" 
               placeholder="tu@ejemplo.com" 
               required 
               autocomplete="email" 
               autofocus>
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Nueva contraseña</label>
        <input id="password" 
               type="password" 
               class="form-control @error('password') is-invalid @enderror" 
               name="password" 
               placeholder="Mínimo 8 caracteres" 
               required 
               autocomplete="new-password">
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password-confirm" class="form-label">Confirmar contraseña</label>
        <input id="password-confirm" 
               type="password" 
               class="form-control" 
               name="password_confirmation" 
               placeholder="Repite tu contraseña" 
               required 
               autocomplete="new-password">
      </div>

      <button type="submit" class="btn-reset">
        <i class="fas fa-key me-2"></i>Cambiar contraseña
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