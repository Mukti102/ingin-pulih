@props([
    'psycholog' => null,
])

{{-- tombol verifikasi document dan verifikasi data psikolog --}}
<div class="card shadow-sm mt-4">
    <div class="card-header bg-white border-0 pb-0">
        <h6 class="fw-bold mb-0">Action Verifikasi</h6>
    </div>
    <div class="card-body">
        <div class="d-grid gap-2">
            @if (!$psycholog->is_verified)
                <button type="button" class="btn btn-success w-100" data-bs-toggle="modal"
                    data-bs-target="#modalVerifyAccount">
                    <i class="icon-check-circle me-1"></i> Verifikasi Akun
                </button>
            @endif

            <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                data-bs-target="#modalUpdateStatus">
                <i class="icon-file-text me-1"></i> Update Status Dokumen
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVerifyAccount" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('psycholog.verified', encrypt($psycholog->id)) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body text-center py-4">
                    <i class="icon-shield text-success display-1 mb-3"></i>
                    <h5>Konfirmasi Verifikasi</h5>
                    <p class="text-muted">Apakah Anda yakin ingin memverifikasi akun
                        <strong>{{ $psycholog->fullname }}</strong>? Ini akan memberikan tanda centang verifikasi pada
                        profil mereka.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center pt-0">
                    <button type="button" class="btn btn-link text-muted me-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Ya, Verifikasi Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpdateStatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('document.verified', encrypt($psycholog->id)) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Update Status Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Status Baru</label>
                        <select name="verification_status" class="form-select">
                            <option value="complete">Complete (Dokumen
                                Valid)</option>
                            <option value="failed">
                                Failed (Dokumen Tidak Valid/Ditolak)</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">Catatan (Opsional)</label>
                        <div>
                            <textarea cols="100" name="note" class="form-textarea form-control" rows="3"
                                placeholder="Contoh: Foto STR kurang jelas..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
