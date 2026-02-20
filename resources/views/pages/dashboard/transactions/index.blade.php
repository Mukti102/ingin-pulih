<x-app-layout>
    <x-page-header title="Transaksi Management" :breadcrumbs="[['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'], ['label' => 'Transaksi']]" />

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0 fw-bold text-brand-900">Daftar Transaksi</h5>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase small fw-black text-muted">ID Transaksi</th>
                                    <th class="py-3 text-uppercase small fw-black text-muted">Klien & Psikolog</th>
                                    <th class="py-3 text-uppercase small fw-black text-muted">Total Bayar</th>
                                    <th class="py-3 text-uppercase small fw-black text-muted">Status</th>
                                    <th class="py-3 text-uppercase small fw-black text-muted">Tanggal</th>
                                    <th class="pe-4 py-3 text-center text-uppercase small fw-black text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td class="ps-4">
                                            <span class="fw-bold text-dark">#{{ $transaction->reference_id }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold">{{ $transaction->booking->user->name ?? 'User' }}</span>
                                                <small class="text-muted">Psikolog: {{ $transaction->booking->psycholog->fullname }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-brand-700">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'settlement' => 'bg-success-subtle text-success',
                                                    'capture'    => 'bg-success-subtle text-success',
                                                    'pending'    => 'bg-warning-subtle text-warning',
                                                    'expire'     => 'bg-danger-subtle text-danger',
                                                    'cancel'     => 'bg-secondary-subtle text-secondary',
                                                ];
                                                $class = $statusClasses[$transaction->status] ?? 'bg-light text-dark';
                                            @endphp
                                            <span class="badge rounded-pill px-3 py-2 {{ $class }}">
                                                {{ strtoupper($transaction->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $transaction->created_at->format('d M Y, H:i') }}</small>
                                        </td>
                                        <td class="pe-4 text-center">
                                            <a href="{{route('transactions.show',encrypt($transaction->id))}}" class="btn btn-sm btn-outline-primary rounded-3 shadow-none" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <img src="{{ asset('assets/images/empty-state.svg') }}" alt="Empty" class="mb-3" style="width: 120px;">
                                            <p class="text-muted">Belum ada data transaksi masuk.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>