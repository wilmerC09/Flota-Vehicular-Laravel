@extends('layouts.app')

@section('title', 'Editar Licencia')

@section('content')
    <div class="content-wrapper pb-4" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Editar Licencia</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <a href="{{ route('licencias.index') }}" style="color: #6b7280; text-decoration: none;">Licencias</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Editar</span>
                        </nav>
                    </div>
                    <a href="{{ route('licencias.index') }}" style="background: #6b7280; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
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
                                    <i class="fas fa-id-card-alt mr-2" style="color: #10b981;"></i>Licencia {{ $licencia->numero_licencia }}
                                </h3>
                            </div>

                            <form method="POST" action="{{ route('licencias.update', $licencia->id) }}">
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
                                        {{-- Número de licencia --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="numero_licencia">
                                                    <i class="fas fa-hashtag text-primary mr-1"></i>
                                                    Número de Licencia <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('numero_licencia') is-invalid @enderror"
                                                    name="numero_licencia" id="numero_licencia"
                                                    value="{{ old('numero_licencia', $licencia->numero_licencia) }}" placeholder="Ej: LIC-1234-5678"
                                                    required>
                                                @error('numero_licencia')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Tipo de licencia --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tipo_licencia">
                                                    <i class="fas fa-list-alt text-info mr-1"></i>
                                                    Tipo de Licencia <strong style="color:red;">(*)</strong>
                                                </label>
                                                <select name="tipo_licencia" id="tipo_licencia"
                                                    class="form-control @error('tipo_licencia') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Seleccione un tipo --</option>
                                                    @foreach (['A1', 'A2', 'B1', 'B2', 'C1', 'C2'] as $tipo)
                                                        <option value="{{ $tipo }}"
                                                            {{ old('tipo_licencia', $licencia->tipo_licencia) == $tipo ? 'selected' : '' }}>
                                                            {{ $tipo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tipo_licencia')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Fecha de expedición --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_expedicion">
                                                    <i class="fas fa-calendar-check text-success mr-1"></i>
                                                    Fecha de Expedición <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="date"
                                                    class="form-control @error('fecha_expedicion') is-invalid @enderror"
                                                    name="fecha_expedicion" id="fecha_expedicion"
                                                    value="{{ old('fecha_expedicion', $licencia->fecha_expedicion) }}" required>
                                                @error('fecha_expedicion')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Fecha de vencimiento --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_vencimiento">
                                                    <i class="fas fa-calendar-times text-danger mr-1"></i>
                                                    Fecha de Vencimiento <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="date"
                                                    class="form-control @error('fecha_vencimiento') is-invalid @enderror"
                                                    name="fecha_vencimiento" id="fecha_vencimiento"
                                                    value="{{ old('fecha_vencimiento', $licencia->fecha_vencimiento) }}" required>
                                                @error('fecha_vencimiento')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Entidad emisora --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="entidad_emisora">
                                                    <i class="fas fa-building text-warning mr-1"></i>
                                                    Entidad Emisora <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('entidad_emisora') is-invalid @enderror"
                                                    name="entidad_emisora" id="entidad_emisora"
                                                    value="{{ old('entidad_emisora', $licencia->entidad_emisora) }}"
                                                    placeholder="Ej: Secretaría de Tránsito de Medellín" required>
                                                @error('entidad_emisora')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Campos ocultos --}}
                                    <input type="hidden" name="estado" value="{{ old('estado', $licencia->estado ? 1 : 0) }}">
                                    <input type="hidden" name="registrado_por" value="{{ $licencia->registrado_por }}">

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Los campos marcados con <strong
                                            style="color:red;">(*)</strong> son obligatorios.
                                    </div>
                                </div>

                                <div class="card-footer" style="background: #f9fafb; border-top: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 0 0 16px 16px;">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('licencias.index') }}" style="background: #6b7280; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none;">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
                                        <button type="submit" style="background: #10b981; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer;">
                                            <i class="fas fa-save"></i> Actualizar Licencia
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
