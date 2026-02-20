<x-app-layout>
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title text-violet-600 font-bold">Pengaturan Sistem</h4>
            <ul class="breadcrumbs">
                <li class="nav-home"><i class="fas fa-home"></i></li>
                <li class="separator"><i class="fas fa-angle-right"></i></li>
                <li class="nav-item">Dashboard</li>
                <li class="separator"><i class="fas fa-angle-right"></i></li>
                <li class="nav-item">Settings</li>
            </ul>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-round">
                        <div class="card-body p-0">
                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab"
                                role="tablist">
                                <a class="nav-link active p-3" data-toggle="pill" href="#v-pills-app" role="tab">
                                    <i class="fas fa-layer-group mr-2"></i> Identitas Aplikasi
                                </a>
                                <a class="nav-link p-3" data-toggle="pill" href="#v-pills-contact" role="tab">
                                    <i class="fas fa-envelope mr-2"></i> Kontak & CS
                                </a>
                                <a class="nav-link p-3" data-toggle="pill" href="#v-pills-social" role="tab">
                                    <i class="fab fa-share-alt mr-2"></i> Media Sosial
                                </a>
                                <a class="nav-link p-3" data-toggle="pill" href="#v-pills-system" role="tab">
                                    <i class="fas fa-tools mr-2"></i> Sistem & Mode
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="tab-content" id="v-pills-tabContent">

                        {{-- 1. Identitas Aplikasi --}}
                        <div class="tab-pane fade show active" id="v-pills-app" role="tabpanel">
                            <div class="card card-round">
                                <div class="card-header">
                                    <h5 class="font-weight-bold">Identitas Aplikasi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Platform</label>
                                        <input type="text" class="form-control" name="app_name"
                                            value="{{ $settings['app_name'] ?? config('app.name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tagline / Deskripsi Singkat</label>
                                        <textarea class="form-control" name="app_description" rows="2">{{ $settings['app_description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Logo Utama</label>
                                        @if (isset($settings['app_logo']))
                                            <div class="mb-2"><img src="{{ asset('storage/' . $settings['app_logo']) }}"
                                                    height="40"></div>
                                        @endif
                                        <input type="file" class="form-control-file" name="app_logo">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 2. Kontak & CS --}}
                        <div class="tab-pane fade" id="v-pills-contact" role="tabpanel">
                            <div class="card card-round">
                                <div class="card-header">
                                    <h5 class="font-weight-bold">Kontak & Customer Service</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Official</label>
                                                <input type="email" class="form-control" name="app_email"
                                                    value="{{ $settings['app_email'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>WhatsApp HotLine (Internasional format: 62...)</label>
                                                <input type="text" class="form-control" name="contact_wa"
                                                    value="{{ $settings['contact_wa'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Alamat Kantor</label>
                                                <textarea class="form-control" name="app_address" rows="2">{{ $settings['app_address'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 3. Media Sosial --}}
                        <div class="tab-pane fade" id="v-pills-social" role="tabpanel">
                            <div class="card card-round">
                                <div class="card-header">
                                    <h5 class="font-weight-bold">Link Media Sosial</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><i class="fab fa-instagram mr-1"></i> Instagram URL</label>
                                        <input type="url" class="form-control" name="social_instagram"
                                            value="{{ $settings['social_instagram'] ?? '' }}"
                                            placeholder="https://instagram.com/...">
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fab fa-tiktok mr-1"></i> TikTok URL</label>
                                        <input type="url" class="form-control" name="social_tiktok"
                                            value="{{ $settings['social_tiktok'] ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fab fa-youtube mr-1"></i> Youtube Channel</label>
                                        <input type="url" class="form-control" name="social_youtube"
                                            value="{{ $settings['social_youtube'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 4. Sistem --}}
                        <div class="tab-pane fade" id="v-pills-system" role="tabpanel">
                            <div class="card card-round border-danger">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="font-weight-bold mb-0">Pengaturan Tingkat Lanjut</h5>
                                </div>
                                <div class="card-body">
                                    <x-form.toggle name="maintenance_mode" label="Mode Pemeliharaan (Maintenance)"
                                        :checked="($settings['maintenance_mode'] ?? 'off') === 'on'" />
                                    <p class="small text-muted mt-n2">Jika diaktifkan, user tidak bisa mengakses
                                        halaman depan platform.</p>

                                    <hr>

                                    <div class="form-group">
                                        <label>Biaya Layanan Default (%)</label>
                                        <input type="number" class="form-control" name="default_fee"
                                            value="{{ $settings['default_fee'] ?? '10' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card card-round mt-3">
                        <div class="card-body text-right">
                            <button type="submit" class="btn btn-secondary px-5 btn-round">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
@push('styles')
    <style>
        .nav-pills-no-bd .nav-link {
            border-radius: 0 !important;
            border-bottom: 1px solid #ebedf2 !important;
            color: #575962;
        }

        .nav-pills-no-bd .nav-link.active {
            background-color: #f8f9fa !important;
            color: #7c3aed !important;
            /* Violet */
            font-weight: bold;
            border-left: 4px solid #7c3aed !important;
        }
    </style>
@endpush

<script>
    $(document).ready(function() {
        // 1. Logic Perpindahan Tab
        // Menggunakan delegasi event agar lebih stabil
        $('#v-pills-tab a').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');

            // Simpan tab aktif ke local storage agar saat refresh tidak kembali ke tab pertama
            localStorage.setItem('activeTab', $(this).attr('href'));
        });

        // Cek jika ada tab yang sebelumnya aktif di session storage
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('#v-pills-tab a[href="' + activeTab + '"]').tab('show');
        }

        // 2. Logic Status Text untuk Form Toggle (Switch)
        // Mencari semua input checkbox di dalam custom-switch
        $('.custom-control-input').on('change', function() {
            const isChecked = $(this).is(':checked');
            // Mencari span dengan class status-text di dalam label yang sama
            const labelText = $(this).siblings('.custom-control-label').find(
                'span[class^="status-text"]');

            if (isChecked) {
                labelText.text('Aktif').removeClass('text-muted').addClass('text-violet font-bold');
            } else {
                labelText.text('Non-aktif').removeClass('text-violet font-bold').addClass('text-muted');
            }
        });

        // 3. Preview Logo saat Upload
        $('input[name="app_logo"]').change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    // Cari element img terdekat atau buat preview baru
                    let previewContainer = $('input[name="app_logo"]').closest('.form-group');
                    if (previewContainer.find('img').length > 0) {
                        previewContainer.find('img').attr('src', event.target.result);
                    } else {
                        $('<div class="mb-2"><img src="' + event.target.result +
                            '" height="40"></div>').insertBefore('input[name="app_logo"]');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
