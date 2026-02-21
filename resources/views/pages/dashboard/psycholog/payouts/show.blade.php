<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('payouts.index') }}">Daftar Payout</a></li>
                        <li class="breadcrumb-item active">Detail #{{ $payout->id }}</li>
                    </ol>
                </nav>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div
                        class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Detail Permintaan Penarikan</h5>
                        <span
                            class="badge rounded-pill 
                            {{ $payout->status == 'approved' ? 'bg-success' : ($payout->status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }} px-3 py-2 text-uppercase">
                            {{ $payout->status }}
                        </span>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <p class="text-muted small text-uppercase fw-bold mb-1">Jumlah Penarikan</p>
                                <h3 class="fw-black text-primary">Rp {{ number_format($payout->amount, 0, ',', '.') }}
                                </h3>
                                <p class="text-muted small italic">Diajukan pada:
                                    {{ $payout->created_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>

                            <div class="col-md-6">
                                <p class="text-muted small text-uppercase fw-bold mb-1">Psikolog</p>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light p-2 rounded-circle">
                                        <i class="fas fa-user-md text-secondary"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold">{{ $payout->psycholog->fullname }}</h6>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="opacity-50">
                            </div>

                            <div class="col-12">
                                <h6 class="fw-bold mb-3"><i class="fas fa-university me-2 text-primary"></i>Rekening
                                    Tujuan Pembayaran</h6>
                                <div class="bg-light p-3 rounded-4 border border-dashed">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="text-muted small mb-0">Bank</p>
                                            <p class="fw-bold mb-0">{{ $payout->psycholog->wallet->bank_name ?? 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="text-muted small mb-0">Nomor Rekening</p>
                                            <p class="fw-bold mb-0 tracking-widest">
                                                {{ $payout->psycholog->wallet->account_number ?? '-' }}</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="text-muted small mb-0">Nama Pemilik</p>
                                            <p class="fw-bold mb-0">
                                                {{ $payout->psycholog->wallet->account_holder_name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($payout->status == 'rejected')
                                <div class="col-12">
                                    <p class="text-muted small text-uppercase fw-bold mb-2">Alasan Penolakan</p>
                                    <p class="fw-medium mb-0 fs-6 fst-italic">"{{ $payout->reject_reason ?? '-' }}"</p>
                                </div>
                            @endif

                            @if ($payout->approve_document)
                                <div class="col-12">
                                    <p class="text-muted small text-uppercase fw-bold mb-2">Bukti Transfer</p>
                                    <a href="{{ Storage::url($payout->approve_document) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm rounded-3">
                                        <i class="fas fa-file-download me-1"></i> Lihat Dokumen
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($payout->status == 'pending' || $payout->status == 'rejected' && auth()->user()->hasRole('admin'))
                        <div class="card-footer bg-white border-0 p-4 d-flex gap-2 justify-content-end">
                            <button class="btn btn-outline-danger px-4 rounded-3 fw-bold" data-bs-toggle="modal"
                                data-bs-target="#rejectModal">Reject</button>
                            <button class="btn btn-success px-4 rounded-3 fw-bold shadow-sm" data-bs-toggle="modal"
                                data-bs-target="#approveModal">
                                <i class="fas fa-check-circle me-1"></i>
                                & Upload Bukti
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <form action="{{ route('payouts.reject', encrypt($payout->id)) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header border-0 pt-4 px-4">
                        <h5 class="modal-title fw-bold text-danger">Tolak Penarikan Saldo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="alert alert-danger rounded-4 border-0 small mb-4">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Peringatan: Saldo yang ditolak harus dikembalikan ke wallet psikolog
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Alasan Penolakan</label>
                            <textarea name="rejection_reason" class="form-control rounded-3" rows="4"
                                placeholder="Contoh: Nomor rekening tidak ditemukan atau data bank tidak sesuai dengan nama pemilik." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light rounded-3 px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-3 px-4 fw-bold">Konfirmasi Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <form action="{{ route('payouts.approve', encrypt($payout->id)) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header border-0 pt-4 px-4">
                        <h5 class="modal-title fw-bold">Approve Pengajuan </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <p class="small text-muted mb-4">Pastikan Anda telah melakukan transfer ke rekening psikolog
                            sebesar <strong>Rp {{ number_format($payout->amount, 0, ',', '.') }}</strong> sebelum
                            menyetujui.</p>


                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase">Upload Bukti Transfer
                                (PDF/JPG/PNG)</label>
                            <input type="file" name="approve_document" class="form-control rounded-3" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success rounded-3 px-4 fw-bold">Konfirmasi
                            Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
