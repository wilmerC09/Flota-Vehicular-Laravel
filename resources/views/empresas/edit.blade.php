@extends('layouts.app')

@section('title', 'Editar Empresa')

@section('content')

    <div class="content-wrapper pb-4" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Editar Empresa</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <a href="{{ route('empresas.index') }}"
                                style="color: #6b7280; text-decoration: none;">Empresas</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Editar</span>
                        </nav>
                    </div>
                    <a href="{{ route('empresas.index') }}"
                        style="background: #6b7280; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </section>

        <section class="content" style="padding: 1.5rem 1rem;">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm empresa-card" style="border-radius: 16px;">
                            <div class="card-header"
                                style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 16px 16px 0 0;">
                                <h3 class="mb-0" style="color: #2d3748; font-weight: 600; font-size: 18px;">
                                    <i class="fas fa-building mr-2" style="color: #10b981;"></i>{{ $empresa->nombre }}
                                </h3>
                            </div>
                            <form action="{{ route('empresas.update', $empresa->id) }}" method="POST" id="empresaForm">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
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
                                        {{-- Agregado campo NIT requerido por la migración --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nit" class="font-weight-bold">
                                                    <i class="fas fa-id-card text-warning mr-1"></i>
                                                    NIT
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('nit') is-invalid @enderror"
                                                    id="nit" name="nit" value="{{ old('nit', $empresa->nit) }}"
                                                    placeholder="Ingrese el NIT de la empresa" required>
                                                @error('nit')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Cambiado nombre_empresa a nombre según migración --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre" class="font-weight-bold">
                                                    <i class="fas fa-building text-primary mr-1"></i>
                                                    Nombre de la Empresa
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                                                    name="nombre" value="{{ old('nombre', $empresa->nombre) }}"
                                                    placeholder="Ingrese el nombre de la empresa" required>
                                                @error('nombre')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="direccion" class="font-weight-bold">
                                                    <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                                    Dirección
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea class="form-control @error('direccion') is-invalid @enderror"
                                                    id="direccion" name="direccion" rows="3"
                                                    placeholder="Ingrese la dirección completa"
                                                    required>{{ old('direccion', $empresa->direccion) }}</textarea>
                                                @error('direccion')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telefono" class="font-weight-bold">
                                                    <i class="fas fa-phone text-success mr-1"></i>
                                                    Teléfono
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="tel"
                                                    class="form-control @error('telefono') is-invalid @enderror"
                                                    id="telefono" name="telefono"
                                                    value="{{ old('telefono', $empresa->telefono) }}"
                                                    placeholder="Ej: +591 12345678" required>
                                                @error('telefono')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email" class="font-weight-bold">
                                                    <i class="fas fa-envelope text-info mr-1"></i>
                                                    Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" value="{{ old('email', $empresa->email) }}"
                                                    placeholder="ejemplo@empresa.com" required>
                                                @error('email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="estado"
                                            value="{{ old('estado', $empresa->estado ? 1 : 0) }}">
                                        <input type="hidden" name="registrado_por" value="{{ $empresa->registrado_por }}">

                                    </div>

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Todos los campos marcados con <span
                                            class="text-danger">*</span> son obligatorios.
                                    </div>

                                </div>

                                <div class="card-footer"
                                    style="background: #f9fafb; border-top: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 0 0 16px 16px;">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('empresas.index') }}"
                                            style="background: #6b7280; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none;">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
                                        <button type="submit"
                                            style="background: #10b981; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer;">
                                            <i class="fas fa-save"></i> Actualizar Empresa
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

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/empresas.css') }}">
@endpush