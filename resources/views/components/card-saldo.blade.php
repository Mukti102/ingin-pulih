@if ($psycholog->wallet)
    <div class="card card-wallet p-4 p-md-5 shadow-lg text-white">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <p class="text-white-50 small fw-bold text-uppercase tracking-widest mb-1" style="font-size: 0.7rem;">
                    Total Saldo
                </p>
                <h2 class="display-6 font-black fst-italic mb-0">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </h2>
            </div>
            <i class="fas fa-wallet fs-3 text-primary"></i>
        </div>

        <div class="pt-4 border-top border-secondary border-opacity-25">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-white-50 text-uppercase font-black tracking-widest" style="font-size: 0.65rem;">
                    Rekening Tujuan
                </span>
                <span class="small fw-bold">
                    {{ $psycholog->wallet->bank_name ?? 'Belum diatur' }}
                </span>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-white-50 text-uppercase font-black tracking-widest" style="font-size: 0.65rem;">
                    Nomor Rekening
                </span>
                <span class="small fw-bold tracking-widest">
                    {{ $psycholog->wallet->account_number ?? '-' }}
                </span>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <span class="text-white-50 text-uppercase font-black tracking-widest" style="font-size: 0.65rem;">
                    Atas Nama
                </span>
                <span class="small fw-bold">
                    {{ $psycholog->wallet->account_holder_name ?? '-' }}
                </span>
            </div>
        </div>

        @if (!$psycholog->wallet->bank_name || !$psycholog->wallet->account_number)
            {{-- Alert jika data bank belum lengkap --}}
            <div class="alert alert-danger rounded-4 border-0 shadow-sm mt-4 p-3"
                style="background-color: rgba(239, 68, 68, 0.1); border: 1px dashed #ef4444 !important;">
                <div class="d-flex gap-3 align-items-center">
                    <i class="fas fa-exclamation-triangle text-danger fs-4"></i>
                    <div>
                        <p class="mb-0 text-danger fw-bold" style="font-size: 0.75rem;">Rekening Belum Diatur</p>
                        <p class="mb-0 text-white-50" style="font-size: 0.65rem;">Silakan lengkapi data perbankan Anda
                            di
                            menu profil untuk melakukan penarikan.</p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="btn btn-danger btn-sm w-100 rounded-3 mt-3 fw-bold text-uppercase tracking-widest"
                    style="font-size: 0.6rem;">
                    Atur Rekening Sekarang
                </a>
            </div>
        @else
            {{-- Tombol Tarik Saldo jika data bank sudah ada --}}
            <button
                class="btn bg-brand text-white w-100 py-3 rounded-4 mt-4 text-uppercase fw-bolder tracking-widest transition-all shadow-sm"
                style="font-size: 0.75rem;" data-bs-toggle="modal" data-bs-target="#withdrawModal"
                {{ $saldo <= 0 ? 'disabled' : '' }}>
                Tarik Saldo
            </button>
        @endif
        <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow">
                    <div class="modal-header border-0 pt-4 px-4">
                        <h5 class="modal-title fw-black italic text-uppercase tracking-widest" id="withdrawModalLabel"
                            style="font-size: 0.9rem;">
                            Konfirmasi Penarikan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('withdraw') }}" method="POST">
                        @csrf
                        <div class="modal-body px-4 pb-4">
                            <div class="p-3 rounded-4 bg-light mb-4 border border-dashed">
                                <p class="text-muted mb-2 font-black text-uppercase"
                                    style="font-size: 0.6rem; letter-spacing: 2px;">Rekening Tujuan</p>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-white p-2 rounded-3 shadow-sm">
                                        <i class="fas fa-university text-brand"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-muted">{{ $psycholog->wallet->bank_name }}</h6>
                                        <p class="mb-0 small text-muted">{{ $psycholog->wallet->account_number }} a/n
                                            {{ $psycholog->wallet->account_holder_name }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label font-black text-uppercase text-muted"
                                    style="font-size: 0.6rem;">Nominal Penarikan</label>
                                <div class="input-group">
                                    <span
                                        class="input-group-text bg-white border-end-0 rounded-start-4 fw-bold">Rp</span>
                                    <input type="number" name="amount"
                                        class="form-control border-start-0 rounded-end-4 py-3 fw-bold" min="10000"
                                        max="{{ $saldo }}" placeholder="Contoh: 50000" required>
                                </div>
                                <div class="form-text italic" style="font-size: 0.7rem;">
                                    Maksimal penarikan: <span class="fw-bold">Rp
                                        {{ number_format($saldo, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="alert alert-warning rounded-4 border-0 shadow-sm mb-0"
                                style="font-size: 0.75rem;">
                                <div class="d-flex gap-2">
                                    <i class="fas fa-info-circle mt-1"></i>
                                    <span>Proses pencairan dana membutuhkan waktu 1-3 hari kerja. Pastikan data rekening
                                        sudah benar.</span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0 px-4 pb-4">
                            <button type="button" class="btn btn-light rounded-3 px-4 fw-bold text-uppercase"
                                data-bs-dismiss="modal" style="font-size: 0.7rem;">Batal</button>
                            <button type="submit"
                                class="btn bg-brand text-white rounded-3 px-4 fw-bold text-uppercase shadow-sm"
                                style="font-size: 0.7rem;">
                                Proses Sekarang <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif


<style>
    .card-wallet {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-radius: 1rem !important;
        border: none;
    }

    .text-brand {
        color: #8d94ff;
        /* Sesuaikan dengan warna brand Anda */
    }

    .bg-brand {
        background-color: #8d94ff;
        border: none;
    }

    .bg-brand:hover {
        background-color: #7a81e0;
    }

    .tracking-widest {
        letter-spacing: 0.1em;
    }

    .font-black {
        font-weight: 900;
    }
</style>
