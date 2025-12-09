@extends('layouts.app')
@section('title', 'Combustible')
@section('content')
    <div class="content-wrapper" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Combustible</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;"><a href="{{ route('home') }}"
                                style="color: #6b7280; text-decoration: none;">Home</a><span
                                style="margin: 0 8px;">/</span><span>Combustible</span></nav>
                    </div><a href="{{ route('recarga_combustibles.create') }}"
                        style="background: #1f2937; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items-center; gap: 8px;"><i
                            class="fas fa-plus"></i> Nueva Recarga</a>
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
                        <div class="row align-items-center">
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
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;">
                                        Vehículo</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;">
                                        Litros</th>
                                    <th style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280;">Costo
                                    </th>
                                    <th
                                        style="padding: 12px 16px; font-weight: 600; font-size: 13px; color: #6b7280; text-align: center;">
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recarga_combustibles as $recarga)
                                    <tr style="border-bottom: 1px solid #f3f4f6;">
                                        <td style="padding: 12px 16px;"><input type="checkbox" class="row-checkbox"></td>
                                        <td style="padding: 12px 16px;">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    style="width: 48px; height: 48px; border-radius: 8px; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); display: flex; align-items: center; justify-content: center; margin-right: 12px; color: white; font-weight: 700;">
                                                    <i class="fas fa-gas-pump"></i>
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: #1f2937;">
                                                        {{ $recarga->vehiculo->placa ?? 'N/A' }}
                                                    </div>
                                                    <div style="font-size: 13px; color: #6b7280;">
                                                        {{ $recarga->estacion_servicio }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 12px 16px; color: #4b5563;">{{ $recarga->cantidad_litros }} L</td>
                                        <td style="padding: 12px 16px; color: #10b981; font-weight: 600;">
                                            ${{ number_format($recarga->costo_total, 2) }}</td>
                                        <td style="padding: 12px 16px; text-align: center;"><button
                                                onclick="window.location='{{ route('recarga_combustibles.edit', $recarga->id) }}'"
                                                style="background: transparent; border: none; color: #6b7280; padding: 6px 8px;"><i
                                                    class="fas fa-edit"></i></button><button
                                                onclick="confirmDelete({{ $recarga->id }})"
                                                style="background: transparent; border: none; color: #ef4444; padding: 6px 8px;"><i
                                                    class="fas fa-trash"></i></button>
                                            <form id="delete-form-{{ $recarga->id }}"
                                                action="{{ route('recarga_combustibles.destroy', $recarga->id) }}" method="POST"
                                                style="display: none;">@csrf @method('DELETE')</form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center" style="padding: 40px;"><i class="fas fa-inbox"
                                                style="font-size: 48px; color: #9ca3af; display: block; margin-bottom: 16px;"></i>
                                            <p style="color: #9ca3af;">No hay recargas registradas</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($recarga_combustibles->hasPages())
                        <div class="card-footer"
                            style="background: white; border-top: 1px solid #e5e7eb; padding: 1rem 1.5rem;">
                            {{ $recarga_combustibles->links('pagination::bootstrap-4') }}
                    </div>@endif
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>document.getElementById('searchInput')?.addEventListener('keyup', function () { document.querySelectorAll('tbody tr').forEach(row => { row.style.display = row.textContent.toLowerCase().includes(this.value.toLowerCase()) ? '' : 'none'; }); }); function confirmDelete(id) { Swal.fire({ title: '¿Estás seguro?', text: "No podrás revertir esta acción", icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444', cancelButtonColor: '#6b7280', confirmButtonText: 'Sí, eliminar', cancelButtonText: 'Cancelar' }).then((result) => { if (result.isConfirmed) document.getElementById('delete-form-' + id).submit(); }); }</script>
    @endpush
@endsection