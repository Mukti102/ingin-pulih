<x-app-layout>
    <x-page-header title="Tambah Psikolog" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Users', 'route' => 'psychologs.index'],
        ['label' => 'Tambah Psikolog'],
    ]" />

    <div class="row">
        <form enctype="multipart/form-data" action="{{ route('psychologs.store') }}" method="POST" class="card shadow-sm">
            @csrf
            <div class="card-header bg-white py-3">
                <h4 class="card-title mb-0 text-primary">Informasi Profil Psikolog</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    {{-- Relasi & User Selection --}}
                    <div class="col-md-4">
                        <x-form.select name="user_id" label="Pilih User" :options="$users" required="true" />
                    </div>
                    <div class="col-md-4">
                        <x-form.select name="wilayah_id" label="Wilayah" :options="$wilayahs" required="true" />
                    </div>
                    <div class="col-md-4">
                        <x-form.select name="jenis_psikolog" label="Jenis Psikolog" :options="$types" required="true" />
                    </div>

                    <div class="col-12">
                        <hr class="my-3 text-muted">
                    </div>

                    {{-- Data Utama --}}
                    <div class="col-md-12">
                        <x-form.input name="fullname" label="Nama Lengkap" required="true"
                            placeholder="Contoh : Ainun Fahma Yusiarida, M.Psi., Psikolog" />
                    </div>

                    <div class="col-12">
                        <x-form.textarea name="about" label="Tentang (About)" required="true" rows="4" />
                    </div>

                    <div class="col-md-6">
                        <x-form.input name="SIPP" label="Nomor SIPP" required="false"
                            placeholder="Contoh: 12345-67..." />
                    </div>
                    <div class="col-md-6">
                        <x-form.input name="STR" label="Nomor STR" required="false"
                            placeholder="Contoh: STR-9876..." />
                    </div>

                    <div class="col-md-6">

                        <x-form.input-group name="experience_years" label="Pengalaman ( Tahun )" suffix="Tahun"
                            type="number" placeholder="0" />
                    </div>
                    <div class="col-md-6">
                        <x-form.input-group name="commision_rate" label="Rate Komisi" suffix="%" type="number"
                            placeholder="0" />
                    </div>

                    <div class="col-12">
                        <hr class="my-3 text-muted">
                    </div>

                    {{-- Status & Verifikasi --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status Verifikasi <span class="text-danger">*</span></label>
                        <select name="verification_status"
                            class="form-select @error('verification_status') is-invalid @enderror">
                            <option value="pending" {{ old('verification_status') == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="failed" {{ old('verification_status') == 'failed' ? 'selected' : '' }}>
                                Failed</option>
                            <option value="complete" {{ old('verification_status') == 'complete' ? 'selected' : '' }}>
                                Complete</option>
                        </select>
                        @error('verification_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6  d-flex align-items-center mt-4">
                        <div class="custom-switch-card  {{ old('is_verified') ? 'active' : '' }}">
                            <div class="form-check form-switch m-0 d-flex align-items-center">
                                <input class="form-check-input shadow-none cursor-pointer" type="checkbox"
                                    name="is_verified" value="1" id="is_verified"
                                    {{ old('is_verified') ? 'checked' : '' }}
                                    onchange="this.closest('.custom-switch-card').classList.toggle('active')">
                                <label class="form-check-label fw-semibold ms-3 cursor-pointer" for="is_verified">
                                    <span class="text-dark d-block">Verifikasi Akun</span>
                                    <small class="text-muted fw-normal">Aktifkan untuk memberikan status
                                        terverifikasi</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <x-form.checkbox-group name="topics" label="Topik Keahlian (Topics)" :options="$topics"
                        class="mt-4" />

                    {{-- upload  Upload dokumen legal (STR / SIPP)  --}}
                    <div class="col-md-12 mt-3">
                        <x-form.upload name="document_legal" label="Upload Dokumen Legal (STR / SIPP)"
                            helper="Pastikan dokumen masih berlaku (PDF/JPG)" required="true" />
                    </div>

                </div>
            </div>

            <div class="card-footer bg-white py-3 d-flex justify-content-end gap-2">
                <a href="{{ route('psychologs.index') }}" class="btn btn-md btn-outline-secondary px-4">
                    Batal
                </a>
                <button type="submit" class="btn btn-md btn-success px-4 shadow-sm">
                    <i class="icon-save me-1"></i> Simpan Data Psikolog
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<style>
    .custom-switch-card {
        width: 100%;
        padding: 12px 20px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    /* State saat checkbox dicentang */
    .custom-switch-card.active {
        border-color: #0d6efd;
        background-color: #f0f7ff;
    }

    /* Memperbesar Switch agar lebih mudah diklik */
    .form-check-input {
        width: 2.5em !important;
        height: 1.25em !important;
        cursor: pointer;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    /* Menghilangkan outline biru standar bootstrap */
    .form-check-input:focus {
        border-color: #dee2e6;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
    }
</style>
