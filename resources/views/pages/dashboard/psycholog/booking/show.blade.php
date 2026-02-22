<x-app-layout>
    <x-page-header title="Detail Booking" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Booking', 'route' => 'bookings.index'],
        ['label' => 'Detail #' . $booking->id],
    ]" />

    <div class="container-fluid pb-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-lg-none mb-3">
                    <x-booking-status-badge :status="$booking->status" />

                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0 fw-bold text-dark">Informasi Sesi Konsultasi</h5>
                            <span class="text-muted small">ID Booking: #{{ $booking->id }}</span>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="small text-muted text-uppercase fw-bold mb-2 d-block">Psikolog</label>
                                <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                    <div class="bg-primary text-black rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 45px; height: 45px;">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $booking->psycholog->name }}</h6>
                                        <p class="mb-0 small text-muted">{{ $booking->psycholog->jenisPsikolog->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="small text-muted text-uppercase fw-bold mb-2 d-block">Pasien /
                                    Klien</label>
                                <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                    <div class="bg-info text-black rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 45px; height: 45px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $booking->user->name }}</h6>
                                        <p class="mb-0 small text-muted">{{ $booking->user->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="p-3 border rounded-3 h-100">
                                    <small class="text-muted d-block mb-1"><i class="far fa-calendar-alt me-1"></i>
                                        Tanggal</small>
                                    <h6 class="mb-0 fw-bold">
                                        {{ \Carbon\Carbon::parse($booking->session_date)->translatedFormat('d F Y') }}
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 border rounded-3 h-100">
                                    <small class="text-muted d-block mb-1"><i class="far fa-clock me-1"></i>
                                        Waktu</small>
                                    <h6 class="mb-0 fw-bold">
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 border rounded-3 h-100">
                                    <small class="text-muted d-block mb-1"><i class="fas fa-video me-1"></i>
                                        Metode</small>
                                    <h6 class="mb-0 fw-bold text-capitalize">{{ $booking->meeting_type }}</h6>
                                </div>
                            </div>

                            <div class="col-12">
                                <div
                                    class="p-4 rounded-4 border border-primary border-opacity-25 bg-primary bg-opacity-10 position-relative overflow-hidden">
                                    <div class="position-absolute end-0 top-0 opacity-25"
                                        style="transform: translate(20%, -20%);">
                                        <i class="fas fa-hand-holding-heart" style="font-size: 8rem;"></i>
                                    </div>

                                    <div class="d-flex align-items-center position-relative">
                                        <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center me-3 shadow-sm"
                                            style="width: 50px; height: 50px; min-width: 50px;">
                                            <i class="fas fa-hand-holding-heart fs-4"></i>
                                        </div>

                                        <div>
                                            <small class="text-light fw-bolder text-uppercase ls-1 d-block mb-1"
                                                style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                                Layanan yang Dipilih
                                            </small>
                                            <h5 class="mb-0 fw-bold text-light">
                                                {{ $booking->service->name ?? 'Layanan Konsultasi' }}
                                            </h5>
                                            <p class="mb-0 small text-light">Sesi Konsultasi Eksklusif</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mt-4 border border-light border-opacity-10 rounded-4 overflow-hidden"
                                    style="background: rgba(255, 255, 255, 0.03);">

                                    {{-- Header Form --}}
                                    <div
                                        class="px-4 py-3 border-bottom border-light border-opacity-10 bg-white bg-opacity-5 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-black fw-bold small">
                                            <i class="fas fa-file-alt me-2 text-info"></i>DETAIL INFORMASI KLIEN
                                        </h6>
                                        @if ($booking->is_followup)
                                            <span class="badge bg-info text-light rounded-pill"
                                                style="font-size: 0.6rem;">SESI LANJUTAN</span>
                                        @endif
                                    </div>

                                    <div class="p-4">
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <label class="text-black small fw-bolder  tracking-widest d-block mb-2"
                                                    style="font-size: 0.4rem; opacity: 0.7;">
                                                    <i class="fas fa-tags me-1"></i> Topik Utama Masalah
                                                </label>

                                                <div class="gap-2 justify-content-start align-items-start">
                                                    @if ($topicNames && count($booking->topics) > 0)
                                                        @foreach ($topicNames as $topic)
                                                            <span
                                                                class="badge rounded-pill bg-warning text-dark px-3 py-2 border border-warning border-opacity-25"
                                                                style="font-size: 0.7rem; font-weight: 600;">
                                                                {{ $topic }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <div
                                                            class="py-2 px-3 rounded-3 bg-light border border-dashed text-muted small">
                                                            <i class="fas fa-info-circle me-1"></i> Tidak ada topik
                                                            spesifik dipilih
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                            {{-- Field: Deskripsi (Grid 6) --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label
                                                        class="text-black small fw-bolder  tracking-widest d-flex align-items-center mb-2"
                                                        style="font-size: 0.6rem;">
                                                        <span class="bg-info rounded-circle me-2"
                                                            style="width: 6px; height: 6px;"></span>
                                                        Deskripsi Keluhan
                                                    </label>
                                                    <div class="p-3 rounded-3 border border-light border-opacity-10 min-vh-10"
                                                        style="background: rgba(0,0,0,0.2); text-align: justify;">
                                                        <p class="text-black small mb-0 lh-base opacity-90">
                                                            {{ $booking->problem_description ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Field: Harapan (Grid 6) --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label
                                                        class="text-black small fw-bolder  tracking-widest d-flex align-items-center mb-2"
                                                        style="font-size: 0.6rem;">
                                                        <span class="bg-warning rounded-circle me-2"
                                                            style="width: 6px; height: 6px;"></span>
                                                        Harapan Klien
                                                    </label>
                                                    <div class="p-3 rounded-3 border border-light border-opacity-10 min-vh-10"
                                                        style="background: rgba(0,0,0,0.2); text-align: justify;">
                                                        <p class="text-black small mb-0 lh-base opacity-90">
                                                            {{ $booking->expectations ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Footer Info --}}
                                            <div class="col-12 mt-3">
                                                <div class="d-flex align-items-center opacity-50">
                                                    <i class="fas fa-info-circle text-black me-2 small"></i>
                                                    <span class="text-black small" style="font-size: 0.7rem;">
                                                        Informasi ini bersifat rahasia dan hanya digunakan untuk
                                                        keperluan medis/konseling.
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary px-4 rounded-3">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    @if ($booking->status == 'pending')
                        <a href="{{ route('bookings.edit', encrypt($booking->id)) }}" class="btn btn-primary px-4 rounded-3">
                            <i class="fas fa-edit me-2"></i>Edit Data
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h6 class="fw-bold mb-0 text-dark">Status Booking</h6>
                    </div>
                    <div class="card-body p-4 text-center">
                        @php
                            $statusColors = [
                                'pending' => 'warning',
                                'confirmed' => 'primary',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                            ];
                            $color = $statusColors[$booking->status] ?? 'secondary';
                        @endphp

                        <div class="display-6 mb-2">
                            @if ($booking->status == 'completed')
                                <i class="fas fa-check-circle text-success"></i>
                            @elseif($booking->status == 'cancelled')
                                <i class="fas fa-times-circle text-danger"></i>
                            @else
                                <i class="fas fa-clock text-warning"></i>
                            @endif
                        </div>
                        <h4 class="text-capitalize fw-bold text-{{ $color }}">{{ $booking->status }}</h4>
                        <p class="text-muted small">Dibuat pada {{ $booking->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                @if ($booking->status == 'confirmed')
                    <div class="mt-4">
                        <small class="text-muted d-block text-center mt-2" style="font-size: 0.7rem;">
                            Apakah Anda bersedia mengammbil sesi ini.
                        </small>
                        <button type="button" class="btn btn-success w-100 rounded-3 fw-bold py-2"
                            data-bs-toggle="modal" data-bs-target="#confirmPaymentModal">
                            <i class="fas fa-check-double me-2"></i>Konfirmasi
                        </button>
                    </div>
                @endif
                <div class="modal fade" id="confirmPaymentModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4">
                            <div class="modal-header border-0 pt-4 px-4">
                                <h5 class="modal-title fw-bold">Konfirmasi Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('sessions.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="modal-body px-4">
                                    <div class="text-center mb-4">
                                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                            style="width: 80px; height: 80px;">
                                            <i class="fas fa-check-double fs-2 text-light"></i>
                                        </div>
                                        <p class="text-muted">Konfirmasi Untuk Membuat Sesi</p>
                                    </div>
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                    <div class="bg-light p-3 rounded-3 mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="small text-muted">Total Tagihan:</span>
                                            <span class="fw-bold">Rp
                                                {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="small text-muted">Metode:</span>
                                            <span
                                                class="small fw-bold text-uppercase">{{ $booking->meeting_type }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pb-4 px-4">
                                    <button type="button" class="btn btn-light rounded-3 px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success rounded-3 px-4 fw-bold">Ya,
                                        Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mt-4 rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 text-dark">Rincian Pembayaran</h6>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Harga Layanan</span>
                            <span class="fw-semibold text-dark">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Biaya Platform ({{ get_setting('default_fee') }}%)</span>
                            <span class="text-danger">- Rp
                                {{ number_format($booking->platform_fee, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Status</span>
                            @php
                                $paymentStatusColors = [
                                    'unpaid' => 'bg-danger',
                                    'paid' => 'bg-success',
                                    'refunded' => 'bg-info text-dark',
                                ];
                                $paymentStatusLabels = [
                                    'unpaid' => 'Belum Bayar',
                                    'paid' => 'Lunas',
                                    'refunded' => 'Dikembalikan',
                                ];
                            @endphp

                            <span
                                class="badge {{ $paymentStatusColors[$booking->payment_status] ?? 'bg-secondary' }} px-3 py-2 rounded-pill shadow-none"
                                style="font-size: 0.75rem;">
                                <i class="fas fa-money-bill-wave me-1"></i>
                                {{ $paymentStatusLabels[$booking->payment_status] ?? ucfirst($booking->payment_status) }}
                            </span>
                        </div>

                        <hr class="my-4 border-dashed">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0 fw-bold">Total Pendapatan</h6>
                                <small class="text-muted">Net Earning</small>
                            </div>
                            <h4 class="mb-0 fw-bolder text-primary">
                                Rp {{ number_format($booking->earning, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-dashed {
            border-top: 1px dashed #dee2e6;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }
    </style>
</x-app-layout>
