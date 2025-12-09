@extends('layouts.app')

@section('title', 'Editar Recarga de Combustible')

@section('content')

<div class="content-wrapper pb-4">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="m-0"><i class="fas fa-gas-pump mr-2"></i>Editar Recarga de Combustible</h1>
                <a href="{{ route('recarga_combustibles.index') }}" class="btn btn-secondary">
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
                                <i class="fas fa-edit mr-2"></i>Editar Recarga #{{ $recarga_combustible->id }}
                            </h3>
                        </div>

                        <form action="{{ route('recarga_combustibles.update', $recarga_combustible->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{-- Mensajes de error --}}
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <h5><i class="icon fas fa-ban"></i> Por favor corrige los siguientes errores:</h5>
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
                                    {{-- Vehículo --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vehiculo_id">
                                                <i class="fas fa-car text-primary mr-1"></i>
                                                Vehículo <strong style="color:red;">(*)</strong>
                                            </label>
                                            <select class="form-control @error('vehiculo_id') is-invalid @enderror"
                                                name="vehiculo_id" id="vehiculo_id" required>
                                                <option value="">-- Seleccionar Vehículo --</option>
                                                @foreach($vehiculos as $vehiculo)
                                                <option value="{{ $vehiculo->id }}"
                                                    {{ old('vehiculo_id', $recarga_combustible->vehiculo_id) == $vehiculo->id ? 'selected' : '' }}>
                                                    {{ $vehiculo->placa }} -
                                                    {{ $vehiculo->marca->nombre ?? 'Sin marca' }}
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
                                    <input type="hidden" class="form-control" name="estado" value="{{ old('estado', $recarga_combustible->estado ? 1 : 0) }}">
                                    <input type="hidden" class="form-control" name="registrado_por"
                                        value="{{ $recarga_combustible->registrado_por }}">

                                    {{-- Estación de Servicio --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estacion_servicio">
                                                <i class="fas fa-building text-warning mr-1"></i>
                                                Estación de Servicio <strong style="color:red;">(*)</strong>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('estacion_servicio') is-invalid @enderror"
                                                name="estacion_servicio" id="estacion_servicio"
                                                value="{{ old('estacion_servicio', $recarga_combustible->estacion_servicio) }}"
                                                placeholder="Ej: Gasolinera Central" required>
                                            @error('estacion_servicio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Cantidad de Litros --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cantidad_litros">
                                                <i class="fas fa-tint text-info mr-1"></i>
                                                Cantidad (Litros) <strong style="color:red;">(*)</strong>
                                            </label>
                                            <input type="number"
                                                class="form-control @error('cantidad_litros') is-invalid @enderror"
                                                name="cantidad_litros" id="cantidad_litros"
                                                value="{{ old('cantidad_litros', $recarga_combustible->cantidad_litros) }}" placeholder="0.00" step="0.01"
                                                min="0" required>
                                            @error('cantidad_litros')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Precio por Litro --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precio_litro">
                                                <i class="fas fa-dollar-sign text-success mr-1"></i>
                                                Precio por Litro <strong style="color:red;">(*)</strong>
                                            </label>
                                            <input type="number"
                                                class="form-control @error('precio_litro') is-invalid @enderror"
                                                name="precio_litro" id="precio_litro" value="{{ old('precio_litro', $recarga_combustible->precio_litro) }}"
                                                placeholder="0.00" step="0.01" min="0" required>
                                            @error('precio_litro')
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
                                                <i class="fas fa-money-bill-wave text-danger mr-1"></i>
                                                Costo Total <strong style="color:red;">(*)</strong>
                                            </label>
                                            <input type="number"
                                                class="form-control @error('costo_total') is-invalid @enderror"
                                                name="costo_total" id="costo_total" value="{{ old('costo_total', $recarga_combustible->costo_total) }}"
                                                placeholder="0.00" step="0.01" min="0" readonly required>
                                            @error('costo_total')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle"></i> Se calcula automáticamente
                                            </small>
                                        </div>
                                    </div>
                                </div>


                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <strong>Nota:</strong> Los campos marcados con <strong
                                        style="color:red;">(*)</strong> son obligatorios.
                                </div>
                            </div>

                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('recarga_combustibles.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times mr-1"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-save mr-1"></i> Actualizar Recarga
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cantidadInput = document.getElementById('cantidad_litros');
    const precioInput = document.getElementById('precio_litro');
    const costoTotalInput = document.getElementById('costo_total');

    // Función para calcular el costo total
    function calcularCostoTotal() {
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const precio = parseFloat(precioInput.value) || 0;
        const total = cantidad * precio;
        costoTotalInput.value = total.toFixed(2);
    }

    // Agregar eventos para calcular automáticamente
    cantidadInput.addEventListener('input', calcularCostoTotal);
    precioInput.addEventListener('input', calcularCostoTotal);
});
</script>
@endsection
