@extends('layouts.app')

@section('title', 'Editar Conductor')

@section('content')
    <div class="content-wrapper pb-4">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0"><i class="fas fa-user-edit mr-2"></i>Editar Conductor</h1>
                    <a href="{{ route('conductores.index') }}" class="btn btn-secondary">
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
                                    <i class="fas fa-edit mr-2"></i>Editar Conductor - {{ $conductor->nombre }} {{ $conductor->apellido }}
                                </h3>
                            </div>

                            <form method="POST" action="{{ route('conductores.update', $conductor->id) }}">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">
                                                    <i class="fas fa-user text-primary mr-1"></i>
                                                    Nombre <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('nombre') is-invalid @enderror"
                                                    name="nombre" id="nombre" value="{{ old('nombre', $conductor->nombre) }}"
                                                    placeholder="Ej: Juan" required>
                                                @error('nombre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Apellido --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellido">
                                                    <i class="fas fa-user-tag text-info mr-1"></i>
                                                    Apellido <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('apellido') is-invalid @enderror"
                                                    name="apellido" id="apellido" value="{{ old('apellido', $conductor->apellido) }}"
                                                    placeholder="Ej: Pérez" required>
                                                @error('apellido')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Documento --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="documento">
                                                    <i class="fas fa-id-card text-warning mr-1"></i>
                                                    Documento <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('documento') is-invalid @enderror"
                                                    name="documento" id="documento" value="{{ old('documento', $conductor->documento) }}"
                                                    placeholder="Número de documento" required>
                                                @error('documento')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Fecha de contrato --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_contrato">
                                                    <i class="fas fa-calendar text-success mr-1"></i>
                                                    Fecha de Contrato
                                                </label>
                                                <input type="date"
                                                    class="form-control @error('fecha_contrato') is-invalid @enderror"
                                                    name="fecha_contrato" id="fecha_contrato"
                                                    value="{{ old('fecha_contrato', $conductor->fecha_contrato) }}">
                                                @error('fecha_contrato')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Campos ocultos --}}
                                    <input type="hidden" name="estado" value="{{ old('estado', $conductor->estado) }}">
                                    <input type="hidden" name="registrado_por" value="{{ $conductor->registrado_por }}">

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Los campos marcados con <strong
                                            style="color:red;">(*)</strong> son obligatorios.
                                    </div>
                                </div>

                                <div class="card-footer bg-light">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('conductores.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times mr-1"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-save mr-1"></i> Actualizar Conductor
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
