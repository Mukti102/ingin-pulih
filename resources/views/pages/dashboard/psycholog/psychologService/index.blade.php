<x-app-layout>
    <x-page-header title="Layanan" :breadcrumbs="[['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'], ['label' => 'Layanan']]" />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Layanan Management</h4>
                        <button class="btn btn-sm btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#createLayananModal">
                            <i class="fa fa-plus"></i>
                            Tambah Layanan
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Layanan</th>
                                    <th>Harga</th>
                                    <th>Jenis Layanan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pyschologServices as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->service->name }}</td>
                                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>{{ $item->type }}</td>

                                        <td>
                                            <span class="badge bg-{{ $item->is_active ? 'success' : 'danger' }}">
                                                {{ $item->is_active ? 'Akti' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                {{-- EDIT --}}
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editLayananModal{{ $item->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                {{-- DELETE --}}
                                                <form action="{{ route('psycholog-services.destroy', $item->id) }}"
                                                    method="POST" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="modal fade" id="editLayananModal{{ $item->id }}"
                                                tabindex="-1">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('psycholog-services.update', $item->id) }}"
                                                        method="POST" class="modal-content">

                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Layanan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label">Pilih Layanan</label>
                                                                <select name="service_id" class="form-control" required>
                                                                    @foreach ($allServices as $service)
                                                                        <option value="{{ $service->id }}"
                                                                            {{ $item->service_id == $service->id ? 'selected' : '' }}>
                                                                            {{ $service->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <x-form.input-group name="price" label="Harga"
                                                                    prefix="Rp" type="number"
                                                                    value="{{ $item->price }}" placeholder="0" />
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
                                                            <div class="mb-3">
                                                                <label class="form-label">Pilih Type Layanan</label>
                                                                <select name="type" class="form-control" required>
                                                                    <option value="">-- Pilih Type Layanan --
                                                                    </option>
                                                                    <option value="online"
                                                                        {{ $item->type == 'online' ? 'selected' : '' }}>
                                                                        Online
                                                                    </option>
                                                                    <option value="offline"
                                                                        {{ $item->type == 'offline' ? 'selected' : '' }}>
                                                                        Offline
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CREATE MODAL -->
    <div class="modal fade" id="createLayananModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('psycholog-services.store') }}" method="POST" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Layanan</label>
                        <select name="service_id" class="form-control" required>
                            <option value="">-- Pilih Layanan --</option>
                            @foreach ($allServices as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Type Layanan</label>
                        <select name="type" class="form-control" required>
                            <option value="">-- Pilih Type Layanan --</option>
                            <option value="online">
                                Online
                            </option>
                            <option value="offline">
                                Offline
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <x-form.input-group name="price" label="Harga" prefix="Rp" type="number"
                            placeholder="0" />
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
