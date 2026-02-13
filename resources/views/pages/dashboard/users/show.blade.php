<x-app-layout>
    <x-page-header title="Detail User" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Users', 'route' => 'users.index'],
        ['label' => $user->name],
    ]" />

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                        class="rounded-circle mb-3" width="100" alt="Avatar">
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small">{{ $user->email }}</p>

                    <div class="mt-3">
                        @if ($user->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Non-Aktif</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-transparent">
                    <h6 class="mb-0">Informasi Lengkap</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama Lengkap</th>
                            <td>: {{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>: {{ $user->phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Roles / Hak Akses</th>
                            <td>:
                                @forelse($user->roles as $role)
                                    <span class="badge border  text-primary">{{ $role->name }}</span>
                                @empty
                                    <span class="text-muted">Tidak ada role</span>
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <th>Status Akun</th>
                            <td>: <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                                    {{ $user->is_active ? 'Aktif' : 'Akses diblokir' }}
                                </span></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
