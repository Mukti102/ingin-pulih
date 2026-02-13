<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::latest()->get();
        return view('pages.dashboard.type.index', compact('types'));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:types,name',
        ]);

        Type::create([
            'name' => $request->name,
        ]);

        toast('Berhasil Menambahkan Jenis Psikolog','success');

        return redirect()->back()->with('success', 'Type berhasil ditambahkan');
    }

    /**
     * Update
     */
    public function update(Request $request, $id)
    {
        $type = Type::find($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:types,name,' . $type->id,
        ]);

        $type->update([
            'name' => $request->name,
        ]);

        toast('Berhasil Memperbarui Jenis Psikolog','success');

        return redirect()->back()->with('success', 'Type berhasil diupdate');
    }

    /**
     * Delete
     */
    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();
        toast('Berhasil Menghapus Jenis Psikolog','success');
        return redirect()->back()->with('success', 'Type berhasil dihapus');
    }
}
