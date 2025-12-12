@extends('layouts.app')

@section('title', 'Editar Tipo de Vehículo')

@section('content')
    <div class="content-wrapper pb-4" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Editar Tipo de Vehículo
                        </h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <a href="{{ route('tipo_vehiculos.index') }}"
                                style="color: #6b7280; text-decoration: none;">Tipos de Vehículos</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Editar</span>
                        </nav>
                    </div>
                    <a href="{{ route('tipo_vehiculos.index') }}"
                        style="background: #6b7280; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </section>

        <section class="content" style="padding: 1.5rem 1rem;">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                            <div class="card-header"
                                style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 16px 16px 0 0;">
                                <h3 class="mb-0" style="color: #2d3748; font-weight: 600; font-size: 18px;">
                                    <i class="fas fa-truck mr-2" style="color: #10b981;"></i>{{ $tipo_vehiculo->nombre }}
                                </h3>
                            </div>

                            <form method="POST" action="{{ route('tipo_vehiculos.update', $tipo_vehiculo->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    {{-- Mensajes de error --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <h5><i class="icon fas fa-ban"></i> Por favor corrige los siguientes errores:
                                            </h5>
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="row">
                                        {{-- Nombre --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre">
                                                    <i class="fas fa-tag text-primary mr-1"></i>
                                                    Nombre <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                                    id="nombre" value="{{ old('nombre', $tipo_vehiculo->nombre) }}"
                                                    placeholder="Ej: Sedán" required>
                                                @error('nombre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Descripción --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripcion">
                                                    <i class="fas fa-align-left text-info mr-1"></i>
                                                    Descripción <strong style="color:red;">(*)</strong>
                                                </label>
                                                <textarea class="form-control @error('descripcion') is-invalid @enderror"
                                                    name="descripcion" id="descripcion" rows="3"
                                                    placeholder="Ej: Vehículo de 4 puertas"
                                                    required>{{ old('descripcion', $tipo_vehiculo->descripcion) }}</textarea>
                                                @error('descripcion')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Capacidad de Pasajeros --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="capacidad_pasajero">
                                                    <i class="fas fa-users text-success mr-1"></i>
                                                    Capacidad de Pasajeros <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('capacidad_pasajero') is-invalid @enderror"
                                                    name="capacidad_pasajero" id="capacidad_pasajero"
                                                    value="{{ old('capacidad_pasajero', $tipo_vehiculo->capacidad_pasajero) }}"
                                                    placeholder="Ej: 5" min="1" required>
                                                @error('capacidad_pasajero')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Capacidad de Carga --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="capacidad_carga">
                                                    <i class="fas fa-box text-warning mr-1"></i>
                                                    Capacidad de Carga (kg) <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('capacidad_carga') is-invalid @enderror"
                                                    name="capacidad_carga" id="capacidad_carga"
                                                    value="{{ old('capacidad_carga', $tipo_vehiculo->capacidad_carga) }}"
                                                    placeholder="Ej: 500" min="0" required>
                                                @error('capacidad_carga')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Capacidad de Gasolina --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="capacidad_gasolina">
                                                    <i class="fas fa-gas-pump text-danger mr-1"></i>
                                                    Capacidad de Gasolina (L) <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('capacidad_gasolina') is-invalid @enderror"
                                                    name="capacidad_gasolina" id="capacidad_gasolina"
                                                    value="{{ old('capacidad_gasolina', $tipo_vehiculo->capacidad_gasolina) }}"
                                                    placeholder="Ej: 50" min="0" required>
                                                @error('capacidad_gasolina')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Campo oculto --}}
                                    <input type="hidden" name="estado"
                                        value="{{ old('estado', $tipo_vehiculo->estado ? 1 : 0) }}">
                                    <input type="hidden" name="registrado_por" value="{{ $tipo_vehiculo->registrado_por }}">

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Los campos marcados con <strong
                                            style="color:red;">(*)</strong> son obligatorios.
                                    </div>
                                </div>

                                <div class="card-footer"
                                    style="background: #f9fafb; border-top: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 0 0 16px 16px;">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('tipo_vehiculos.index') }}"
                                            style="background: #6b7280; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none;">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
                                        <button type="submit"
                                            style="background: #10b981; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer;">
                                            <i class="fas fa-save"></i> Actualizar Tipo de Vehículo
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection