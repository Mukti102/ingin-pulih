<x-app-layout>
    <x-page-header title="List Booking" :breadcrumbs="[['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'], ['label' => 'Daftar Booking']]" />

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 d-flex align-items-center border-bottom-0">
                    <h5 class="card-title mb-0 fw-bold">Daftar Booking</h5>
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-sm ms-auto rounded-3">
                        <i class="fa fa-plus me-1"></i> Tambah Booking
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive" style="overflow: visible;">
                        <table id='basic-datatables' class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">No</th>
                                    <th class="border-0">Kode</th>
                                    <th class="border-0">User</th>
                                    <th class="border-0">Service</th>
                                    <th class="border-0 text-nowrap">Tanggal & Jam</th>
                                    <th class="border-0 text-center">Status</th>
                                    <th class="border-0">Total</th>
                                    <th class="border-0 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-bold text-primary">{{ $item->code }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold text-dark">{{ $item->user->name ?? '-' }}</span>
                                                <small class="text-muted">Client</small>
                                            </div>
                                        </td>
                                        <td>{{ $item->service->name ?? '-' }}</td>
                                        <td>
                                            <div class="text-nowrap">
                                                <i class="far fa-calendar-alt text-muted me-1"></i> {{ \Carbon\Carbon::parse($item->session_date)->format('d M Y') }}
                                            </div>
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $statusClass = [
                                                    'pending' => 'bg-warning text-dark',
                                                    'confirmed' => 'bg-primary',
                                                    'complete' => 'bg-success',
                                                    'cancelled' => 'bg-danger'
                                                ][$item->status] ?? 'bg-secondary';
                                            @endphp
                                            <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill shadow-none" style="font-size: 0.75rem;">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td class="fw-bold text-dark">Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-light rounded-circle shadow-none" 
                                                        type="button" 
                                                        data-bs-toggle="dropdown" 
                                                        data-bs-boundary="viewport"
                                                        aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                                                    <li>
                                                        <a class="dropdown-item py-2" href="{{ route('bookings.show', encrypt($item->id)) }}">
                                                            <i class="fa fa-eye me-2 text-info" style="width: 20px;"></i> Detail
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item py-2" href="{{ route('bookings.edit', encrypt($item->id)) }}">
                                                            <i class="fa fa-edit me-2 text-primary" style="width: 20px;"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider opacity-50"></li>
                                                    <li>
                                                        <form action="{{ route('bookings.destroy', $item->id) }}" method="POST" class="form-delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item py-2 text-danger">
                                                                <i class="fa fa-trash me-2" style="width: 20px;"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Memperbaiki tampilan tombol titik tiga agar bulat sempurna */
        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Memberikan ruang agar dropdown tidak langsung tertutup saat kursor bergeser sedikit */
        .dropdown-menu {
            margin-top: 5px !important;
            min-width: 160px;
        }

        /* Hover effect pada baris tabel */
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.02);
        }
    </style>
</x-app-layout>