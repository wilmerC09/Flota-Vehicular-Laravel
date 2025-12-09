@extends('layouts.app')

@section('title', 'Vehículos')

@section('content')
    <div class="content-wrapper" style="background: #f8f9fa;">
        <!-- Modern Header -->
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Vehículos</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Vehículos</span>
                        </nav>
                    </div>
                    <a href="{{ route('vehiculos.create') }}"
                        style="background: #1f2937; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;">
                        <i class="fas fa-plus"></i> Nuevo Vehículo
                    </a>
                </div>
            </div>
        </section>

        <section class="content" style="padding: 1.5rem 1rem;">
            <div class="container-fluid">
                {{-- Success/Error Messages --}}
                @if(session('successMsg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="border-radius: 8px; border-left: 4px solid #10b981;">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('successMsg') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="border-radius: 8px; border-left: 4px solid #ef4444;">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                <!-- Modern Card -->
                <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <!-- Filters/Search Bar -->
                    <div class="card-header"
                        style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem 1.5rem; border-radius: 12px 12px 0 0;">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            style="background: white; border-right: none; border-color: #d1d5db;">
                                            <i class="fas fa-search" style="color: #9ca3af;"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar..."
                                        style="border-left: none; border-color: #d1d5db;">
                                </div>
                            </div>
                            <div class="col-md-8 text-right">
                                <div class="btn-group">
                                    <button class="btn btn-outline-secondary btn-sm"
                                        style="border-color: #d1d5db; color: #6b7280; border-radius: 6px 0 0 6px;">
                                        <i class="fas fa-filter mr-1"></i> Más Filtros
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm"
                                        style="border-color: #d1d5db; color: #6b7280;">
                                        <i class="fas fa-tag mr-1"></i> Categoría <i class="fas fa-chevron-down ml-1"
                                            style="font-size: 10px;"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm"
                                        style="border-color: #d1d5db; color: #6b7280; border-radius: 0 6px 6px 0;">
                                        <i class="fas fa-download mr-1"></i> Exportar <i class="fas fa-chevron-down ml-1"
                                            style="font-size: 10px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0;">
                                <thead style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                                    <tr>
                                        <th style="padding: 12px 16px; width: 40px; border-bottom: 1px solid #e5e7eb;">
                                            <input type="checkbox" id="selectAll" style="cursor: pointer;">
                                        </th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-hashtag text-muted mr-1"></i>ID</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-image text-muted mr-1"></i>Imagen</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-id-card text-muted mr-1"></i>Placa</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-copyright text-muted mr-1"></i>Marca</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-truck text-muted mr-1"></i>Tipo</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-car-side text-muted mr-1"></i>Modelo</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-calendar-alt text-muted mr-1"></i>Año</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-palette text-muted mr-1"></i>Color</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-tachometer-alt text-muted mr-1"></i>Kilometraje</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-user text-muted mr-1"></i>Registrado por</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; text-align: center; border-bottom: 1px solid #e5e7eb;">
                                            Estado</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; text-align: center; border-bottom: 1px solid #e5e7eb;">
                                            Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Mapeo de colores en español a código hexadecimal
                                        $coloresMap = [
                                            'rojo' => '#DC3545',
                                            'azul' => '#007BFF',
                                            'verde' => '#28A745',
                                            'amarillo' => '#FFC107',
                                            'negro' => '#343A40',
                                            'blanco' => '#F8F9FA',
                                            'gris' => '#6C757D',
                                            'plateado' => '#C0C0C0',
                                            'dorado' => '#FFD700',
                                            'naranja' => '#FD7E14',
                                            'morado' => '#6F42C1',
                                            'rosa' => '#E83E8C',
                                            'café' => '#8B4513',
                                            'beige' => '#F5F5DC',
                                        ];
                                    @endphp

                                    @forelse($vehiculos as $vehiculo)
                                        @php
                                            $colorNombre = strtolower(trim($vehiculo->color));
                                            $colorHex = $coloresMap[$colorNombre] ?? '#6C757D';
                                            if (str_starts_with($vehiculo->color, '#')) {
                                                $colorHex = $vehiculo->color;
                                            }
                                        @endphp
                                        <tr style="border-bottom: 1px solid #f3f4f6;">
                                            <td style="padding: 12px 16px;">
                                                <input type="checkbox" class="row-checkbox" value="{{ $vehiculo->id }}"
                                                    style="cursor: pointer;">
                                            </td>
                                            <td style="padding: 12px 16px; color: #6b7280; font-weight: 600;">
                                                {{ $vehiculo->id }}</td>
                                            <td style="padding: 12px 16px;">
                                                @if($vehiculo->imagen && file_exists(public_path('uploads/vehiculos/' . $vehiculo->imagen)))
                                                    <img src="{{ asset('uploads/vehiculos/' . $vehiculo->imagen) }}"
                                                        alt="{{ $vehiculo->placa }}"
                                                        style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; cursor: pointer;"
                                                        onclick="window.open(this.src)">
                                                @else
                                                    <div
                                                        style="width: 50px; height: 50px; border-radius: 8px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-car" style="color: white; font-size: 20px;"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td style="padding: 12px 16px; font-weight: 600; color: #1f2937;">
                                                {{ $vehiculo->placa }}</td>
                                            <td style="padding: 12px 16px; color: #4b5563;">
                                                {{ $vehiculo->marca->nombre ?? 'N/A' }}</td>
                                            <td style="padding: 12px 16px;">
                                                <span
                                                    style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                                    {{ $vehiculo->tipo_vehiculo->nombre ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td style="padding: 12px 16px; color: #4b5563;">{{ $vehiculo->modelo }}</td>
                                            <td style="padding: 12px 16px;">
                                                <span
                                                    style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                                    {{ $vehiculo->año }}
                                                </span>
                                            </td>
                                            <td style="padding: 12px 16px;">
                                                <i class="fas fa-circle mr-1" style="color: {{ $colorHex }};"></i>
                                                {{ $vehiculo->color }}
                                            </td>
                                            <td style="padding: 12px 16px;">
                                                <span
                                                    style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                                    {{ number_format($vehiculo->kilometraje) }} km
                                                </span>
                                            </td>
                                            <td style="padding: 12px 16px; color: #4b5563;">{{ $vehiculo->registrado_por }}</td>
                                            <td style="padding: 12px 16px; text-align: center;">
                                                <span class="status-badge" data-id="{{ $vehiculo->id }}" data-model="vehiculos"
                                                    data-status="{{ $vehiculo->estado }}"
                                                    style="background: {{ $vehiculo->estado ? '#d1fae5' : '#fee2e2' }}; color: {{ $vehiculo->estado ? '#047857' : '#dc2626' }}; padding: 6px 14px; border-radius: 12px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                                                    onclick="toggleStatus(this)">
                                                    {{ $vehiculo->estado ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td style="padding: 12px 16px; text-align: center;">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm"
                                                        onclick="window.location='{{ route('vehiculos.edit', $vehiculo->id) }}'"
                                                        style="background: transparent; border: none; color: #6b7280; padding: 6px 8px;"
                                                        title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm"
                                                        onclick="confirmDelete({{ $vehiculo->id }})"
                                                        style="background: transparent; border: none; color: #ef4444; padding: 6px 8px;"
                                                        title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                <form id="delete-form-{{ $vehiculo->id }}"
                                                    action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="13" class="text-center" style="padding: 40px; color: #9ca3af;">
                                                <i class="fas fa-inbox"
                                                    style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
                                                <p style="margin: 0; font-size: 16px;">No hay vehículos registrados</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    @if($vehiculos->hasPages())
                        <div class="card-footer"
                            style="background: white; border-top: 1px solid #e5e7eb; padding: 1rem 1.5rem; border-radius: 0 0 12px 12px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div style="color: #6b7280; font-size: 14px;">
                                    Mostrando {{ $vehiculos->firstItem() }} a {{ $vehiculos->lastItem() }} de
                                    {{ $vehiculos->total() }} vehículos
                                </div>
                                <div>
                                    {{ $vehiculos->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('searchInput').addEventListener('keyup', function () {
                const searchTerm = this.value.toLowerCase();
                document.querySelectorAll('tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
                });
            });

            document.getElementById('selectAll')?.addEventListener('change', function () {
                document.querySelectorAll('.row-checkbox').forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            function confirmDelete(id) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }

            function toggleStatus(element) {
                const id = element.dataset.id;
                const model = element.dataset.model;
                const currentStatus = element.dataset.status == 1;
                const newStatus = currentStatus ? 0 : 1;

                Swal.fire({
                    title: '¿Cambiar estado?',
                    text: `¿Desea cambiar el estado a ${newStatus ? 'Activo' : 'Inactivo'}?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Sí, cambiar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/${model}/${id}/toggle-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ estado: newStatus })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    element.dataset.status = newStatus;
                                    element.style.background = newStatus ? '#d1fae5' : '#fee2e2';
                                    element.style.color = newStatus ? '#047857' : '#dc2626';
                                    element.textContent = newStatus ? 'Activo' : 'Inactivo';

                                    Swal.fire({
                                        title: '¡Actualizado!',
                                        text: 'El estado ha sido cambiado exitosamente',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    Swal.fire('Error', 'No se pudo actualizar el estado', 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error', 'Ocurrió un error al actualizar el estado', 'error');
                            });
                    }
                });
            }

            document.querySelectorAll('.btn-group .btn').forEach(btn => {
                btn.addEventListener('mouseenter', function () {
                    this.style.background = '#f3f4f6';
                    this.style.borderRadius = '6px';
                });
                btn.addEventListener('mouseleave', function () {
                    this.style.background = 'transparent';
                });
            });

            document.querySelectorAll('.status-badge').forEach(badge => {
                badge.addEventListener('mouseenter', function () {
                    this.style.transform = 'scale(1.05)';
                    this.style.boxShadow = '0 2px 8px rgba(0,0,0,0.15)';
                });
                badge.addEventListener('mouseleave', function () {
                    this.style.transform = 'scale(1)';
                    this.style.boxShadow = 'none';
                });
            });
        </script>
    @endpush

    <style>
        .table tbody tr:hover {
            background: #f9fafb;
        }

        a[href*="create"]:hover {
            background: #111827 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection