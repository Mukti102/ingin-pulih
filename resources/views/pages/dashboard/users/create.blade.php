<x-app-layout>
    <x-page-header title="Tambah User" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Users', 'route' => 'users.index'],
        ['label' => 'Tambah User'],
    ]" />

    <div class="row">
        <form action="{{ route('users.store') }}" method="POST" class="card">
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
                        <x-form.input name="password" type="password" label="Password" required="true" />

                    </div>
                    <div class="mb-3 col-sm-6 col-12">
                        <x-form.checkbox-group name="roles" label="Hak Akses" :options="$roles" />
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
