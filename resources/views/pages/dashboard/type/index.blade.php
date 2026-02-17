<x-app-layout>
    <x-page-header title="Jenis Psikolog Management" :breadcrumbs="[['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'], ['label' => 'Psikolog']]" />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Psikolog Management</h4>
                        <button class="btn btn-sm btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#createPsikologModal">
                            <i class="fa fa-plus"></i>
                            Tambah Psikolog
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="d-flex gap-2">

                                                {{-- EDIT --}}
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPsikologModal{{ $item->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                {{-- DELETE --}}
                                                <form action="{{ route('jenis-psikolog.destroy', $item->id) }}"
                                                    method="POST" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <!-- EDIT MODAL -->
                                            <div class="modal fade" id="editPsikologModal{{ $item->id }}"
                                                tabindex="-1">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('jenis-psikolog.update', $item->id) }}"
                                                        method="POST" class="modal-content">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Jenis Psikolog</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Jenis Psikolog</label>
                                                                <input type="text" name="name"
                                                                    class="form-control" value="{{ $item->name }}"
                                                                    required>
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
    <div class="modal fade" id="createPsikologModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('jenis-psikolog.store') }}" method="POST" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Psikolog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Jenis Psikolog</label>
                        <input type="text" name="name" class="form-control" required>
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
