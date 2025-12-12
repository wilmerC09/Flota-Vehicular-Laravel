@extends('layouts.app')

@section('title', 'Editar Ruta')

@section('content')
    <div class="content-wrapper pb-4" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Editar Ruta</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <a href="{{ route('rutas.index') }}" style="color: #6b7280; text-decoration: none;">Rutas</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Editar</span>
                        </nav>
                    </div>
                    <a href="{{ route('rutas.index') }}" style="background: #6b7280; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
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
                            <div class="card-header" style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 16px 16px 0 0;">
                                <h3 class="mb-0" style="color: #2d3748; font-weight: 600; font-size: 18px;">
                                    <i class="fas fa-route mr-2" style="color: #10b981;"></i>{{ $ruta->nombre_ruta }}
                                </h3>
                            </div>

                            <form method="POST" action="{{ route('rutas.update', $ruta->id) }}">
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
                                        {{-- Nombre de la Ruta --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre_ruta">
                                                    <i class="fas fa-map-signs text-primary mr-1"></i>
                                                    Nombre de la Ruta <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('nombre_ruta') is-invalid @enderror"
                                                    name="nombre_ruta" id="nombre_ruta"
                                                    value="{{ old('nombre_ruta', $ruta->nombre_ruta) }}"
                                                    placeholder="Ej: Ruta del Sol" required>
                                                @error('nombre_ruta')
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
                                                    placeholder="Ej: Ruta que conecta la ciudad A con la ciudad B"
                                                    required>{{ old('descripcion', $ruta->descripcion) }}</textarea>
                                                @error('descripcion')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Distancia en KM --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="distancia_en_km">
                                                    <i class="fas fa-road text-warning mr-1"></i>
                                                    Distancia (KM) <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('distancia_en_km') is-invalid @enderror"
                                                    name="distancia_en_km" id="distancia_en_km"
                                                    value="{{ old('distancia_en_km', $ruta->distancia_en_km) }}"
                                                    placeholder="Ej: 100" min="0" step="0.01" required>
                                                @error('distancia_en_km')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Tiempo Estimado --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tiempo_estimado">
                                                    <i class="fas fa-clock text-success mr-1"></i>
                                                    Tiempo Estimado (hrs) <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('tiempo_estimado') is-invalid @enderror"
                                                    name="tiempo_estimado" id="tiempo_estimado"
                                                    value="{{ old('tiempo_estimado', $ruta->tiempo_estimado) }}"
                                                    placeholder="Ej: 2.5" min="0" step="0.01" required>
                                                @error('tiempo_estimado')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Costo de Peaje --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="costo_peaje">
                                                    <i class="fas fa-dollar-sign text-danger mr-1"></i>
                                                    Costo de Peaje <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('costo_peaje') is-invalid @enderror"
                                                    name="costo_peaje" id="costo_peaje"
                                                    value="{{ old('costo_peaje', $ruta->costo_peaje) }}"
                                                    placeholder="Ej: 10.50" min="0" step="0.01" required>
                                                @error('costo_peaje')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Precio --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="precio">
                                                    <i class="fas fa-money-bill-wave text-success mr-1"></i>
                                                    Precio de Ruta (COP)
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('precio') is-invalid @enderror"
                                                    name="precio" id="precio" value="{{ old('precio', $ruta->precio) }}"
                                                    placeholder="Ej: 250000 (sin comas)" min="0" step="0.01">
                                                @error('precio')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Campo oculto --}}
                                    <input type="hidden" name="estado" value="{{ old('estado', $ruta->estado ? 1 : 0) }}">
                                    <input type="hidden" name="registrado_por" value="{{ $ruta->registrado_por }}">

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Los campos marcados con <strong
                                            style="color:red;">(*)</strong> son obligatorios.
                                    </div>
                                </div>

                                <div class="card-footer" style="background: #f9fafb; border-top: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 0 0 16px 16px;">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('rutas.index') }}" style="background: #6b7280; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none;">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
                                        <button type="submit" style="background: #10b981; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer;">
                                            <i class="fas fa-save"></i> Actualizar Ruta
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