<x-app-layout>
    <x-page-header title="Edit Psikolog" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Users', 'route' => 'psychologs.index'],
        ['label' => 'Edit Psikolog'],
    ]" />

    <div class="row">
        {{-- Pastikan ada enctype untuk upload file --}}
        <form action="{{ route('psychologs.update', $psycholog->id) }}" method="POST" enctype="multipart/form-data"
            class="card shadow-sm">
            @csrf
            @method('PUT')

            <div class="card-header bg-white py-3">
                <h4 class="card-title mb-0 text-primary">Perbarui Profil: {{ $psycholog->fullname }}</h4>
            </div>

            <div class="card-body">
                <div class="row g-3">
                    {{-- Relasi & User Selection --}}
                    <div class="col-md-4">
                        <x-form.select name="user_id" label="Pilih User" :options="$users" :selected="$psycholog->user_id"
                            required="true" />
                    </div>
                    <div class="col-md-4">
                        <x-form.select name="wilayah_id" label="Wilayah" :options="$wilayahs" :selected="$psycholog->wilayah_id"
                            required="true" />
                    </div>
                    <div class="col-md-4">
                        <x-form.select name="jenis_psikolog" label="Jenis Psikolog" :options="$types" :selected="$psycholog->jenis_psikolog"
                            required="true" />
                    </div>

                    <div class="col-12">
                        <hr class="my-3 text-muted">
                    </div>

                    {{-- Data Utama --}}
                    <div class="col-md-12">
                        <x-form.input name="fullname" label="Nama Lengkap" required="true" :value="$psycholog->fullname"
                            placeholder="Contoh : Ainun Fahma Yusiarida, M.Psi., Psikolog" />
                    </div>

                    <div class="col-12">
                        <x-form.textarea name="about" value="{{$psycholog->about}}" label="Tentang (About)" required="true" rows="4">
                            {{ old('about', $psycholog->about) }}
                        </x-form.textarea>
                    </div>

                    <div class="col-md-6">
                        <x-form.input name="SIPP" label="Nomor SIPP" :value="$psycholog->SIPP"
                            placeholder="Contoh: 12345-67..." />
                    </div>
                    <div class="col-md-6">
                        <x-form.input name="STR" label="Nomor STR" :value="$psycholog->STR"
                            placeholder="Contoh: STR-9876..." />
                    </div>

                    <div class="col-md-6">
                        <x-form.input-group name="experience_years" label="Pengalaman ( Tahun )" suffix="Tahun"
                            type="number" :value="$psycholog->experience_years" placeholder="0" />
                    </div>
                    <div class="col-md-6">
                        <x-form.input-group name="commision_rate" label="Rate Komisi" suffix="%" type="number"
                            :value="$psycholog->commision_rate" placeholder="0" />
                    </div>

                    <div class="col-12">
                        <hr class="my-3 text-muted">
                    </div>

                    {{-- Status & Verifikasi --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status Verifikasi <span class="text-danger">*</span></label>
                        <select name="verification_status"
                            class="form-select @error('verification_status') is-invalid @enderror">
                            @foreach (['pending' => 'Pending', 'failed' => 'Failed', 'complete' => 'Complete'] as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('verification_status', $psycholog->verification_status) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('verification_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 d-flex align-items-center mt-4">
                        <div
                            class="custom-switch-card {{ old('is_verified', $psycholog->is_verified) ? 'active' : '' }}">
                            <div class="form-check form-switch m-0 d-flex align-items-center">
                                <input class="form-check-input shadow-none cursor-pointer" type="checkbox"
                                    name="is_verified" value="1" id="is_verified"
                                    {{ old('is_verified', $psycholog->is_verified) ? 'checked' : '' }}
                                    onchange="this.closest('.custom-switch-card').classList.toggle('active')">
                                <label class="form-check-label fw-semibold ms-3 cursor-pointer" for="is_verified">
                                    <span class="text-dark d-block">Verifikasi Akun</span>
                                    <small class="text-muted fw-normal">Status saat ini:
                                        {{ $psycholog->is_verified ? 'Aktif' : 'Non-Aktif' }}</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Topics - Pastikan $psycholog->topics mengembalikan array ID --}}
                    <x-form.checkbox-group name="topics" label="Topik Keahlian (Topics)" :options="$topics"
                        :selected="$psycholog->topics->pluck('id')->toArray()" class="mt-4" />

                    {{-- Upload Dokumen dengan Preview --}}
                    <div class="col-md-12 mt-3">
                        <x-form.upload name="document_legal" label="Update Dokumen Legal (STR / SIPP)"
                            helper="Biarkan kosong jika tidak ingin mengubah dokumen" :required="false" />

                        @if ($psycholog->document)
                            <div class="mt-2 p-2 border rounded bg-light d-flex align-items-center">
                                <i class="bi bi-file-check-fill text-success fs-4 me-2"></i>
                                <div class="flex-grow-1">
                                    <small class="text-muted d-block">File saat ini:</small>
                                    <a href="{{ route('documents.show', $psycholog->id) }}" target="_blank"
                                        class="text-decoration-none fw-bold">
                                        Lihat Dokumen Terunggah
                                    </a>
                                </div>
                                <span class="badge bg-success">Sudah Ada</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white py-3 d-flex justify-content-end gap-2">
                <a href="{{ route('psychologs.index') }}" class="btn btn-md btn-outline-secondary px-4">
                    Batal
                </a>
                <button type="submit" class="btn btn-md btn-primary px-4 shadow-sm">
                    <i class="icon-save me-1"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<style>
    /* Style tetap sama dengan versi create */
    .custom-switch-card {
        width: 100%;
        padding: 12px 20px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    .custom-switch-card.active {
        border-color: #0d6efd;
        background-color: #f0f7ff;
    }

    .form-check-input {
        width: 2.5em !important;
        height: 1.25em !important;
        cursor: pointer;
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>
