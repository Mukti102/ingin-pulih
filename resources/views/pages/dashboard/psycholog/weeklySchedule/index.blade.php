<x-app-layout>

    <x-page-header title="Jadwal Mingguan" :breadcrumbs="[['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'], ['label' => 'Jadwal Mingguan']]" />

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Weekly Schedule</h4>

                        <button class="btn btn-sm btn-primary ms-auto" data-bs-toggle="modal"
                            data-bs-target="#createScheduleModal">
                            <i class="fa fa-plus"></i>
                            Tambah Jadwal
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hari</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{-- Mengonversi nama hari ke Bahasa Indonesia --}}
                                            @php
                                                $hari = [
                                                    'Monday' => 'Senin',
                                                    'Tuesday' => 'Selasa',
                                                    'Wednesday' => 'Rabu',
                                                    'Thursday' => 'Kamis',
                                                    'Friday' => 'Jumat',
                                                    'Saturday' => 'Sabtu',
                                                    'Sunday' => 'Minggu',
                                                ];
                                                $dayName = ucfirst($item->day_of_week);
                                            @endphp
                                            {{ $hari[$dayName] ?? $dayName }}
                                        </td>
                                        <td>{{ $item->start_time }}</td>
                                        <td>{{ $item->end_time }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->is_active ? 'success' : 'danger' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">

                                                {{-- EDIT --}}
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editScheduleModal{{ $item->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                {{-- DELETE --}}
                                                <form
                                                    action="{{ route('psycholog-weekly-schedules.destroy', $item->id) }}"
                                                    method="POST" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            {{-- ================= EDIT MODAL ================= --}}
                                            <div class="modal fade" id="editScheduleModal{{ $item->id }}"
                                                tabindex="-1">
                                                <div class="modal-dialog">
                                                    <form
                                                        action="{{ route('psycholog-weekly-schedules.update', $item->id) }}"
                                                        method="POST" class="modal-content">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Jadwal</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label">Hari</label>
                                                                <select name="day_of_week" class="form-control"
                                                                    required>
                                                                    @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                                                        <option value="{{ $day }}"
                                                                            {{ $item->day_of_week == $day ? 'selected' : '' }}>
                                                                            {{ ucfirst($day) }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">

                                                                <x-form.input type="time" name="start_time"
                                                                    label="Jam Mulai" value="{{ $item->start_time }}"
                                                                    required="true" />

                                                            </div>

                                                            <div class="mb-3">
                                                                <x-form.input type="time" name="end_time"
                                                                    label="Jam Selesai" value="{{ $item->end_time }}"
                                                                    required="true" />

                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select name="is_active" class="form-control">
                                                                    <option value="1"
                                                                        {{ $item->is_active ? 'selected' : '' }}>
                                                                        Aktif
                                                                    </option>
                                                                    <option value="0"
                                                                        {{ !$item->is_active ? 'selected' : '' }}>
                                                                        Nonaktif
                                                                    </option>
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Batal
                                                            </button>
                                                            <button type="submit" class="btn btn-success">
                                                                Update
                                                            </button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada jadwal
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- ================= CREATE MODAL ================= --}}
    <div class="modal fade" id="createScheduleModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('psycholog-weekly-schedules.store') }}" method="POST" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Hari</label>
                        <select name="day_of_week" class="form-control" required>
                            <option value="">-- Pilih Hari --</option>
                            @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                <option value="{{ $day }}">
                                    {{ ucfirst($day) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <x-form.input type="time" name="start_time" label="Jam Mulai" required="true" />
                    </div>

                    <div class="mb-3">
                        <x-form.input type="time" name="end_time" label="Jam Selesai" required="true" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
