<x-app-layout>
    <x-page-header title="Detail Psikolog" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Users', 'route' => 'psychologs.index'],
        ['label' => 'Detail Psikolog'],
    ]" />

    <div class="row">
        <div class="col-md-4">
            {{-- Profil Ringkas --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center py-4">
                    <div class="mb-3">
                        <img src="{{ $psycholog->user->avatar_url ?? asset('assets/images/default-avatar.png') }}"
                            class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h5 class="fw-bold mb-1">{{ $psycholog->fullname }}</h5>
                    <p class="text-muted small mb-3">{{ $psycholog->jenisPsikolog->name }}</p>

                    @php
                        $statusColor =
                            [
                                'pending' => 'warning',
                                'failed' => 'danger',
                                'complete' => 'success',
                            ][$psycholog->verification_status] ?? 'secondary';
                    @endphp
                    <span class="badge bg-{{ $statusColor }} text-light px-3 py-2 rounded-pill">
                        <i class="icon-check-circle me-1"></i>
                        {{ $psycholog->verification_status == 'complete' ? 'Terverikasi' : 'Belum Terverifikasi' }}
                    </span>


                </div>
            </div>

            {{-- Status Verifikasi Card --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0">
                    <h6 class="fw-bold mb-0">Status Verifikasi</h6>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-between my-2">
                        <span class="text-muted">Status Dokumen:</span>
                        <span
                            class="badge bg-{{ $psycholog->document->is_verified ? 'success' : 'warning' }}">{{ $psycholog->document->is_verified ? 'Terverifikasi' : 'Pending' }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Rate Komisi:</span>
                    </div>
                </div>
            </div>
            <x-card-verification :psycholog="$psycholog" />
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0 text-primary">Informasi Lengkap</h4>
                    <a href="{{ route('psychologs.edit', $psycholog->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="icon-edit me-1"></i> Edit Profil
                    </a>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        {{-- Data Profesional --}}
                        <div class="col-md-6">
                            <label class="text-muted small d-block mb-1">Nomor SIPP</label>
                            <p class="fw-semibold text-dark">{{ $psycholog->SIPP ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small d-block mb-1">Nomor STR</label>
                            <p class="fw-semibold text-dark">{{ $psycholog->STR ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small d-block mb-1">Pengalaman</label>
                            <p class="fw-semibold text-dark">{{ $psycholog->experience_years }} Tahun</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small d-block mb-1">Wilayah Tugas</label>
                            <p class="fw-semibold text-dark">{{ $psycholog->wilayah->name ?? '-' }}</p>
                        </div>

                        <div class="col-12">
                            <hr class="my-2 opacity-25">
                        </div>

                        {{-- About --}}
                        <div class="col-12">
                            <label class="text-muted small d-block mb-2">Tentang (About)</label>
                            <div class="p-3 bg-light rounded shadow-none">
                                {!! nl2br(e($psycholog->about)) !!}
                            </div>
                        </div>

                        {{-- Topics --}}
                        <div class="col-12">
                            <label class="text-muted small d-block mb-2">Topik Keahlian</label>
                            <div class="d-flex flex-wrap gap-2">
                                @forelse($psycholog->topics as $topic)
                                    <span class="badge bg-soft-primary text-primary border border-primary px-3">
                                        {{ $topic->name }}
                                    </span>
                                @empty
                                    <span class="text-muted small italic">Tidak ada topik dipilih</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Dokumen --}}
                        <div class="col-12">
                            <label class="text-muted small d-block mb-2">Dokumen Legal</label>
                            @if ($psycholog->document->file_path)
                                <div class="d-flex align-items-center p-3 border rounded">
                                    <i class="icon-file-text fs-2 text-danger me-3"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Dokumen_Legal_{{ Str::slug($psycholog->fullname) }}</h6>
                                        <small class="text-muted">Klik untuk melihat atau mengunduh dokumen</small>
                                    </div>
                                    <a href="{{ route('documents.show', $psycholog->id) }}" target="_blank"
                                        class="btn btn-sm btn-primary">
                                        Lihat File
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-light border text-center">
                                    Dokumen belum diunggah.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <a href="{{ route('psychologs.index') }}" class="btn btn-outline-secondary">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .bg-soft-primary {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .bg-light-success {
        background-color: #d1e7dd;
    }

    .bg-light-secondary {
        background-color: #f8f9fa;
    }
</style>
