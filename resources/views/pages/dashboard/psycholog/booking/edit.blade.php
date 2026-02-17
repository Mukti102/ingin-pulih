<x-app-layout>
    <x-page-header title="Edit Booking" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Booking', 'route' => 'bookings.index'],
        ['label' => 'Edit Booking'],
    ]" />

    <div x-data="bookingHandler()" class="container-fluid pb-5">
        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="psycholog_id" value="{{ $psycholog->id }}">

            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary text-light bg-opacity-10 p-2 rounded-3 me-3">
                                    <i class="fas fa-user-alt fs-4"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Informasi Klien</h5>
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-semibold text-secondary">Pasien</label>
                                <select name="user_id" class="form-select form-select-lg border-2 shadow-none" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-success text-light bg-opacity-10 p-2 rounded-3 me-3">
                                    <i class="fas fa-calendar-alt fs-4"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Jadwal & Layanan</h5>
                            </div>

                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark mb-3">Pilih Layanan Konsultasi</label>
                                    <div class="row g-3">
                                        @foreach ($services as $service)
                                            <div class="col-md-6 col-xl-4">
                                                <div class="card h-100 border-2 position-relative overflow-hidden transition-all service-card"
                                                    :class="serviceId == '{{ $service->service_id }}' ? 'border-primary shadow-sm bg-white' : 'border-light bg-light bg-opacity-50'"
                                                    @click="selectService('{{ $service->id }}', {{ $service->price }})">
                                                    
                                                    <div class="position-absolute top-0 end-0 p-2" x-show="serviceId == '{{ $service->service_id }}'" x-transition>
                                                        <i class="fas fa-check-circle text-primary fs-5"></i>
                                                    </div>

                                                    <div class="card-body p-4 text-center">
                                                        <div class="mx-auto rounded-4 d-flex align-items-center justify-content-center mb-3 transition-all icon-box"
                                                            :class="serviceId == '{{ $service->id }}' ? 'bg-primary text-white' : 'bg-white text-primary shadow-sm'"
                                                            style="width: 56px; height: 56px;">
                                                            <i class="fas fa-hand-holding-heart fs-4"></i>
                                                        </div>
                                                        <h6 class="fw-bolder mb-1 text-dark">{{ $service->service->name }}</h6>
                                                        <p class="small text-muted mb-3">Sesi Privat 60 Menit</p>
                                                        
                                                        <div class="pt-2 border-top">
                                                            <span class="fs-5 fw-bold text-primary">
                                                                Rp {{ number_format($service->price, 0, ',', '.') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="service_id" x-model="serviceId" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Tanggal Sesi</label>
                                    <input type="date" name="session_date"
                                        class="form-control form-control-lg border-2 shadow-none" x-model="sessionDate"
                                        @change="checkSchedule" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Tipe Pertemuan</label>
                                    <div class="d-flex gap-3 pt-1">
                                        <input type="radio" class="btn-check" name="meeting_type" id="type_online" value="online" x-model="meetingType">
                                        <label class="btn btn-outline-primary px-4 py-2 rounded-3 w-100" for="type_online">
                                            <i class="fas fa-video me-2"></i>Online
                                        </label>

                                        <input type="radio" class="btn-check" name="meeting_type" id="type_offline" value="offline" x-model="meetingType">
                                        <label class="btn btn-outline-primary px-4 py-2 rounded-3 w-100" for="type_offline">
                                            <i class="fas fa-map-marker-alt me-2"></i>Offline
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">Jam Mulai</small>
                                        <input type="hidden" name="start_time" :value="startTime">
                                        <h5 class="mb-0 fw-bold text-dark" x-text="startTime ? startTime : '--:--'"></h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.7rem;">Jam Selesai</small>
                                        <input type="hidden" name="end_time" :value="endTime">
                                        <h5 class="mb-0 fw-bold text-dark" x-text="endTime ? endTime : '--:--'"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow rounded-4 bg-primary text-white mb-4 sticky-top" style="top: 20px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Ringkasan Perubahan</h5>

                            <div class="d-flex justify-content-between mb-3 opacity-75">
                                <span>Harga Layanan</span>
                                <span x-text="formatCurrency(totalPrice)"></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 opacity-75">
                                <span>Biaya Platform (10%)</span>
                                <span x-text="'- ' + formatCurrency(platformFee)"></span>
                            </div>

                            <hr class="border-white opacity-25">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fw-bold">Estimasi Earning</span>
                                <h3 class="mb-0 fw-bolder" x-text="formatCurrency(earning)"></h3>
                            </div>

                            <input type="hidden" name="total_price" :value="totalPrice">
                            <input type="hidden" name="platform_fee" :value="platformFee">
                            <input type="hidden" name="earning" :value="earning">

                            <button type="submit" class="btn btn-light btn-lg w-100 rounded-3 fw-bold shadow-sm py-3 text-primary" :disabled="!isReady">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('bookings.index') }}" class="btn btn-link text-white w-100 mt-2 opacity-75 decoration-none">Batalkan</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        .service-card { transition: all 0.3s ease; border-radius: 1.25rem !important; cursor: pointer; border-style: solid !important; }
        .service-card:hover { transform: translateY(-5px); border-color: #0d6efd !important; }
        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); }
        .btn-check:checked+.btn-outline-primary { background-color: #0d6efd; color: white; }
    </style>

    <script>
        function bookingHandler() {
            return {
                // Inisialisasi dengan data dari Database
                serviceId: '{{ $booking->service_id }}',
                sessionDate: '{{ $booking->session_date }}',
                startTime: '{{ \Carbon\Carbon::parse($booking->start_time)->format("H:i") }}',
                endTime: '{{ \Carbon\Carbon::parse($booking->end_time)->format("H:i") }}',
                meetingType: '{{ $booking->meeting_type }}',
                totalPrice: {{ $booking->total_price }},
                platformFee: {{ $booking->platform_fee }},
                earning: {{ $booking->earning }},
                schedules: @json($psycholog->weeklySchedules),

                get isReady() {
                    return this.serviceId !== '' && this.sessionDate !== '' && this.startTime !== '';
                },

                selectService(id, price) {
                    this.serviceId = id;
                    this.totalPrice = price;
                    this.platformFee = price * 0.1;
                    this.earning = this.totalPrice - this.platformFee;
                },

                checkSchedule() {
                    if (!this.sessionDate) return;
                    const dateObj = new Date(this.sessionDate);
                    const days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                    const dayName = days[dateObj.getDay()];

                    const match = this.schedules.find(s => 
                        s.day_of_week.toLowerCase() === dayName && parseInt(s.is_active) === 1
                    );

                    if (match) {
                        this.startTime = match.start_time.substring(0, 5);
                        this.endTime = match.end_time.substring(0, 5);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Jadwal Tidak Tersedia',
                            text: 'Psikolog tidak praktek pada hari ' + dayName.toUpperCase() + ' di tanggal tersebut.',
                            confirmButtonColor: '#0d6efd'
                        });
                        this.sessionDate = '';
                        this.startTime = '';
                        this.endTime = '';
                    }
                },

                formatCurrency(val) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(val);
                }
            }
        }
    </script>
</x-app-layout>