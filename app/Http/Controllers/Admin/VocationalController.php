<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TeacherProfile;
use App\Models\Vocational;
use Illuminate\Support\Facades\Gate;

class VocationalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('manage-vocationals')) {
            abort(403);
        }

        $vocationals = Vocational::get();
        return view('backend.admin.vocationals.index', compact('vocationals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.vocationals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:vocationals,name|max:255',
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.max' => 'Maksimal 255 karakter!',
            'name.unique' => 'Jurusan Dengan Nama Yang Sama Sudah Tersedia!',
        ]);

        Vocational::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.vocationals.index')->withSuccess('Pengguna berhasil ditambahkan!');
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
    public function edit($id)
    {
        $vocational = Vocational::find($id);

        if (!$vocational) {
            abort(404);
        }

        return view('backend.admin.vocationals.edit', compact('vocational'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vocational = Vocational::find($id);

        if (!$vocational) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|unique:vocationals,name,' . $vocational->id . '|max:255',
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.max' => 'Maksimal 255 karakter!',
            'name.unique' => 'Jurusan Dengan Nama Yang Sama Sudah Tersedia!',
        ]);

        $vocational->name = $request->name;
        $vocational->save();

        return redirect()->route('admin.vocationals.index')->withSuccess('Pengguna berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vocational = Vocational::with('classrooms.studentProfiles')->find($id);

        if (!$vocational) {
            abort(404);
        }

        foreach ($vocational->classrooms as $classroom) {
            $classroom->studentProfiles()->update(['classroom_id' => null]);
            $classroom->delete();
        }

        $vocational->delete();

        return redirect()->route('admin.vocationals.index')->withSuccess('Pengguna berhasil dihapus!');
    }
}
