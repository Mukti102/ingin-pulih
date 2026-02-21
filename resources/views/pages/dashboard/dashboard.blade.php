<x-app-layout>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">User Baru (7 hari)</p>
                                <h4 class="card-title">{{ number_format($stats['new_users']) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Psikolog</p>
                                <h4 class="card-title">{{ number_format($stats['active_psychologists']) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Pendapatan</p>
                                <h4 class="card-title">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="far fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Booking</p>
                                <h4 class="card-title">{{ number_format($stats['total_bookings']) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Statistik Booking Konseling</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="bookingStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-primary card-round">
                <div class="card-header">
                    <div class="card-title">Total Omzet</div>
                    <div class="card-category">Bulan Ini</div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1>Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h1>
                    </div>
                    <div class="pull-in">
                        <canvas id="dailySalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Riwayat Transaksi Terbaru</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Klien</th>
                                    <th scope="col" class="text-end">Tanggal</th>
                                    <th scope="col" class="text-end">Nominal</th>
                                    <th scope="col" class="text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_transactions as $trx)
                                    <tr>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-{{ $trx->status == 'settlement' ? 'success' : 'warning' }} btn-sm me-2">
                                                <i
                                                    class="fa {{ $trx->status == 'settlement' ? 'fa-check' : 'fa-clock' }}"></i>
                                            </button>
                                            #{{ $trx->reference_id }}
                                        </th>
                                        <td>{{ $trx->booking->user->name ?? 'N/A' }}</td>
                                        <td class="text-end">{{ $trx->created_at->format('M d, Y') }}</td>
                                        <td class="text-end">Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                                        <td class="text-end">
                                            @php
                                                $badgeClass =
                                                    [
                                                        'settlement' => 'badge-success',
                                                        'pending' => 'badge-warning',
                                                        'expire' => 'badge-danger',
                                                        'cancel' => 'badge-secondary',
                                                    ][$trx->status] ?? 'badge-dark';
                                            @endphp
                                            <span
                                                class="badge {{ $badgeClass }}">{{ strtoupper($trx->status) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Pengajuan Pencairan Saldo</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Psikolog</th>
                                    <th scope="col" class="text-end">Tanggal</th>
                                    <th scope="col" class="text-end">Nominal</th>
                                    <th scope="col" class="text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestPayouts as $payout)
                                    <tr>
                                        <th scope="row">
                                            #{{ $loop->iteration }}
                                        </th>
                                        <td>{{ $payout->psycholog->fullname ?? 'N/A' }}</td>
                                        <td class="text-end">{{ $payout->created_at->format('M d, Y') }}</td>
                                        <td class="text-end">Rp {{ number_format($payout->amount, 0, ',', '.') }}</td>
                                        <td class="text-end">
                                            @php
                                                $badgeClass =
                                                    [
                                                        'approved' => 'badge-success',
                                                        'pending' => 'badge-warning',
                                                        'rejected' => 'badge-danger',
                                                        'cancelled' => 'badge-secondary',
                                                    ][$payout->status] ?? 'badge-dark';
                                            @endphp
                                            <span
                                                class="badge {{ $badgeClass }}">{{ strtoupper($payout->status) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Cek apakah elemen ada
                const chartElement = document.getElementById('bookingStatusChart');

                if (chartElement) {
                    const ctx = chartElement.getContext('2d');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($months) !!},
                            datasets: [{
                                    label: 'Pending',
                                    data: {!! json_encode($chartData['pending']) !!},
                                    borderColor: '#ffad46',
                                    backgroundColor: 'transparent',
                                    tension: 0.4
                                },
                                {
                                    label: 'Confirmed',
                                    data: {!! json_encode($chartData['confirmed']) !!},
                                    borderColor: '#1572E8',
                                    backgroundColor: 'transparent',
                                    tension: 0.4
                                },
                                {
                                    label: 'Complete',
                                    data: {!! json_encode($chartData['complete']) !!},
                                    borderColor: '#31CE36',
                                    backgroundColor: 'transparent',
                                    tension: 0.4
                                },
                                {
                                    label: 'Cancelled/Failed',
                                    data: {!! json_encode($chartData['cancelled']) !!},
                                    borderColor: '#F25961',
                                    backgroundColor: 'transparent',
                                    tension: 0.4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                } else {
                    console.error("Elemen canvas bookingStatusChart tidak ditemukan!");
                }
            });
        </script>
    @endpush
</x-app-layout>
