@extends('layouts.app')
@section('title', 'Rutas')
@section('content')
    <div class="content-wrapper" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Rutas</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;"><a href="{{ route('home') }}"
                                style="color: #6b7280; text-decoration: none;">Home</a><span
                                style="margin: 0 8px;">/</span><span>Rutas</span></nav>
                    </div><a href="{{ route('rutas.create') }}"
                        style="background: #1f2937; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items-center; gap: 8px;"><i
                            class="fas fa-plus"></i> Nueva Ruta</a>
                </div>
            </div>
        </section>
        <section class="content" style="padding: 1.5rem 1rem;">
            <div class="container-fluid">@if(session('successMsg'))
                <div class="alert alert-success alert-dismissible fade show"
                    style="border-radius: 8px; border-left: 4px solid #10b981;"><i
                        class="fas fa-check-circle mr-2"></i>{{ session('successMsg') }}<button type="button" class="close"
            data-dismiss="alert"><span>&times;</span></button></div>@endif
                <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <div class="card-header"
                        style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1rem 1.5rem;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"
                                            style="background: white; border-right: none;"><i class="fas fa-search"
                                                style="color: #9ca3af;"></i></span></div><input type="text" id="searchInput"
                                        class="form-control" placeholder="Buscar..." style="border-left: none;">
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
                                            class="fas fa-route text-muted mr-1"></i>Nombre Ruta</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;"><i
                                            class="fas fa-align-left text-muted mr-1"></i>Descripción</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;"><i
                                            class="fas fa-road text-muted mr-1"></i>Distancia (km)</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;"><i
                                            class="fas fa-dollar-sign text-muted mr-1"></i>Costo Peaje</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;"><i
                                            class="fas fa-money-bill-wave text-muted mr-1"></i>Precio (COP)</th>
                                    <th
                                        style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; text-align: center;">
                                        Estado</th>
                                    <th
                                        style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; text-align: center;">
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rutas as $ruta)
                                    <tr style="border-bottom: 1px solid #f3f4f6;">
                                        <td style="padding: 12px 16px;"><input type="checkbox" class="row-checkbox"></td>
                                        <td style="padding: 12px 16px; color: #6b7280; font-weight: 600;">{{ $ruta->id }}</td>
                                        <td style="padding: 12px 16px;">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    style="width: 48px; height: 48px; border-radius: 8px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); display: flex; align-items: center; justify-content: center; margin-right: 12px; color: white; font-weight: 700;">
                                                    <i class="fas fa-map"></i>
                                                </div>
                                                <div style="font-weight: 600; color: #1f2937;">{{ $ruta->nombre_ruta }}</div>
                                            </div>
                                        </td>
                                        <td style="padding: 12px 16px; color: #4b5563;">{{ Str::limit($ruta->descripcion, 50) }}
                                        </td>
                                        <td style="padding: 12px 16px; color: #4b5563;">
                                            {{ number_format($ruta->distancia_en_km, 2) }} km
                                        </td>
                                        <td style="padding: 12px 16px; color: #10b981; font-weight: 600;">
                                            ${{ number_format($ruta->costo_peaje, 0) }}</td>
                                        <td style="padding: 12px 16px; color: #059669; font-weight: 600;">
                                            ${{ number_format($ruta->precio ?? 0, 0) }}</td>
                                        <td style="padding: 12px 16px; text-align: center;"><span class="status-badge"
                                                data-id="{{ $ruta->id }}" data-model="rutas" data-status="{{ $ruta->estado }}"
                                                style="background: {{ $ruta->estado ? '#d1fae5' : '#fee2e2' }}; color: {{ $ruta->estado ? '#047857' : '#dc2626' }}; padding: 6px 14px; border-radius: 12px; font-size: 12px; font-weight: 600; cursor: pointer;"
                                                onclick="toggleStatus(this)">{{ $ruta->estado ? 'Activo' : 'Inactivo' }}</span>
                                        </td>
                                        <td style="padding: 12px 16px; text-align: center;"><button
                                                onclick="window.location='{{ route('rutas.edit', $ruta->id) }}'"
                                                style="background: transparent; border: none; color: #6b7280; padding: 6px 8px;"><i
                                                    class="fas fa-edit"></i></button><button
                                                onclick="confirmDelete({{ $ruta->id }})"
                                                style="background: transparent; border: none; color: #ef4444; padding: 6px 8px;"><i
                                                    class="fas fa-trash"></i></button>
                                            <form id="delete-form-{{ $ruta->id }}"
                                                action="{{ route('rutas.destroy', $ruta->id) }}" method="POST"
                                                style="display: none;">@csrf @method('DELETE')</form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center" style="padding: 40px;"><i class="fas fa-inbox"
                                                style="font-size: 48px; color: #9ca3af; display: block; margin-bottom: 16px;"></i>
                                            <p style="color: #9ca3af;">No hay rutas registradas</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($rutas->hasPages())
                        <div class="card-footer"
                            style="background: white; border-top: 1px solid #e5e7eb; padding: 1rem 1.5rem;">
                            {{ $rutas->links('pagination::bootstrap-4') }}
                    </div>@endif
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>document.getElementById('searchInput')?.addEventListener('keyup', function () { document.querySelectorAll('tbody tr').forEach(row => { row.style.display = row.textContent.toLowerCase().includes(this.value.toLowerCase()) ? '' : 'none'; }); }); function confirmDelete(id) { Swal.fire({ title: '¿Estás seguro?', text: "No podrás revertir esta acción", icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', cancelButtonColor: '#6b7280', confirmButtonText: 'Sí, eliminar', cancelButtonText: 'Cancelar' }).then((result) => { if (result.isConfirmed) document.getElementById('delete-form-' + id).submit(); }); } function toggleStatus(element) { const id = element.dataset.id; const model = element.dataset.model; const currentStatus = element.dataset.status == 1; const newStatus = currentStatus ? 0 : 1; Swal.fire({ title: '¿Cambiar estado?', text: `¿Desea cambiar el estado a ${newStatus ? 'Activo' : 'Inactivo'}?`, icon: 'question', showCancelButton: true, confirmButtonColor: '#10b981', cancelButtonColor: '#6b7280', confirmButtonText: 'Sí, cambiar', cancelButtonText: 'Cancelar' }).then((result) => { if (result.isConfirmed) { fetch(`/${model}/${id}/toggle-status`, { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }, body: JSON.stringify({ estado: newStatus }) }).then(response => response.json()).then(data => { if (data.success) { element.dataset.status = newStatus; element.style.background = newStatus ? '#d1fae5' : '#fee2e2'; element.style.color = newStatus ? '#047857' : '#dc2626'; element.textContent = newStatus ? 'Activo' : 'Inactivo'; Swal.fire({ title: '¡Actualizado!', text: 'El estado ha sido cambiado', icon: 'success', timer: 2000, showConfirmButton: false }); } else { Swal.fire('Error', 'No se pudo actualizar el estado', 'error'); } }).catch(error => { Swal.fire('Error', 'Ocurrió un error al actualizar el estado', 'error'); }); } }); }</script>
    @endpush
@endsection