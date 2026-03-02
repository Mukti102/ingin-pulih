<x-app-layout>
    <x-page-header title="Detail Transaksi #{{ $transaction->reference_id }}" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Transaksi', 'route' => 'transactions.index'],
        ['label' => 'Detail'],
    ]" />

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold text-brand-900 mb-0 text-uppercase tracking-wider">Status Pembayaran</h5>
                        @php
                            $statusMap = [
                                'settlement' => ['class' => 'bg-success', 'label' => 'Berhasil'],
                                'pending' => ['class' => 'bg-warning', 'label' => 'Menunggu Pembayaran'],
                                'expire' => ['class' => 'bg-danger', 'label' => 'Kadaluarsa'],
                                'cancel' => ['class' => 'bg-secondary', 'label' => 'Dibatalkan'],
                            ];
                            $curr = $statusMap[$transaction->status] ?? [
                                'class' => 'bg-dark',
                                'label' => $transaction->status,
                            ];
                        @endphp
                        <span
                            class="badge {{ $curr['class'] }} px-3 py-2 rounded-pill">{{ strtoupper($curr['label']) }}</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="small text-muted d-block text-uppercase fw-bold">ID Transaksi Midtrans</label>
                            <p class="fw-semibold text-dark">{{ $transaction->transaction_id ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted d-block text-uppercase fw-bold">Metode Pembayaran</label>
                            <p class="fw-semibold text-dark">
                                <span class="badge bg-light text-dark border px-2 py-1">
                                    {{ strtoupper(str_replace('_', ' ', $transaction->payment_type ?? 'Belum Memilih')) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted d-block text-uppercase fw-bold">Waktu Transaksi</label>
                            <p class="fw-semibold text-dark">{{ $transaction->created_at->format('d F Y, H:i') }} WIB
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted d-block text-uppercase fw-bold">Nominal Pembayaran</label>
                            <h4 class="fw-bold text-brand-600">Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            @if ($transaction->payload_notification)
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-code me-2"></i>Technical Log (Midtrans Payload)</h6>
                    </div>
                    <div class="card-body p-0">
                        <pre class="bg-dark text-success p-3 mb-0"
                            style="max-height: 200px; overflow-y: auto; font-size: 12px; white-space: pre-wrap; word-break: break-all;"><code>{{ json_encode($transaction->payload_notification, JSON_PRETTY_PRINT) }}</code></pre>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-brand-900 py-3 rounded-top-4">
                    <h6 class="mb-0 text-white fw-bold">Ringkasan Layanan</h6>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="avatar avatar-xl mb-3">
                            <img src="{{ $transaction->booking->psycholog->user->avatar ? Storage::url($transaction->booking->psycholog->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($transaction->booking->psycholog->fullname) }}"
                                class="rounded-circle border-3 border-brand-100" width="80">
                        </div>
                        <h6 class="fw-bold mb-0">{{ $transaction->booking->psycholog->fullname }}</h6>
                        <small
                            class="badge bg-soft-brand text-brand-700">{{ $transaction->booking->service->name }}</small>
                    </div>

                    <hr class="opacity-25">

                    <div class="space-y-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Klien:</span>
                            <span class="small fw-bold">{{ $transaction->booking->user->name }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Tanggal Sesi:</span>
                            <span
                                class="small fw-bold">{{ \Carbon\Carbon::parse($transaction->booking->session_date)->format('d M Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Jam:</span>
                            <span class="small fw-bold text-brand-600">{{ $transaction->booking->start_time }} -
                                {{ $transaction->booking->end_time }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Tipe:</span>
                            <span
                                class="badge bg-soft-brand text-brand-700">{{ strtoupper($transaction->booking->meeting_type) }}</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('bookings.show', encrypt($transaction->booking_id)) }}"
                            class="btn btn-brand-600 w-100 rounded-3 fw-bold">
                            Lihat Detail Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-brand-900 {
            color: #4c1d95 !important;
        }

        .bg-brand-900 {
            background-color: #4c1d95 !important;
        }

        .text-brand-600 {
            color: #9333ea !important;
        }

        .btn-brand-600 {
            background-color: #9333ea;
            color: white;
            border: none;
        }

        .btn-brand-600:hover {
            background-color: #7e22ce;
            color: white;
        }

        .bg-brand-100 {
            background-color: #f3e8ff !important;
        }

        .bg-soft-brand {
            background-color: #f3e8ff;
        }

        .text-brand-700 {
            color: #7e22ce;
        }

        .avatar-xl img {
            height: 80px;
            width: 80px;
            object-fit: cover;
        }
    </style>
</x-app-layout>
