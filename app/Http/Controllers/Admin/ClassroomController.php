<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classroom;
use App\Models\Vocational;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('manage-classrooms')){
            abort(403);
        }

        $classrooms = Classroom::get();
        return view('backend.admin.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vocationals = Vocational::all();
        $teachers = TeacherProfile::with('user')->whereRelation('user', 'role_id', '3')->get();
        return view('backend.admin.classrooms.create', compact('vocationals', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ht_id' => 'required|unique:classrooms,ht_id',
            'vocational_id' => 'required',
            'name' => 'required|unique:classrooms,name|max:255',
        ], [
            'ht_id.unique' => 'Guru sudah menjadi wali kelas lain!',
            'ht_id.required' => 'Guru harus dipilih!',
            'vocational_id.required' => 'Jurusan harus dipilih!',
            'name.required' => 'Nama Kelas harus diisi!',
            'name.max' => 'Maksimal 255 karakter!',
            'name.unique' => 'Kelas Dengan Nama Yang Sama Sudah Tersedia!',
        ]);

        Classroom::create([
            'ht_id' => $request->ht_id,
            'vocational_id' => $request->vocational_id,
            'name' => $request->name,
        ]);

        return redirect()->route('admin.classrooms.index')->withSuccess('Pengguna berhasil ditambahkan!');
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
        $classroom = Classroom::find($id);
        $vocationals = Vocational::all();
        $teachers = TeacherProfile::with('user')->whereRelation('user', 'role_id', '3')->get();

        if (!$classroom) {
            abort(404);
        }

        return view('backend.admin.classrooms.edit', compact('classroom', 'vocationals', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classroom = Classroom::find($id);

        if (!$classroom) {
            abort(404);
        }

        $request->validate([
            'ht_id' => 'required|unique:classrooms,ht_id,' . $classroom->id .'',
            'vocational_id' => 'required',
            'name' => 'required|unique:classrooms,name,' . $classroom->id .'|max:255',
        ], [
            'ht_id.unique' => 'Guru sudah menjadi wali kelas lain!',
            'ht_id.required' => 'Guru harus dipilih!',
            'vocational_id.required' => 'Jurusan harus dipilih!',
            'name.required' => 'Nama Kelas harus diisi!',
            'name.max' => 'Maksimal 255 karakter!',
            'name.unique' => 'Jurusan Dengan Nama Yang Sama Sudah Tersedia!',
        ]);

        $classroom->ht_id = $request->ht_id;
        $classroom->vocational_id = $request->vocational_id;
        $classroom->name = $request->name;
        $classroom->save();

        return redirect()->route('admin.classrooms.index')->withSuccess('Pengguna berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classroom = Classroom::find($id);

    if (!$classroom) {
        abort(404);
    }

    $classroom->delete();

        return redirect()->route('admin.classrooms.index')->withSuccess('Pengguna berhasil dihapus!');
    }
}
