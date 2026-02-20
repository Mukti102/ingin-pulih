<x-app-layout>
    <x-page-header title="Tambah User" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Users', 'route' => 'users.index'],
        ['label' => 'Tambah User'],
    ]" />

    <div class="row">
        <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST" class="card">
            @csrf
            <div class="card-header">
                <h4 class="card-title">Tambah User</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @csrf
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="name" label="Nama" required="true" />
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="email" type="email" label="Email" required="true" />
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="phone" type="number" label="No Telephone" required="false" />
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="date_of_birth" type="date" label="Tanggal Lahir" required="false" />
                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.input name="password" type="password" label="Password" required="true" />
                    </div>
                    {{-- gender --}}
                    <div class="mb-3 col-sm-6 col-12">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                            <option value="lainya">Lainnya</option>
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
                        <x-form.checkbox-group name="roles" label="Hak Akses ( Pilih Satu )" :options="$roles" />
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-md btn-danger">
                    Kembali
                </a>
                <button type="submit" class="btn btn-md btn-success">
                    Submit
                </button>
            </div>

        </form>
    </div>

</x-app-layout>
