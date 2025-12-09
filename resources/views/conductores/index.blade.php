@extends('layouts.app')

@section('title', 'Conductores')

@section('content')
    <div class="content-wrapper" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Conductores</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Conductores</span>
                        </nav>
                    </div>
                    <a href="{{ route('conductores.create') }}"
                        style="background: #1f2937; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;">
                        <i class="fas fa-plus"></i> Nuevo Conductor
                    </a>
                </div>
            </div>
        </section>

        <section class="content" style="padding: 1.5rem 1rem;">
            <div class="container-fluid">
                @if(session('successMsg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="border-radius: 8px; border-left: 4px solid #10b981;">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('successMsg') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <div class="card-header"
                        style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem 1.5rem; border-radius: 12px 12px 0 0;">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            style="background: white; border-right: none; border-color: #d1d5db;"><i
                                                class="fas fa-search" style="color: #9ca3af;"></i></span>
                                    </div>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar..."
                                        style="border-left: none; border-color: #d1d5db;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                                    <tr>
                                        <th style="padding: 12px 16px; width: 40px; border-bottom: 1px solid #e5e7eb;">
                                            <input type="checkbox" id="selectAll"></th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-hashtag text-muted mr-1"></i>ID</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-user text-muted mr-1"></i>Nombre Completo</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-id-card text-muted mr-1"></i>Documento</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-calendar text-muted mr-1"></i>Fecha Nacimiento</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">
                                            <i class="fas fa-user-shield text-muted mr-1"></i>Registrado por</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; text-align: center; border-bottom: 1px solid #e5e7eb;">
                                            Estado</th>
                                        <th
                                            style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; text-align: center; border-bottom: 1px solid #e5e7eb;">
                                            Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($conductores as $conductor)
                                        <tr style="border-bottom: 1px solid #f3f4f6;">
                                            <td style="padding: 12px 16px;"><input type="checkbox" class="row-checkbox"
                                                    value="{{ $conductor->id }}"></td>
                                            <td style="padding: 12px 16px; color: #6b7280; font-weight: 600;">
                                                {{ $conductor->id }}</td>
                                            <td style="padding: 12px 16px;">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        style="width: 48px; height: 48px; border-radius: 8px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center; margin-right: 12px; color: white; font-weight: 700;">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div>
                                                        <div style="font-weight: 600; color: #1f2937;">{{ $conductor->nombre }}
                                                            {{ $conductor->apellido }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 12px 16px; color: #4b5563;">{{ $conductor->documento }}</td>
                                            <td style="padding: 12px 16px; color: #4b5563;">
                                                <i class="fas fa-calendar-alt mr-1" style="color: #3b82f6;"></i>
                                                {{ \Carbon\Carbon::parse($conductor->fecha_nacimiento)->format('d/m/Y') }}
                                            </td>
                                            <td style="padding: 12px 16px; color: #4b5563;">{{ $conductor->registrado_por }}
                                            </td>
                                            <td style="padding: 12px 16px; text-align: center;">
                                                <span class="status-badge" data-id="{{ $conductor->id }}"
                                                    data-model="conductores" data-status="{{ $conductor->estado ? '1' : '0' }}"
                                                    style="background: {{ $conductor->estado ? '#d1fae5' : '#fee2e2' }}; color: {{ $conductor->estado ? '#047857' : '#dc2626' }}; padding: 6px 14px; border-radius: 12px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                                                    onclick="toggleStatus(this)">
                                                    {{ $conductor->estado ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td style="padding: 12px 16px; text-align: center;">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm"
                                                        onclick="window.location='{{ route('conductores.edit', $conductor->id) }}'"
                                                        style="background: transparent; border: none; color: #6b7280; padding: 6px 8px;"
                                                        title="Editar"><i class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-sm"
                                                        onclick="confirmDelete({{ $conductor->id }})"
                                                        style="background: transparent; border: none; color: #ef4444; padding: 6px 8px;"
                                                        title="Eliminar"><i class="fas fa-trash"></i></button>
                                                </div>
                                                <form id="delete-form-{{ $conductor->id }}"
                                                    action="{{ route('conductores.destroy', $conductor->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center" style="padding: 40px; color: #9ca3af;">
                                                <i class="fas fa-inbox"
                                                    style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
                                                <p style="margin: 0; font-size: 16px;">No hay conductores registrados</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($conductores->hasPages())
                        <div class="card-footer"
                            style="background: white; border-top: 1px solid #e5e7eb; padding: 1rem 1.5rem; border-radius: 0 0 12px 12px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div style="color: #6b7280; font-size: 14px;">
                                    Mostrando {{ $conductores->firstItem() }} a {{ $conductores->lastItem() }} de
                                    {{ $conductores->total() }} conductores
                                </div>
                                <div>{{ $conductores->links('pagination::bootstrap-4') }}</div>
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
                document.querySelectorAll('tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(this.value.toLowerCase()) ? '' : 'none';
                });
            });

            document.getElementById('selectAll')?.addEventListener('change', function () {
                document.querySelectorAll('.row-checkbox').forEach(checkbox => { checkbox.checked = this.checked; });
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
                    if (result.isConfirmed) document.getElementById('delete-form-' + id).submit();
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
                                    Swal.fire({ title: '¡Actualizado!', text: 'El estado ha sido cambiado', icon: 'success', timer: 2000, showConfirmButton: false });
                                } else {
                                    Swal.fire('Error', 'No se pudo actualizar el estado', 'error');
                                }
                            })
                            .catch(error => { Swal.fire('Error', 'Ocurrió un error al actualizar el estado', 'error'); });
                    }
                });
            }

            document.querySelectorAll('.btn-group .btn').forEach(btn => {
                btn.addEventListener('mouseenter', function () { this.style.background = '#f3f4f6'; this.style.borderRadius = '6px'; });
                btn.addEventListener('mouseleave', function () { this.style.background = 'transparent'; });
            });
        </script>
    @endpush

    <style>
        .table tbody tr:hover {
            background: #f9fafb;
        }

        a[href*="create"]:hover {
            background: #111827 !important;
        }
    </style>
@endsection