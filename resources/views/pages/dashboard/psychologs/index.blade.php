<x-app-layout>
    <x-page-header title="Psikolog Management" :breadcrumbs="[['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'], ['label' => 'Psikolog']]" />

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Psikolog Management</h4>

                        <a href="{{ route('psychologs.create') }}" class="btn btn-sm btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Tambah Psikolog
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('psychologs.index') }}" method="GET" id="filter-form">
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label class="form-label">Wilayah</label>
                                    <select name="wilayah_id" class="form-control filter-input">
                                        <option value="">Semua Wilayah</option>
                                        @foreach ($wilayahs as $wilayah)
                                            <option value="{{ $wilayah->id }}"
                                                {{ request('wilayah_id') == $wilayah->id ? 'selected' : '' }}>
                                                {{ $wilayah->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Jenis Psikolog</label>
                                    <select name="jenis_id" class="form-control filter-input">
                                        <option value="">Semua Jenis</option>
                                        @foreach ($types as $jenis)
                                            <option value="{{ $jenis->id }}"
                                                {{ request('jenis_id') == $jenis->id ? 'selected' : '' }}>
                                                {{ $jenis->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Status Verifikasi</label>
                                    <select name="status" class="form-control filter-input">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="complete"
                                            {{ request('status') == 'complete' ? 'selected' : '' }}>Complete</option>
                                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>
                                            Failed</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fa fa-filter"></i> Filter
                                    </button>
                                    <a href="{{ route('psychologs.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-sync"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Wilayah</th>
                                    <th>Jenis</th>
                                    <th>Pengalaman</th>
                                    <th>Status Verifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($psychologs as $psycholog)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $psycholog->fullname }}</td>

                                        <td>{{ $psycholog->user->email ?? '-' }}</td>

                                        <td>{{ $psycholog->wilayah->name ?? '-' }}</td>

                                        <td>{{ $psycholog->jenisPsikolog->name ?? '-' }}</td>

                                        <td>{{ $psycholog->experience_years }} Tahun</td>

                                        <td>
                                            @if ($psycholog->verification_status == 'complete')
                                                <span class="badge bg-success">Complete</span>
                                            @elseif($psycholog->verification_status == 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light" type="button"
                                                    data-bs-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>

                                                <ul class="dropdown-menu">

                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('psychologs.show', encrypt($psycholog->id)) }}">
                                                            <i class="fa fa-eye me-2 text-info"></i> Detail
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('psychologs.edit', encrypt($psycholog->id)) }}">
                                                            <i class="fa fa-edit me-2 text-primary"></i> Edit
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    <li>
                                                        <form
                                                            action="{{ route('psychologs.destroy', $psycholog->id) }}"
                                                            method="POST" class="form-delete">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fa fa-trash me-2"></i> Hapus
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
</x-app-layout>
<x-loading />
