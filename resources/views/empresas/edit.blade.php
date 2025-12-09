@extends('layouts.app')

@section('title', 'Editar Empresa')

@section('content')

    <div class="content-wrapper pb-4">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0"><i class="fas fa-building mr-2"></i>Editar Empresa</h1>
                    <a href="{{ route('empresas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0 empresa-card">
                            <div class="card-header bg-info text-white">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-edit mr-2"></i>Editar Empresa - {{ $empresa->nombre }}
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

                                <div class="card-footer bg-light">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('empresas.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times mr-1"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-save mr-1"></i> Actualizar Empresa
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