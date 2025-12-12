@extends('layouts.app')

@section('title', 'Editar Contrato')

@section('content')
    <div class="content-wrapper pb-4" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Editar Contrato</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <a href="{{ route('contratos.index') }}"
                                style="color: #6b7280; text-decoration: none;">Contratos</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Editar</span>
                        </nav>
                    </div>
                    <a href="{{ route('contratos.index') }}"
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
                                    <i class="fas fa-file-contract mr-2" style="color: #10b981;"></i>Contrato
                                    #{{ $contrato->id }}
                                </h3>
                            </div>

                            <form method="POST" action="{{ route('contratos.update', $contrato->id) }}">
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
                                        {{-- Fecha Inicio --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_inicio">
                                                    <i class="fas fa-calendar-check text-success mr-1"></i>
                                                    Fecha de Inicio <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="date"
                                                    class="form-control @error('fecha_inicio') is-invalid @enderror"
                                                    name="fecha_inicio" id="fecha_inicio"
                                                    value="{{ old('fecha_inicio', $contrato->fecha_inicio) }}" required>
                                                @error('fecha_inicio')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Fecha Final --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_final">
                                                    <i class="fas fa-calendar-times text-warning mr-1"></i>
                                                    Fecha Final
                                                </label>
                                                <input type="date"
                                                    class="form-control @error('fecha_final') is-invalid @enderror"
                                                    name="fecha_final" id="fecha_final"
                                                    value="{{ old('fecha_final', $contrato->fecha_final) }}">
                                                @error('fecha_final')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Salario --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="salario">
                                                    <i class="fas fa-dollar-sign text-primary mr-1"></i>
                                                    Salario <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('salario') is-invalid @enderror"
                                                    name="salario" id="salario" min="0" step="0.01"
                                                    value="{{ old('salario', $contrato->salario) }}"
                                                    placeholder="Ej: 1500000" required>
                                                @error('salario')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Campos ocultos --}}
                                    <input type="hidden" name="estado"
                                        value="{{ old('estado', $contrato->estado ? 1 : 0) }}">
                                    <input type="hidden" name="registrado_por" value="{{ $contrato->registrado_por }}">

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Los campos marcados con <strong
                                            style="color:red;">(*)</strong> son obligatorios.
                                    </div>
                                </div>

                                <div class="card-footer"
                                    style="background: #f9fafb; border-top: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 0 0 16px 16px;">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('contratos.index') }}"
                                            style="background: #6b7280; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none;">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
                                        <button type="submit"
                                            style="background: #10b981; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer;">
                                            <i class="fas fa-save"></i> Actualizar Contrato
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