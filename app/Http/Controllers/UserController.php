<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->list();
        return view('pages.dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('pages.dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->userService->store($request->validate());
            toast('Berhasil Menambahkan User', 'success');
            return redirect()->route('users.index');
        } catch (Exception $th) {
            toast('Gagal Menambahkan User', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userService->find($id);
        return view('pages.dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = $this->userService->find($id);
            $this->userService->update($user, $request->validate());
            toast('Berhasil Mengupdate User', 'success');
        } catch (Exception $th) {
            toast('Gagal Mengupdate User', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = $this->userService->find($id);
            $this->userService->delete($user);
            toast('Berhasil Menghapus User');
            return redirect()->route('users.index');
        } catch (Exception $e) {
            toast('Gagal Menghapus User');
            return redirect()->route('users.index');
        }
    }
}
