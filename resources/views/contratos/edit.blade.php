@extends('layouts.app')

@section('title', 'Editar Contrato')

@section('content')
    <div class="content-wrapper pb-4">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0"><i class="fas fa-file-contract mr-2"></i>Editar Contrato</h1>
                    <a href="{{ route('contratos.index') }}" class="btn btn-secondary">
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
                                    <i class="fas fa-edit mr-2"></i>Editar Contrato #{{ $contrato->id }}
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

                                <div class="card-footer bg-light">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('contratos.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times mr-1"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-save mr-1"></i> Actualizar Contrato
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