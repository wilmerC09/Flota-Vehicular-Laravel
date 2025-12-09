@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f9fa;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color: #2d3748; font-weight: 600;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" style="color: #10b981;">Home</a></li>
              <li class="breadcrumb-item active" style="color: #6b7280;">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
      <section class="content">
        <div class="container-fluid">

          <!-- Tarjetas de estadísticas principales - Diseño moderno -->
          <div class="row">
            <!-- Revenue Card -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card border-0 shadow-sm"
                style="border-radius: 16px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <p class="text-white-50 mb-1" style="font-size: 14px; font-weight: 500;">Total Vehículos</p>
                      <h2 class="text-white mb-0" style="font-size: 32px; font-weight: 700;">{{ $totalVehiculos ?? 20 }}
                      </h2>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                      <i class="fas fa-car text-white" style="font-size: 24px;"></i>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-white-50" style="font-size: 13px;">
                      <i class="fas fa-arrow-up"></i> 2.1% vs last week
                    </span>
                    <a href="{{ route('vehiculos.index') }}" class="text-white"
                      style="font-size: 13px; text-decoration: none;">
                      View Report <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Conductores Card -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card border-0 shadow-sm" style="border-radius: 16px; background: white;">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <p class="text-muted mb-1" style="font-size: 14px; font-weight: 500;">Conductores Activos</p>
                      <h2 class="mb-0" style="font-size: 32px; font-weight: 700; color: #2d3748;">
                        {{ $conductoresActivos ?? 0 }}
                      </h2>
                    </div>
                    <div style="background: #d1fae5; padding: 12px; border-radius: 12px;">
                      <i class="fas fa-user-tie" style="font-size: 24px; color: #10b981;"></i>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted" style="font-size: 13px;">
                      <i class="fas fa-arrow-up text-success"></i>
                      <span class="text-success">5.2%</span> vs last week
                    </span>
                    <a href="{{ route('conductores.index') }}"
                      style="color: #10b981; font-size: 13px; text-decoration: none;">
                      View Report <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Viajes Card -->
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card border-0 shadow-sm" style="border-radius: 16px; background: white;">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <p class="text-muted mb-1" style="font-size: 14px; font-weight: 500;">Viajes del Mes</p>
                      <h2 class="mb-0" style="font-size: 32px; font-weight: 700; color: #2d3748;">{{ $viajesDelMes ?? 0 }}
                      </h2>
                    </div>
                    <div style="background: #fef3c7; padding: 12px; border-radius: 12px;">
                      <i class="fas fa-route" style="font-size: 24px; color: #f59e0b;"></i>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted" style="font-size: 13px;">
                      From 1-6 Dec, 2024
                    </span>
                    <a href="{{ route('viajes.index') }}" style="color: #10b981; font-size: 13px; text-decoration: none;">
                      View Report <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Segunda fila: Gráfico + Order Time -->
          <div class="row">
            <!-- Gráfico de Viajes -->
            <div class="col-lg-8 mb-4">
              <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" style="color: #2d3748; font-weight: 600;">Viajes por Mes</h5>
                    <a href="#" style="color: #10b981; font-size: 13px; text-decoration: none;">View Report</a>
                  </div>
                  <div style="position: relative; height: 250px;">
                    <canvas id="viajesChart"></canvas>
                  </div>
                  <div class="d-flex justify-content-center mt-3">
                    <div class="mr-4">
                      <span
                        style="display: inline-block; width: 12px; height: 12px; background: #10b981; border-radius: 2px; margin-right: 6px;"></span>
                      <span style="font-size: 13px; color: #6b7280;">Last 6 days</span>
                    </div>
                    <div>
                      <span
                        style="display: inline-block; width: 12px; height: 12px; background: #d1d5db; border-radius: 2px; margin-right: 6px;"></span>
                      <span style="font-size: 13px; color: #6b7280;">Last Week</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Order Time / Vehículos por Tipo -->
            <div class="col-lg-4 mb-4">
              <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" style="color: #2d3748; font-weight: 600;">Distribución</h5>
                    <a href="#" style="color: #10b981; font-size: 13px; text-decoration: none;">View Report</a>
                  </div>
                  <div style="position: relative; height: 180px;" class="text-center">
                    <canvas id="vehiculosChart"></canvas>
                  </div>
                  <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <div class="d-flex align-items-center">
                        <span
                          style="display: inline-block; width: 8px; height: 8px; background: #10b981; border-radius: 50%; margin-right: 8px;"></span>
                        <span style="font-size: 13px; color: #6b7280;">Mañana</span>
                      </div>
                      <span style="font-size: 14px; font-weight: 600; color: #2d3748;">28%</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <div class="d-flex align-items-center">
                        <span
                          style="display: inline-block; width: 8px; height: 8px; background: #3b82f6; border-radius: 50%; margin-right: 8px;"></span>
                        <span style="font-size: 13px; color: #6b7280;">Tarde</span>
                      </div>
                      <span style="font-size: 14px; font-weight: 600; color: #2d3748;">40%</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                        <span
                          style="display: inline-block; width: 8px; height: 8px; background: #f59e0b; border-radius: 50%; margin-right: 8px;"></span>
                        <span style="font-size: 13px; color: #6b7280;">Noche</span>
                      </div>
                      <span style="font-size: 14px; font-weight: 600; color: #2d3748;">32%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tercera fila: Stats pequeños + Más ordenados -->
          <div class="row">
            <!-- Most Ordered Food equivalente -->
            <div class="col-lg-6 mb-4">
              <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" style="color: #2d3748; font-weight: 600;">Vehículos Más Usados</h5>
                    <a href="#" style="color: #10b981; font-size: 13px; text-decoration: none;">View Report</a>
                  </div>
                  <p class="text-muted mb-4" style="font-size: 13px;">Vehículos con más viajes este mes</p>

                  <div class="list-group list-group-flush">
                    @forelse($vehiculosMayorKilometraje ?? [] as $index => $vehiculo)
                      <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                          <div class="mr-3"
                            style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-car" style="color: #10b981;"></i>
                          </div>
                          <div>
                            <h6 class="mb-0" style="font-size: 14px; color: #2d3748; font-weight: 600;">
                              {{ $vehiculo->placa }}
                            </h6>
                            <small class="text-muted">{{ $vehiculo->marca->nombre ?? 'N/A' }}</small>
                          </div>
                        </div>
                        <span
                          style="font-size: 14px; font-weight: 600; color: #2d3748;">{{ number_format($vehiculo->kilometraje) }}
                          km</span>
                      </div>
                    @empty
                      <div class="text-center text-muted py-3">No hay datos disponibles</div>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>

            <!-- Order / Gasto Combustible -->
            <div class="col-lg-6 mb-4">
              <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                      <h5 class="mb-1" style="color: #2d3748; font-weight: 600;">Gasto Combustible</h5>
                      <p class="text-muted mb-0" style="font-size: 13px;">Desde el 1-6 Dic, 2024</p>
                    </div>
                    <a href="{{ route('recarga_combustibles.index') }}"
                      style="color: #10b981; font-size: 13px; text-decoration: none;">
                      View Report
                    </a>
                  </div>

                  <h2 class="mb-3" style="font-size: 36px; font-weight: 700; color: #2d3748;">
                    ${{ number_format($gastoCombustibleMes ?? 0, 2) }}
                  </h2>

                  <div class="mb-3">
                    <span class="badge"
                      style="background: #d1fae5; color: #059669; font-size: 12px; padding: 4px 12px; border-radius: 12px;">
                      <i class="fas fa-arrow-up"></i> 2.1% vs last week
                    </span>
                  </div>

                  <div style="position: relative; height: 120px;">
                    <canvas id="combustibleChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Cuarta fila: Alertas -->
          <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0" style="color: #2d3748; font-weight: 600;">
                      <i class="fas fa-exclamation-triangle" style="color: #f59e0b;"></i>
                      Alertas Importantes
                    </h5>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <h6
                        style="color: #6b7280; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 16px;">
                        Licencias por Vencer</h6>
                      @forelse($licenciasPorVencer ?? [] as $licencia)
                        <div class="alert"
                          style="background: #fef3c7; border: none; border-left: 4px solid #f59e0b; border-radius: 8px; margin-bottom: 12px;">
                          <div class="d-flex align-items-center">
                            <i class="fas fa-id-card mr-3" style="color: #f59e0b;"></i>
                            <div>
                              <strong style="color: #78350f;">{{ $licencia->numero_licencia }}</strong>
                              <small class="d-block text-muted">Vence el
                                {{ \Carbon\Carbon::parse($licencia->fecha_vencimiento)->format('d/m/Y') }}</small>
                            </div>
                          </div>
                        </div>
                      @empty
                        <div class="text-center text-muted py-3">
                          <i class="fas fa-check-circle text-success"></i>
                          No hay licencias por vencer
                        </div>
                      @endforelse
                    </div>

                    <div class="col-lg-6">
                      <h6
                        style="color: #6b7280; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 16px;">
                        Actividad Reciente</h6>
                      @forelse($actividadReciente ?? [] as $actividad)
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                          <div class="d-flex align-items-center">
                            <div class="mr-3" style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;">
                            </div>
                            <div>
                              <strong
                                style="color: #2d3748; font-size: 14px;">{{ $actividad->descripcion ?? 'Viaje' }}</strong>
                              <small class="d-block text-muted" style="font-size: 12px;">
                                {{ \Carbon\Carbon::parse($actividad->created_at)->diffForHumans() }}
                              </small>
                            </div>
                          </div>
                        </div>
                      @empty
                        <div class="text-center text-muted py-3">
                          <i class="fas fa-info-circle"></i>
                          No hay actividad reciente
                        </div>
                      @endforelse
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div><!-- /.container-fluid -->
      </section>
    </div>
  </div>

  <!-- Scripts para los gráficos con Chart.js -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Configuración global de Chart.js para diseño moderno
  Chart.defaults.font.family = "'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif";
  Chart.defaults.responsive = true;
  Chart.defaults.maintainAspectRatio = false;
  
  // Gráfico de Viajes por Mes - Diseño moderno con barras
  const viajesCtx = document.getElementById('viajesChart');
  if (viajesCtx) {
    new Chart(viajesCtx, {
      type: 'bar',
      data: {
        labels: {!! json_encode($viajesMeses ?? ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun']) !!},
        datasets: [{
          label: 'Last 6 days',
          data: {!! json_encode($viajesData ?? [12, 19, 15, 25, 22, 30]) !!},
          backgroundColor: '#10b981',
          borderRadius: 6,
          maxBarThickness: 35
        }, {
          label: 'Last Week',
          data: [10, 15, 12, 20, 18, 25],
          backgroundColor: '#e5e7eb',
          borderRadius: 6,
          maxBarThickness: 35
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 750
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            backgroundColor: '#1f2937',
            padding: 12,
            borderRadius: 8,
            titleColor: '#fff',
            bodyColor: '#fff',
            displayColors: true,
            boxWidth: 12,
            boxHeight: 12
          }
        },
        scales: {
          x: {
            grid: {
              display: false
            },
            ticks: {
              color: '#9ca3af',
              font: {
                size: 12
              }
            }
          },
          y: {
            beginAtZero: true,
            grid: {
              color: '#f3f4f6',
              drawBorder: false
            },
            ticks: {
              color: '#9ca3af',
              font: {
                size: 12
              }
            }
          }
        }
      }
    });
  }

  // Gráfico de Vehículos por Tipo - Donut moderno
  const vehiculosCtx = document.getElementById('vehiculosChart');
  if (vehiculosCtx) {
    new Chart(vehiculosCtx, {
      type: 'doughnut',
      data: {
        labels: ['Mañana', 'Tarde', 'Noche'],
        datasets: [{
          data: [28, 40, 32],
          backgroundColor: ['#10b981', '#3b82f6', '#f59e0b'],
          borderWidth: 0,
          cutout: '70%'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 750
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            backgroundColor: '#1f2937',
            padding: 12,
            borderRadius: 8,
            bodyColor: '#fff',
            displayColors: true,
            boxWidth: 12,
            boxHeight: 12
          }
        }
      }
    });
  }

  // Gráfico de Combustible - Línea moderna
  const combustibleCtx = document.getElementById('combustibleChart');
  if (combustibleCtx) {
    new Chart(combustibleCtx, {
      type: 'line',
      data: {
        labels: ['01', '02', '03', '04', '05', '06'],
        datasets: [{
          data: [30, 45, 40, 55, 50, 65],
          borderColor: '#10b981',
          backgroundColor: 'rgba(16, 185, 129, 0.1)',
          borderWidth: 2,
          fill: true,
          tension: 0.4,
          pointRadius: 0,
          pointHoverRadius: 5,
          pointHoverBackgroundColor: '#10b981',
          pointHoverBorderColor: '#fff',
          pointHoverBorderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 750
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            backgroundColor: '#1f2937',
            padding: 8,
            borderRadius: 6,
            displayColors: false,
            titleColor: '#fff',
            bodyColor: '#fff'
          }
        },
        scales: {
          x: {
            grid: {
              display: false
            },
            ticks: {
              color: '#9ca3af',
              font: {
                size: 10
              }
            }
          },
          y: {
            display: false
          }
        }
      }
    });
  }
</script>
@endpush
@endsection