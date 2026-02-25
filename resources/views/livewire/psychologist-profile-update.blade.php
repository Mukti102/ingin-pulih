<div>
    <form wire:submit.prevent="update">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Informasi Profesional Psikolog</div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Alert Success --}}
                    @if (session()->has('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success">{{ session('success') }}</div>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <div class="form-group @error('fullname') has-error @enderror">
                            <label for="fullname">Nama Lengkap & Gelar (Untuk Publik)</label>
                            <input type="text" class="form-control" wire:model="fullname"
                                placeholder="Contoh: Budi Santoso, S.Psi., M.Psi., Psikolog">
                            @error('fullname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group @error('jenis_psikolog') has-error @enderror">
                            <label for="jenis_psikolog">Jenis Psikolog</label>
                            <select class="form-control" wire:model="jenis_psikolog">
                                <option value="">Pilih Jenis...</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('jenis_psikolog')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group @error('wilayah_id') has-error @enderror">
                            <label for="wilayah_id">Wilayah Praktik</label>
                            <select class="form-control" wire:model="wilayah_id">
                                <option value="">Pilih Wilayah...</option>
                                @foreach ($wilayahs as $wilayah)
                                    <option value="{{ $wilayah->id }}">{{ $wilayah->name }}</option>
                                @endforeach
                            </select>
                            @error('wilayah_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="SIPP">Nomor SIPP</label>
                            <input type="text" class="form-control" wire:model="SIPP">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="STR">Nomor STR</label>
                            <input type="text" class="form-control" wire:model="STR">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="experience_years">Pengalaman (Tahun)</label>
                            <input type="number" class="form-control" wire:model="experience_years">
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <label class="form-label font-weight-bold">Topik Keahlian (Pilih yang sesuai)</label>
                        <div class="d-flex flex-wrap gap-2 py-2">
                            @foreach ($allTopics as $topic)
                                <div class="custom-control custom-checkbox mr-3 mb-2">
                                    <input type="checkbox" class="custom-control-input" id="topic-{{ $topic->id }}"
                                        value="{{ $topic->id }}" wire:model="selectedTopics">
                                    <label class="custom-control-label" for="topic-{{ $topic->id }}">
                                        {{ $topic->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('selectedTopics')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group @error('about') has-error @enderror">
                            <label for="about">Tentang Saya (Bio)</label>
                            <textarea class="form-control" wire:model="about" rows="4"></textarea>
                            @error('about')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <span wire:loading wire:target="update" class="spinner-border spinner-border-sm mr-2"></span>
                    Perbarui Data Profesional
                </button>
            </div>
        </div>
    </form>
    <style>
        .custom-control-label {
            cursor: pointer;
        }

        /* Opsional: Style agar checkbox terpilih terlihat lebih menonjol */
        input[type="checkbox"]:checked+.custom-control-label {
            font-weight: bold;
            color: #1a73e8;
        }
    </style>
    <script>
        // Menangkap event sukses
        window.addEventListener('success-toast', event => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: event.detail.message,
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                position: 'top-end'
            });
        });

        // Menangkap event error
        window.addEventListener('error-toast', event => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: event.detail.message,
                toast: true,
                position: 'top-end'
            });
        });
    </script>
</div>
