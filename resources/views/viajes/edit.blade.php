@extends('layouts.app')

@section('title', 'Editar Viaje')

@section('content')
    <div class="content-wrapper pb-4">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0"><i class="fas fa-map-marked-alt mr-2"></i>Editar Viaje</h1>
                    <a href="{{ route('viajes.index') }}" class="btn btn-secondary">
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
                                    <i class="fas fa-edit mr-2"></i>Editar Viaje #{{ $viaje->id }}
                                </h3>
                            </div>

                            <form method="POST" action="{{ route('viajes.update', $viaje->id) }}">
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
                                        {{-- Ruta --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="ruta_id">
                                                    <i class="fas fa-route text-primary mr-1"></i>
                                                    Ruta <strong style="color:red;">(*)</strong>
                                                </label>
                                                <select class="form-control @error('ruta_id') is-invalid @enderror"
                                                    name="ruta_id" id="ruta_id" required>
                                                    <option value="">-- Seleccione una ruta --</option>
                                                    @foreach ($rutas as $ruta)
                                                        <option value="{{ $ruta->id }}"
                                                            {{ old('ruta_id', $viaje->ruta_id) == $ruta->id ? 'selected' : '' }}>
                                                            {{ $ruta->nombre_ruta }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('ruta_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Vehículo --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vehiculo_id">
                                                    <i class="fas fa-car text-info mr-1"></i>
                                                    Vehículo <strong style="color:red;">(*)</strong>
                                                </label>
                                                <select class="form-control @error('vehiculo_id') is-invalid @enderror"
                                                    name="vehiculo_id" id="vehiculo_id" required>
                                                    <option value="">-- Seleccione un vehículo --</option>
                                                    @foreach ($vehiculos as $vehiculo)
                                                        <option value="{{ $vehiculo->id }}"
                                                            {{ old('vehiculo_id', $viaje->vehiculo_id) == $vehiculo->id ? 'selected' : '' }}>
                                                            {{ $vehiculo->placa }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('vehiculo_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Conductor --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="conductor_id">
                                                    <i class="fas fa-user-tie text-success mr-1"></i>
                                                    Conductor <strong style="color:red;">(*)</strong>
                                                </label>
                                                <select class="form-control @error('conductor_id') is-invalid @enderror"
                                                    name="conductor_id" id="conductor_id" required>
                                                    <option value="">-- Seleccione un conductor --</option>
                                                    @foreach ($conductores as $conductor)
                                                        <option value="{{ $conductor->id }}"
                                                            {{ old('conductor_id', $viaje->conductor_id) == $conductor->id ? 'selected' : '' }}>
                                                            {{ $conductor->nombre }} {{ $conductor->apellido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('conductor_id')
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
                                                    <i class="fas fa-align-left text-warning mr-1"></i>
                                                    Descripción <strong style="color:red;">(*)</strong>
                                                </label>
                                                <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion"
                                                    rows="3" placeholder="Ej: Viaje de entrega de mercancía" required>{{ old('descripcion', $viaje->descripcion) }}</textarea>
                                                @error('descripcion')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Recorrido --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="recorrido">
                                                    <i class="fas fa-road text-primary mr-1"></i>
                                                    Recorrido (km) <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('recorrido') is-invalid @enderror"
                                                    name="recorrido" id="recorrido" value="{{ old('recorrido', $viaje->recorrido) }}"
                                                    placeholder="Ej: 100" min="0" step="0.01" required>
                                                @error('recorrido')
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
                                                    <i class="fas fa-clock text-info mr-1"></i>
                                                    Tiempo Estimado (hrs) <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('tiempo_estimado') is-invalid @enderror"
                                                    name="tiempo_estimado" id="tiempo_estimado"
                                                    value="{{ old('tiempo_estimado', $viaje->tiempo_estimado) }}" placeholder="Ej: 2.5"
                                                    min="0" step="0.01" required>
                                                @error('tiempo_estimado')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Costo Total --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="costo_total">
                                                    <i class="fas fa-money-bill-wave text-success mr-1"></i>
                                                    Costo Total <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('costo_total') is-invalid @enderror"
                                                    name="costo_total" id="costo_total" value="{{ old('costo_total', $viaje->costo_total) }}"
                                                    placeholder="Ej: 100.50" min="0" step="0.01" required>
                                                @error('costo_total')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Campo oculto --}}
                                    <input type="hidden" name="estado" value="{{ old('estado', $viaje->estado ? 1 : 0) }}">
                                    <input type="hidden" name="registrado_por" value="{{ $viaje->registrado_por }}">

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Los campos marcados con <strong
                                            style="color:red;">(*)</strong> son obligatorios.
                                    </div>
                                </div>

                                <div class="card-footer bg-light">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('viajes.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times mr-1"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-save mr-1"></i> Actualizar Viaje
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
