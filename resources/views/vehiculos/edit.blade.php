@extends('layouts.app')

@section('title','Editar Vehículo')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-car"></i> Editar Vehículo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('vehiculos.index') }}">Vehículos</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-edit"></i> Editar Vehículo - {{ $vehiculo->placa }}
                            </h3>
                        </div>
                        
                        <form method="POST" action="{{ route('vehiculos.update', $vehiculo->id) }}" id="vehiculoForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                {{-- Mensajes de error --}}
                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong>Error:</strong> {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <strong>Por favor, corrija los siguientes errores:</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {{-- Información del vehículo --}}
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h5 class="text-primary border-bottom pb-2">
                                            <i class="fas fa-info-circle"></i> Información General
                                        </h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-copyright"></i> Marca 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control @error('marca_id') is-invalid @enderror" 
                                                    name="marca_id" id="marca_id" required>
                                                <option value="">-- Seleccione una marca --</option>
                                                @foreach($marcas as $marca)
                                                    <option value="{{ $marca->id }}" {{ old('marca_id', $vehiculo->marca_id) == $marca->id ? 'selected' : '' }}>
                                                        {{ $marca->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('marca_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-truck"></i> Tipo de Vehículo 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control @error('tipo_vehiculo_id') is-invalid @enderror" 
                                                    name="tipo_vehiculo_id" id="tipo_vehiculo_id" required>
                                                <option value="">-- Seleccione un tipo --</option>
                                                @foreach($tipo_vehiculos as $tipo_vehiculo)
                                                    <option value="{{ $tipo_vehiculo->id }}" {{ old('tipo_vehiculo_id', $vehiculo->tipo_vehiculo_id) == $tipo_vehiculo->id ? 'selected' : '' }}>
                                                        {{ $tipo_vehiculo->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tipo_vehiculo_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-id-card"></i> Placa 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" 
                                                   class="form-control text-uppercase @error('placa') is-invalid @enderror" 
                                                   name="placa" id="placa"
                                                   placeholder="Ej: ABC-123" 
                                                   autocomplete="off"
                                                   value="{{ old('placa', $vehiculo->placa) }}" 
                                                   maxlength="10"
                                                   required>
                                            <small class="form-text text-muted">Formato: ABC-123</small>
                                            @error('placa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-car-side"></i> Modelo 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" 
                                                   class="form-control @error('modelo') is-invalid @enderror" 
                                                   name="modelo" id="modelo"
                                                   placeholder="Ej: Corolla, Civic, Spark" 
                                                   autocomplete="off"
                                                   value="{{ old('modelo', $vehiculo->modelo) }}" 
                                                   required>
                                            @error('modelo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-calendar-alt"></i> Año 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" 
                                                   class="form-control @error('año') is-invalid @enderror" 
                                                   name="año" id="año"
                                                   placeholder="Ej: 2023" 
                                                   autocomplete="off"
                                                   value="{{ old('año', $vehiculo->año) }}" 
                                                   min="1900" 
                                                   max="{{ date('Y') + 1 }}"
                                                   required>
                                            @error('año')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-palette"></i> Color 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" 
                                                   class="form-control @error('color') is-invalid @enderror" 
                                                   name="color" id="colorText"
                                                   placeholder="Ej: Rojo, #DC3545" 
                                                   autocomplete="off"
                                                   value="{{ old('color', $vehiculo->color) }}" 
                                                   required>
                                            <small class="form-text text-muted">Ingrese nombre o código hexadecimal</small>
                                            @error('color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-tachometer-alt"></i> Kilometraje 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" 
                                                   class="form-control @error('kilometraje') is-invalid @enderror" 
                                                   name="kilometraje" id="kilometraje"
                                                   placeholder="Ej: 10000" 
                                                   autocomplete="off"
                                                   value="{{ old('kilometraje', $vehiculo->kilometraje) }}" 
                                                   min="0"
                                                   required>
                                            <small class="form-text text-muted">En kilómetros</small>
                                            @error('kilometraje')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Campo de Imagen --}}
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h5 class="text-primary border-bottom pb-2">
                                            <i class="fas fa-image"></i> Imagen del Vehículo
                                        </h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-camera"></i> Imagen
                                            </label>
                                            
                                            {{-- Mostrar imagen actual --}}
                                            @if($vehiculo->imagen && file_exists(public_path('uploads/vehiculos/'.$vehiculo->imagen)))
                                                <div class="mb-3">
                                                    <p class="text-muted mb-2">Imagen actual:</p>
                                                    <img src="{{ asset('uploads/vehiculos/'.$vehiculo->imagen) }}" 
                                                         alt="Imagen actual" 
                                                         class="img-fluid" 
                                                         style="max-width: 300px; height: auto; border: 1px solid #ddd; border-radius: 5px;">
                                                    <p class="text-muted mt-2"><small>Seleccione una nueva imagen solo si desea cambiar la actual</small></p>
                                                </div>
                                            @endif
                                            
                                            <div class="custom-file">
                                                <input type="file" 
                                                       class="custom-file-input @error('imagen') is-invalid @enderror" 
                                                       name="imagen" 
                                                       id="imagen"
                                                       accept="image/jpeg,image/png,image/jpg,image/gif">
                                                <label class="custom-file-label" for="imagen">Seleccionar nueva imagen...</label>
                                            </div>
                                            <small class="form-text text-muted">Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 10MB</small>
                                            @error('imagen')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            
                                            {{-- Vista previa de la nueva imagen --}}
                                            <div id="imagePreview" class="mt-3" style="display: none;">
                                                <p class="text-muted mb-2">Nueva imagen:</p>
                                                <img src="" alt="Vista previa" class="img-fluid" style="max-width: 300px; height: auto; border: 1px solid #ddd; border-radius: 5px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="estado" value="{{ old('estado', $vehiculo->estado ? 1 : 0) }}">
                                <input type="hidden" name="registrado_por" value="{{ $vehiculo->registrado_por }}">

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="alert alert-info mb-0">
                                            <i class="fas fa-info-circle"></i>
                                            <strong>Nota:</strong> Los campos marcados con <span class="text-danger">*</span> son obligatorios.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light">
                                <div class="row">
                                    <div class="col-md-6 mb-2 mb-md-0">
                                        <button type="submit" class="btn btn-info btn-block">
                                            <i class="fas fa-save"></i> Actualizar Vehículo
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary btn-block">
                                            <i class="fas fa-arrow-left"></i> Cancelar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Convertir placa a mayúsculas automáticamente
        $('#placa').on('input', function() {
            this.value = this.value.toUpperCase();
        });

        // Sincronización del selector de color
        const colorPicker = $('#colorPicker');
        const colorText = $('#colorText');
        
        // Mapeo de colores comunes en español a hexadecimal
        const coloresMap = {
            'rojo': '#DC3545',
            'azul': '#007BFF',
            'verde': '#28A745',
            'amarillo': '#FFC107',
            'negro': '#000000',
            'blanco': '#FFFFFF',
            'gris': '#6C757D',
            'plateado': '#C0C0C0',
            'dorado': '#FFD700',
            'naranja': '#FD7E14',
            'morado': '#6F42C1',
            'rosa': '#E83E8C',
            'café': '#8B4513',
            'beige': '#F5F5DC'
        };
        
        // Establecer color inicial del picker basado en el texto
        const colorInicial = colorText.val().toLowerCase().trim();
        if (coloresMap[colorInicial]) {
            colorPicker.val(coloresMap[colorInicial]);
        } else if (colorInicial.startsWith('#')) {
            colorPicker.val(colorInicial);
        }
        
        // Cuando se cambia el picker, actualizar el texto con el código hex
        colorPicker.on('change', function() {
            colorText.val($(this).val());
        });

        // Actualizar label del input file y mostrar preview
        $('#imagen').on('change', function() {
            const fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName || 'Seleccionar nueva imagen...');
            
            // Mostrar vista previa
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').show();
                    $('#imagePreview img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            } else {
                $('#imagePreview').hide();
            }
        });

        // Validación adicional del formulario
        $('#vehiculoForm').on('submit', function(e) {
            let isValid = true;
            
            // Validar año
            const año = parseInt($('#año').val());
            const añoActual = new Date().getFullYear();
            if (año < 1900 || año > añoActual + 1) {
                alert('Por favor, ingrese un año válido entre 1900 y ' + (añoActual + 1));
                isValid = false;
            }
            
            // Validar kilometraje
            const kilometraje = parseInt($('#kilometraje').val());
            if (kilometraje < 0) {
                alert('El kilometraje no puede ser negativo');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
@endsection
