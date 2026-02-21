<x-app-layout>
    <x-page-header title="Detail Sesi Konsultasi" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Sesi', 'route' => 'sessions.index'],
        ['label' => 'Sesi #' . $session->booking->code],
    ]" />

    <div class="container-fluid pb-5">
        <div class="row">
            <div class="col-lg-8">
                @if ($session->status == 'active')
                    <div class="alert alert-primary border-0 shadow-sm rounded-4 d-flex align-items-center mb-4"
                        role="alert">
                        <div class="spinner-grow spinner-grow-sm text-success me-3" role="status"></div>
                        <div>
                            <strong class="d-block">Sesi sedang berlangsung</strong>
                            <small>Pastikan Anda mencatat poin-poin penting dalam sesi ini.</small>
                        </div>
                    </div>
                @endif
                @if (!$session->room)
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-5 text-center">
                            <div class="bg-light text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 80px; height: 80px;">
                                <i class="fas fa-video-slash fs-2"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Link Pertemuan Belum Dibuat</h5>
                            <p class="text-muted small mb-4">Room untuk sesi ini belum tersedia. Silakan buat link
                                pertemuan terlebih dahulu agar klien dapat bergabung.</p>
                            <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal"
                                data-bs-target="#addRoomModal">
                                <i class="fas fa-plus-circle me-2"></i>Buat Link Pertemuan
                            </button>
                        </div>
                    </div>
                @else
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0 fw-bold"><i class="fas fa-video me-2 text-primary"></i>Link Pertemuan
                                </h5>
                                <div class="d-flex align-items-center gap-2">
                                    <span
                                        class="badge bg-light text-dark border fw-medium text-uppercase">{{ $session->room->provider }}</span>
                                    <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="modal"
                                        data-bs-target="#addRoomModal">
                                        <i class="fas fa-edit text-muted"></i>
                                    </button>
                                </div>
                            </div>

                            <div
                                class="p-4 rounded-4 border-2 border-dashed border-primary bg-primary bg-opacity-5 text-center">
                                @if ($session->room->meeting_link)
                                    <h6 class=" text-light mb-2 small">Room Code: <span
                                            class="fw-bold">{{ $session->room->room_code }}</span></h6>
                                    <a href="{{ $session->room->meeting_link }}" target="_blank"
                                        class="btn btn-info px-5 rounded-pill shadow">
                                        <i class="fas fa-external-link-alt me-2"></i>Gabung Sesi Sekarang
                                    </a>
                                @else
                                    <p class="text-muted mb-0">Link pertemuan ditemukan namun data tidak valid.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="modal fade" id="addRoomModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4">
                            <div class="modal-header border-0 pt-4 px-4">
                                <h5 class="modal-title fw-bold">Konfigurasi Link Pertemuan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('session.create.room', $session->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body px-4">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-muted">PROVIDER</label>
                                        <select name="provider" class="form-select rounded-3">
                                            <option value="zoom"
                                                {{ optional($session->room)->provider == 'zoom' ? 'selected' : '' }}>
                                                Zoom Meeting</option>
                                            <option value="google meet"
                                                {{ optional($session->room)->provider == 'google meet' ? 'selected' : '' }}>
                                                Google Meet</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-muted">ROOM CODE / ID</label>
                                        <input type="text" name="room_code" class="form-control rounded-3"
                                            placeholder="Contoh: ZM-12345" value="{{ $session->room->room_code ?? '' }}"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-muted">MEETING LINK (URL)</label>
                                        <input type="url" name="meeting_link" class="form-control rounded-3"
                                            placeholder="https://zoom.us/j/..."
                                            value="{{ $session->room->meeting_link ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pb-4 px-4">
                                    <button type="button" class="btn btn-light rounded-pill px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan
                                        Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-file-alt me-2 text-info"></i>Catatan Sesi
                        </h5>

                        @if (!$session->notes)
                            <button class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal"
                                data-bs-target="#addNoteModal">
                                <i class="fas fa-plus me-1"></i> Tambah Catatan
                            </button>
                        @else
                            <button class="btn btn-sm btn-light text-primary rounded-pill border" data-bs-toggle="modal"
                                data-bs-target="#addNoteModal">
                                <i class="fas fa-edit me-1"></i> Edit Catatan
                            </button>
                        @endif
                        <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow rounded-4">
                                    <div class="modal-header border-0 pt-4 px-4">
                                        <h5 class="modal-title fw-bold" id="addNoteModalLabel">
                                            <i class="fas fa-edit me-2 text-primary"></i>
                                            {{ $session->notes ? 'Edit Catatan Sesi' : 'Tambah Catatan Sesi' }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('create.note', $session->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <div class="modal-body px-4">
                                            <div class="mb-4">
                                                <label for="notes"
                                                    class="form-label small fw-bold text-muted text-uppercase">Isi
                                                    Catatan Konsultasi</label>
                                                <textarea name="notes" id="notes" class="form-control rounded-3 @error('notes') is-invalid @enderror"
                                                    rows="8" placeholder="Tuliskan hasil observasi, diagnosa sementara, atau saran untuk klien..." required>{{ old('notes', $session->note->notes ?? '') }}</textarea>
                                                @error('notes')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label for="document_path"
                                                    class="form-label small fw-bold text-muted text-uppercase">Lampiran
                                                    Dokumen (Opsional)</label>
                                                <input type="file" name="document_path" id="document_path"
                                                    class="form-control rounded-3 @error('document_path') is-invalid @enderror">
                                                <div class="form-text mt-2">
                                                    <i class="fas fa-info-circle me-1"></i> Format: PDF, JPG, PNG
                                                    (Maks. 2MB).
                                                </div>
                                                @error('document_path')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            @if ($session->note && $session->note->document_path)
                                                <div
                                                    class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between border">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                                                        <div>
                                                            <p class="mb-0 small fw-bold text-dark">Dokumen Saat Ini
                                                            </p>
                                                            <a href="{{ asset('storage/' . $session->note->document_path) }}"
                                                                target="_blank" class="small text-decoration-none">
                                                                Lihat Lampiran <i class="fas fa-external-link-alt ms-1"
                                                                    style="font-size: 0.7rem;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <span
                                                        class="badge bg-info-subtle text-info rounded-pill px-3">Sudah
                                                        Tersedia</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="modal-footer border-0 pb-4 px-4">
                                            <button type="button" class="btn btn-light rounded-pill px-4"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit"
                                                class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                                                <i class="fas fa-save me-2"></i> Simpan Catatan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if ($session->note)
                            <div class="bg-light mb-3 p-4 rounded-4 border-start border-4 border-info">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-info text-white rounded-circle p-2 me-3"
                                        style="width: 40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">
                                            {{ $session->note->psycholog->fullname ?? 'Psikolog' }}
                                        </h6>
                                        <small class="text-muted">Ditulis pada
                                            {{ $session->note->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                </div>
                                <div class="text-dark mb-10 lh-base">
                                    {!! nl2br(e($session->note->notes)) !!}
                                </div>
                            </div>
                            @if ($session->note && $session->note->document_path)
                                <div
                                    class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between border">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                                        <div>
                                            <p class="mb-0 small fw-bold text-dark">Dokumen Saat Ini
                                            </p>
                                            <a href="{{ asset('storage/' . $session->note->document_path) }}"
                                                target="_blank" class="small text-decoration-none">
                                                Lihat Lampiran <i class="fas fa-external-link-alt ms-1"
                                                    style="font-size: 0.7rem;"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="badge bg-info-subtle text-info rounded-pill px-3">Sudah
                                        Tersedia</span>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <img src="{{ asset('assets/img/no-notes.svg') }}" alt="No Notes"
                                    style="width: 120px;" class="opacity-25 mb-3">
                                <p class="text-muted mb-0">Belum ada catatan untuk sesi ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 text-center">
                        <label class="small text-muted text-uppercase fw-bold d-block mb-3">Status Sesi</label>
                        @php
                            $sessionStatuses = [
                                'pending' => [
                                    'color' => 'warning',
                                    'icon' => 'far fa-calendar-alt',
                                ],
                                'completed' => ['color' => 'success', 'icon' => 'fas fa-check-double'],
                            ];
                            $current = $sessionStatuses[$session->status] ?? [
                                'color' => 'secondary',
                                'icon' => 'fa-info',
                            ];
                        @endphp
                        <div class="bg-{{ $current['color'] }} bg-opacity-10 text-{{ $current['color'] }} rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 70px; height: 70px;">
                            <i class="{{ $current['icon'] }} fs-2 text-light"></i>
                        </div>
                        <h4 class="fw-bold text-capitalize">{{ $session->status }}</h4>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 text-dark">Informasi Waktu</h6>
                        <div class="timeline-simple">
                            <div class="d-flex mb-4">
                                <div class="me-3 text-primary"><i class="fas fa-play-circle"></i></div>
                                <div>
                                    <small class="text-muted d-block">Mulai Sesi</small>
                                    <span
                                        class="fw-bold">{{ $session->started_at ? $session->started_at->format('H:i, d M Y') : 'Belum dimulai' }}</span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-3 text-success"><i class="fas fa-flag-checkered"></i></div>
                                <div>
                                    <small class="text-muted d-block">Selesai Sesi</small>
                                    <span
                                        class="fw-bold">{{ $session->ended_at ? $session->ended_at->format('H:i, d M Y') : 'Sesi Aktif' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mt-4 bg-dark text-white overflow-hidden">
                    <div class="card-body p-4">
                        <h6 class="small text-uppercase fw-bold opacity-50 mb-3">Informasi Klien</h6>
                        <h5 class="mb-1 fw-bold">{{ $session->booking->user->name }}</h5>
                        <p class="small mb-0 opacity-75"><i class="far fa-envelope me-1"></i>
                            {{ $session->booking->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .border-dashed {
        border-style: dashed !important;
    }

    .timeline-simple {
        border-left: 2px solid #f1f1f1;
        padding-left: 20px;
        position: relative;
        margin-left: 10px;
    }

    .timeline-simple>div {
        position: relative;
    }

    .timeline-simple>div::before {
        content: '';
        position: absolute;
        left: -26px;
        top: 5px;
        width: 10px;
        height: 10px;
        background: #fff;
        border: 2px solid #0d6efd;
        border-radius: 50%;
    }
</style>
