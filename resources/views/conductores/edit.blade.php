@extends('layouts.app')

@section('title', 'Editar Conductor')

@section('content')
    <div class="content-wrapper pb-4" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Editar Conductor</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <a href="{{ route('conductores.index') }}"
                                style="color: #6b7280; text-decoration: none;">Conductores</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Editar</span>
                        </nav>
                    </div>
                    <a href="{{ route('conductores.index') }}"
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
                                    <i class="fas fa-user-edit mr-2" style="color: #10b981;"></i>{{ $conductor->nombre }}
                                    {{ $conductor->apellido }}
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
                                                    class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                                    id="nombre" value="{{ old('nombre', $conductor->nombre) }}"
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
                                                    name="apellido" id="apellido"
                                                    value="{{ old('apellido', $conductor->apellido) }}"
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
                                                    name="documento" id="documento"
                                                    value="{{ old('documento', $conductor->documento) }}"
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