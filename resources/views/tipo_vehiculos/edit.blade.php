@extends('layouts.app')

@section('title', 'Editar Tipo de Vehículo')

@section('content')
    <div class="content-wrapper pb-4">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0"><i class="fas fa-truck mr-2"></i>Editar Tipo de Vehículo</h1>
                    <a href="{{ route('tipo_vehiculos.index') }}" class="btn btn-secondary">
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
                                    <i class="fas fa-edit mr-2"></i>Editar Tipo de Vehículo - {{ $tipo_vehiculo->nombre }}
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
                                                    class="form-control @error('nombre') is-invalid @enderror"
                                                    name="nombre" id="nombre" value="{{ old('nombre', $tipo_vehiculo->nombre) }}"
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
                                                <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion"
                                                    rows="3" placeholder="Ej: Vehículo de 4 puertas" required>{{ old('descripcion', $tipo_vehiculo->descripcion) }}</textarea>
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
                                                    value="{{ old('capacidad_pasajero', $tipo_vehiculo->capacidad_pasajero) }}" placeholder="Ej: 5"
                                                    min="1" required>
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
                                                    value="{{ old('capacidad_carga', $tipo_vehiculo->capacidad_carga) }}" placeholder="Ej: 500"
                                                    min="0" required>
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
                                                    value="{{ old('capacidad_gasolina', $tipo_vehiculo->capacidad_gasolina) }}" placeholder="Ej: 50"
                                                    min="0" required>
                                                @error('capacidad_gasolina')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Campo oculto --}}
                                    <input type="hidden" name="estado" value="{{ old('estado', $tipo_vehiculo->estado ? 1 : 0) }}">
                                    <input type="hidden" name="registrado_por" value="{{ $tipo_vehiculo->registrado_por }}">

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Los campos marcados con <strong
                                            style="color:red;">(*)</strong> son obligatorios.
                                    </div>
                                </div>

                                <div class="card-footer bg-light">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('tipo_vehiculos.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times mr-1"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-save mr-1"></i> Actualizar Tipo de Vehículo
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
