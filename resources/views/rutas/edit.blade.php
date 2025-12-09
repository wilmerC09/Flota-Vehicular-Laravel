@extends('layouts.app')

@section('title', 'Editar Ruta')

@section('content')
    <div class="content-wrapper pb-4">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0"><i class="fas fa-route mr-2"></i>Editar Ruta</h1>
                    <a href="{{ route('rutas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-info text-white">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-edit mr-2"></i>Editar Ruta - {{ $ruta->nombre_ruta }}
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
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
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

                                <div class="card-footer bg-light">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('rutas.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times mr-1"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-save mr-1"></i> Actualizar Ruta
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