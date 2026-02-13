<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function list()
    {
        $users = User::with('roles')->get();
        return $users;
    }

    public function find($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
            ]);
            $user->roles()->sync($data['role']);

            return $user;
        });
    }

    public function update(User $user, array $data): User
    {
        return DB::transaction(function () use ($data, $user) {
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'] ? Hash::make($data['password']) : $user->password,
                'phone' => $data['phone'],
                'is_active' => $data['is_active'] ?? $user->is_active,
            ]);

            $user->roles()->sync($data['roles']);

            return $user;
        });
    }


    public function delete(User $user): void
    {
        DB::transaction(function () use ($user) {
            $user->roles()->detach();
            $user->delete();
        });
    }
}
