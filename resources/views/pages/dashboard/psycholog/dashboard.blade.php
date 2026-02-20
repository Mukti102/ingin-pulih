<x-app-layout>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-title">Performa Konseling Saya</div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="psychologWorkChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-dark bg-secondary-gradient card-round">
                <div class="card-body pb-0">
                    <div class="h1 fw-bold float-end"><i class="fas fa-video opacity-25"></i></div>
                    <h2 class="mb-2">Sesi Terdekat</h2>
                    @if ($upcomingBooking)
                        <p class="op-7">Klien: <b>{{ $upcomingBooking->user->name }}</b></p>
                        <div class="py-3">
                            <div class="d-flex mb-2">
                                <div class="avatar avatar-xs me-2">
                                    <span class="avatar-title rounded-circle border border-white bg-primary"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <span class="text-white small align-self-center">
                                    {{ \Carbon\Carbon::parse($upcomingBooking->session_date)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="d-flex">
                                <div class="avatar avatar-xs me-2">
                                    <span class="avatar-title rounded-circle border border-white bg-primary"><i class="far fa-clock"></i></span>
                                </div>
                                <span class="text-white small align-self-center">{{ $upcomingBooking->start_time }} WIB</span>
                            </div>
                        </div>
                        <div class="pb-4">
                            <a href="{{ route('sessions.show', encrypt($upcomingBooking->sessionMeet->id)) }}" class="btn btn-white btn-border btn-round w-100">Mulai Sesi</a>
                        </div>
                    @else
                        <p class="op-7">Tidak ada jadwal dalam waktu dekat.</p>
                        <div class="pb-5"></div>
                    @endif
                </div>
            </div>
            
            <div class="card card-round">
                <div class="card-body">
                    <div class="card-title fw-bold">Total Sesi Selesai</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <h1 class="fw-bold">{{ $stats['total_sessions'] }}</h1>
                            <h6 class="text-muted">Sesi</h6>
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
                        <div class="card-title">Antrean Booking & Aktivitas</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Klien</th>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <span class="avatar-title rounded-circle bg-info text-white">{{ substr($item->user->name, 0, 1) }}</span>
                                            </div>
                                            <span class="text-sm font-weight-bold">{{ $item->user->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->session_date)->format('d/m/Y') }}</td>
                                    <td><code class="text-primary">{{ $item->code }}</code></td>
                                    <td>
                                        <span class="badge {{ $item->status == 'complete' ? 'badge-success' : ($item->status == 'pending' ? 'badge-warning' : 'badge-danger') }}">
                                            {{ strtoupper($item->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center p-5">Belum ada riwayat.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-title">Perlu Konfirmasi</div>
                </div>
                <div class="card-body">
                    @forelse($pendingBookings as $item)
                        <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                            <div class="avatar avatar-online">
                                <span class="avatar-title rounded-circle bg-light text-warning"><i class="fas fa-exclamation-circle"></i></span>
                            </div>
                            <div class="flex-1 ms-3 pt-1">
                                <h6 class="text-uppercase fw-bold mb-1">{{ $item->user->name }} <span class="text-warning ps-3">Pending</span></h6>
                                <span class="text-muted small">{{ $item->code }}</span>
                            </div>
                            <div class="float-end pt-1">
                                <a href="" class="btn btn-icon btn-primary btn-round btn-sm">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted">Semua jadwal sudah dikonfirmasi.</p>
                    @endforelse
                </div>
            </div>
            
            <div class="card bg-success-gradient card-round text-white">
                <div class="card-body">
                    <i class="fas fa-quote-left fa-2x opacity-25 mb-3"></i>
                    <p class="italic">"Kesehatan mental bukanlah tujuan, melainkan sebuah proses."</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('psychologWorkChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($months) !!},
                        datasets: [
                            {
                                label: 'Selesai',
                                data: {!! json_encode($chartData['complete']) !!},
                                borderColor: '#31CE36',
                                backgroundColor: 'rgba(49, 206, 54, 0.1)',
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'Dijadwalkan',
                                data: {!! json_encode($chartData['confirmed']) !!},
                                borderColor: '#1572E8',
                                fill: false,
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>