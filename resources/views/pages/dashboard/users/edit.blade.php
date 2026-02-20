<x-app-layout>
    <x-page-header title="Edit User" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Users', 'route' => 'users.index'],
        ['label' => 'Edit User'],
    ]" />

    <div class="row">
        <form action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" method="POST" class="card">
            @csrf
            @method('PUT')

            <div class="card-header">
                <h4 class="card-title">Edit User</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="name" label="Nama" :value="$user->name" required="true" />
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="email" type="email" label="Email" :value="$user->email" required="true" />
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="phone" type="number" label="No Telephone" :value="$user->phone" />
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="date_of_birth" type="date" label="Tanggal Lahir" :value="$user->date_of_birth" required="false" />
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="password" type="password" label="Password (Kosongkan jika tidak diubah)" />
                    </div>
                    {{-- gender --}}
                    <div class="mb-3 col-sm-6 col-12">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-select">
                            <option {{ $user->gender == '' ? 'selected' : '' }} value="">Pilih Jenis Kelamin
                            </option>
                            <option {{ $user->gender == 'laki-laki' ? 'selected' : '' }} value="laki-laki">Laki-laki
                            </option>
                            <option {{ $user->gender == 'perempuan' ? 'selected' : '' }} value="perempuan">Perempuan
                            </option>
                            <option {{ $user->gender == 'lainya' ? 'selected' : '' }} value="lainya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="address" id="address" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="avatar" type="file" label="Avatar" required="false" />
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.checkbox-group name="roles" label="Hak Akses ( Pilih Satu )" :options="$roles" :selected="$user->roles->pluck('id')->toArray()" />
                    </div>
                    @if (auth()->user()->hasRole('admin'))
                        <div class="mb-3 col-sm-6 col-12">
                            <x-form.checkbox name="is_active" label="Aktif" :checked="$user->is_active" />
                        </div>
                    @endif
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-md btn-danger">
                    Kembali
                </a>

                <button type="submit" class="btn btn-md btn-success">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
