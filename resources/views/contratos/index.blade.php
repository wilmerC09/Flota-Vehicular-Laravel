@extends('layouts.app')
@section('title', 'Contratos')
@section('content')
    <div class="content-wrapper" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Contratos</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Contratos</span>
                        </nav>
                    </div>
                    <a href="{{ route('contratos.create') }}"
                        style="background: #1f2937; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-plus"></i> Nuevo Contrato
                    </a>
                </div>
            </div>
        </section>
        <section class="content" style="padding: 1.5rem 1rem;">
            <div class="container-fluid">
                @if(session('successMsg'))
                    <div class="alert alert-success alert-dismissible fade show"
                        style="border-radius: 8px; border-left: 4px solid #10b981;">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('successMsg') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <div class="card-header"
                        style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem 1.5rem;">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"
                                            style="background: white; border-right: none; border-color: #d1d5db;"><i
                                                class="fas fa-search" style="color: #9ca3af;"></i></span></div>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar..."
                                        style="border-left: none; border-color: #d1d5db;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead style="background: #f9fafb;">
                                <tr>
                                    <th style="padding: 12px 16px; width: 40px;"><input type="checkbox" id="selectAll"></th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;"><i
                                            class="fas fa-hashtag text-muted mr-1"></i>ID</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;"><i
                                            class="fas fa-calendar text-muted mr-1"></i>Fecha Inicio</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;"><i
                                            class="fas fa-calendar-check text-muted mr-1"></i>Fecha Final</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;"><i
                                            class="fas fa-dollar-sign text-muted mr-1"></i>Salario</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;"><i
                                            class="fas fa-user text-muted mr-1"></i>Registrado por</th>
                                    <th
                                        style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; text-align: center;">
                                        Estado</th>
                                    <th
                                        style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; text-align: center;">
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contratos as $contrato)
                                    <tr style="border-bottom: 1px solid #f3f4f6;">
                                        <td style="padding: 12px 16px;"><input type="checkbox" class="row-checkbox"></td>
                                        <td style="padding: 12px 16px; color: #6b7280; font-weight: 600;">{{ $contrato->id }}
                                        </td>
                                        <td style="padding: 12px 16px;"><i class="fas fa-calendar text-primary mr-1"></i><span
                                                class="font-weight-bold text-dark">{{ \Carbon\Carbon::parse($contrato->fecha_inicio)->format('d/m/Y') }}</span>
                                        </td>
                                        <td style="padding: 12px 16px;"><i class="fas fa-calendar text-success mr-1"></i><span
                                                class="font-weight-bold text-dark">{{ \Carbon\Carbon::parse($contrato->fecha_final)->format('d/m/Y') }}</span>
                                        </td>
                                        <td style="padding: 12px 16px; color: #10b981; font-weight: 600;">
                                            ${{ number_format($contrato->salario, 2) }}</td>
                                        <td style="padding: 12px 16px; color: #4b5563;">{{ $contrato->registrado_por }}</td>
                                        <td style="padding: 12px 16px; text-align: center;">
                                            <span class="status-badge" data-id="{{ $contrato->id }}" data-model="contratos"
                                                data-status="{{ $contrato->estado ? '1' : '0' }}"
                                                style="background: {{ $contrato->estado ? '#d1fae5' : '#fee2e2' }}; color: {{ $contrato->estado ? '#047857' : '#dc2626' }}; padding: 6px 14px; border-radius: 12px; font-size: 12px; font-weight: 600; cursor: pointer;"
                                                onclick="toggleStatus(this)">{{ $contrato->estado ? 'Activo' : 'Inactivo' }}</span>
                                        </td>
                                        <td style="padding: 12px 16px; text-align: center;">
                                            <button onclick="window.location='{{ route('contratos.edit', $contrato->id) }}'"
                                                style="background: transparent; border: none; color: #6b7280; padding: 6px 8px;"><i
                                                    class="fas fa-edit"></i></button>
                                            <button onclick="confirmDelete({{ $contrato->id }})"
                                                style="background: transparent; border: none; color: #ef4444; padding: 6px 8px;"><i
                                                    class="fas fa-trash"></i></button>
                                            <form id="delete-form-{{ $contrato->id }}"
                                                action="{{ route('contratos.destroy', $contrato->id) }}" method="POST"
                                                style="display: none;">@csrf @method('DELETE')</form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center" style="padding: 40px;"><i class="fas fa-inbox"
                                                style="font-size: 48px; color: #9ca3af; display: block; margin-bottom: 16px;"></i>
                                            <p style="color: #9ca3af;">No hay contratos registrados</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($contratos->hasPages())
                        <div class="card-footer"
                            style="background: white; border-top: 1px solid #e5e7eb; padding: 1rem 1.5rem;">
                            {{ $contratos->links('pagination::bootstrap-4') }}
                    </div>@endif
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('searchInput')?.addEventListener('keyup', function () { document.querySelectorAll('tbody tr').forEach(row => { row.style.display = row.textContent.toLowerCase().includes(this.value.toLowerCase()) ? '' : 'none'; }); });
            function confirmDelete(id) { Swal.fire({ title: '¿Estás seguro?', text: "No podrás revertir esta acción", icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', cancelButtonColor: '#6b7280', confirmButtonText: 'Sí, eliminar', cancelButtonText: 'Cancelar' }).then((result) => { if (result.isConfirmed) document.getElementById('delete-form-' + id).submit(); }); }
            function toggleStatus(element) { const id = element.dataset.id; const model = element.dataset.model; const currentStatus = element.dataset.status == 1; const newStatus = currentStatus ? 0 : 1; Swal.fire({ title: '¿Cambiar estado?', text: `¿Desea cambiar el estado a ${newStatus ? 'Activo' : 'Inactivo'}?`, icon: 'question', showCancelButton: true, confirmButtonColor: '#10b981', cancelButtonColor: '#6b7280', confirmButtonText: 'Sí, cambiar', cancelButtonText: 'Cancelar' }).then((result) => { if (result.isConfirmed) { fetch(`/${model}/${id}/toggle-status`, { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }, body: JSON.stringify({ estado: newStatus }) }).then(response => response.json()).then(data => { if (data.success) { element.dataset.status = newStatus; element.style.background = newStatus ? '#d1fae5' : '#fee2e2'; element.style.color = newStatus ? '#047857' : '#dc2626'; element.textContent = newStatus ? 'Activo' : 'Inactivo'; Swal.fire({ title: '¡Actualizado!', text: 'El estado ha sido cambiado', icon: 'success', timer: 2000, showConfirmButton: false }); } else { Swal.fire('Error', 'No se pudo actualizar el estado', 'error'); } }).catch(error => { Swal.fire('Error', 'Ocurrió un error al actualizar el estado', 'error'); }); } }); }
        </script>
    @endpush
    <style>
        .table tbody tr:hover {
            background: #f9fafb;
        }
    </style>
@endsection