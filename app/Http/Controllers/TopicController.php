<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::all();
        return view('pages.dashboard.topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:types,name',
        ]);

        Topic::create([
            'name' => $request->name,
        ]);

        toast('Berhasil Menambahkan Topik Keahlian', 'success');

        return redirect()->back()->with('success', 'Type berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $type = Topic::find($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:types,name,' . $type->id,
        ]);

        $type->update([
            'name' => $request->name,
        ]);

        toast('Berhasil Memperbarui Topik Keahlian', 'success');

        return redirect()->back()->with('success', 'Type berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = Topic::find($id);
        $type->delete();
        toast('Berhasil Menghapus Topic Keahlian', 'success');
        return redirect()->back()->with('success', 'Type berhasil dihapus');
    }
}
