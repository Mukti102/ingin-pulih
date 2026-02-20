<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            // Proses upload avatar hanya jika ada file yang diunggah
            $avatarPath = null;
            if (isset($data['avatar']) && $data['avatar'] instanceof \Illuminate\Http\UploadedFile) {
                $avatarPath = $data['avatar']->store('avatars', 'public');
            }

            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'phone'    => $data['phone'],
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'gender'   => $data['gender'] ?? null,
                'address'  => $data['address'] ?? null,
                'avatar'   => $avatarPath,
                'is_active' => $data['is_active'] ?? true,
            ]);

            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }

            return $user;
        });
    }
    public function update(User $user, array $data): User
    {
        return DB::transaction(function () use ($data, $user) {
            $avatarPath = $user->avatar;

            if (isset($data['avatar']) && $data['avatar'] instanceof \Illuminate\Http\UploadedFile) {

                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $avatarPath = $data['avatar']->store('avatars', 'public');
            }

            $user->update([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => !empty($data['password']) ? Hash::make($data['password']) : $user->password,
                'phone'     => $data['phone'],
                'date_of_birth' => $data['date_of_birth'] ?? $user->date_of_birth,
                'is_active' => $data['is_active'] ?? $user->is_active,
                'gender'    => $data['gender'] ?? $user->gender,
                'address'   => $data['address'] ?? $user->address,
                'avatar'    => $avatarPath, 
            ]);

            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }

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
