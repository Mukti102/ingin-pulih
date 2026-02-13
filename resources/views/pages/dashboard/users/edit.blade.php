<x-app-layout>
    <x-page-header 
        title="Edit User" 
        :breadcrumbs="[
            ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
            ['label' => 'Users', 'route' => 'users.index'],
            ['label' => 'Edit User'],
        ]" 
    />

    <div class="row">
        <form action="{{ route('users.update', $user->id) }}" 
              method="POST" 
              class="card">
            @csrf
            @method('PUT')

            <div class="card-header">
                <h4 class="card-title">Edit User</h4>
            </div>

            <div class="card-body">
                <div class="row">

                    <x-form.input 
                        name="name" 
                        label="Nama" 
                        :value="$user->name"
                        required="true" 
                    />

                    <x-form.input 
                        name="email" 
                        type="email" 
                        label="Email" 
                        :value="$user->email"
                        required="true" 
                    />

                    <x-form.input 
                        name="phone" 
                        type="number" 
                        label="No Telephone" 
                        :value="$user->phone"
                    />

                    <x-form.input 
                        name="password" 
                        type="password" 
                        label="Password (Kosongkan jika tidak diubah)" 
                    />

                    <x-form.checkbox-group 
                        name="roles" 
                        label="Hak Akses" 
                        :options="$roles"
                        :selected="$user->roles->pluck('id')->toArray()"
                    />

                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('users.index') }}" 
                   class="btn btn-md btn-danger">
                    Kembali
                </a>

                <button type="submit" 
                        class="btn btn-md btn-success">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
