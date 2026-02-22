<x-app-layout>

    <x-page-header title="Pengajuan Payout" :breadcrumbs="[['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'], ['label' => 'Payout']]" />

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Pengajuan Payout</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <hr>
                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($payouts as $payout)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $payout->psycholog->fullname }}</td>

                                        <td>Rp {{ number_format($payout->amount, 0, ',', '.') }}</td>


                                        <td>
                                            <span
                                                class="badge bg-{{ $payout->status == 'pending' ? 'warning' : ($payout->status == 'approved' ? 'success' : 'danger') }}">{{ ucfirst($payout->status) }}</span>
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
                                                            href="{{ route('payouts.show', encrypt($payout->id)) }}">
                                                            <i class="fa fa-eye me-2 text-info"></i> Detail
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    <li>
                                                        <form
                                                            action="{{ route('payouts.destroy', encrypt($payout->id)) }}"
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
