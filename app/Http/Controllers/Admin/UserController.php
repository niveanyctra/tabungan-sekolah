<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Role;
use App\Models\StudentProfile;
use App\Models\Vocational;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('manage-users')){
            abort(403);
        }

        $users = User::with(['roles', 'student', 'student.classroom', 'student.classroom.vocational'])
        ->get()
        ->sortBy('student')
        ->sortBy('name')
        ->sortBy('student.classroom')
        ->sortBy('roles.id');
        return view('backend.admin.users.index', compact('users'));
    }

    public function getKelasByJurusan($vocational_id)
    {
        $kelas = Classroom::where('vocational_id', $vocational_id)->get();
        return response()->json($kelas);
    }
    public function getVocationals()
    {
        // Get all vocationals
        $vocationals = Vocational::all();

        return response()->json(['vocationals' => $vocationals]);
    }

    public function getClassrooms($vocationalId)
    {
        // Get classrooms based on the selected vocational
        $classrooms = Classroom::where('vocational_id', $vocationalId)->get();

        return response()->json(['classrooms' => $classrooms]);
    }
    public function getVocationalAndClassrooms($role)
    {
        if ($role == 5) {
            // Replace this with your actual logic to fetch data
            $vocationals = Vocational::all();
            $classroomsByVocational = [];

            foreach ($vocationals as $vocational) {
                $classroomsByVocational[$vocational->id] = $vocational->classrooms;
            }

            return response()->json(['vocationals' => $vocationals, 'classroomsByVocational' => $classroomsByVocational]);
        }

        return response()->json(['vocationals' => [], 'classroomsByVocational' => []]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        $vocationals = Vocational::get();
        $classrooms = Classroom::all();
        return view('backend.admin.users.create', compact('roles', 'vocationals', 'classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|min:5|max:255',
            'password' => 'required|confirmed|min:5|max:255',
            'role_id' => 'required|in:1,2,3,4',
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.max' => 'Maksimal 255 karakter!',
            'email.unique' => 'Email telah digunakan oleh akun lain!',
            'email.required' => 'Email harus diisi!',
            'email.max' => 'Maksimal 255 karakter!',
            'email.min' => 'Minimal 5 karakter!',
            'password.required' => 'Password harus diisi!',
            'password.max' => 'Maksimal 255 karakter!',
            'password.min' => 'Minimal 5 karakter!',
            'password.confirmed' => 'Password dan Password konfirmasi tidak sama!',
            'role_id.required' => 'Role harus diisi!',
            'role_id.in' => 'Role harus berisi user, admin dll !',
        ]);

        if ($request->role_id == 5) {
            $request->validate([
                'classroom_id' => 'required',
            ], [
                'classroom_id.required' => 'Kelas harus diisi!',
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_hint' => $request->password,
                'role_id' => $request->role_id,
            ]);
            $user->student()->create([
                'classroom_id' => $request->classroom_id,
            ]);
        }
        else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_hint' => $request->password,
                'role_id' => $request->role_id,
            ]);
        }

        return redirect()->route('admin.users.index')->withSuccess('Pengguna berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Role::get();
        $vocationals = Vocational::get();
        $classrooms = Classroom::get();
        // Retrieve all vocationals with their classrooms
        $vocationals = Vocational::with('classrooms')->get();

        // Transform the data into a format suitable for JavaScript
        $classroomsByVocational = $vocationals->pluck('classrooms', 'id')->toArray();
        $user = User::with(['student', 'student.classroom', 'student.classroom.vocational'])->find($id);

        if (!$user) {
            abort(404);
        }

        return view('backend.admin.users.edit', compact('user','roles','vocationals', 'classrooms', 'classroomsByVocational'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id .'|min:5|max:255',
            'password' => 'nullable|confirmed|min:5|max:255',
            'role_id' => 'required|in:1,2,3,4',
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.max' => 'Maksimal 255 karakter!',
            'email.unique' => 'Email telah digunakan oleh akun lain!',
            'email.required' => 'Email harus diisi!',
            'email.max' => 'Maksimal 255 karakter!',
            'email.min' => 'Minimal 5 karakter!',
            'password.max' => 'Maksimal 255 karakter!',
            'password.min' => 'Minimal 5 karakter!',
            'password.confirmed' => 'Password dan Password konfirmasi tidak sama!',
            'role_id.required' => 'Role harus diisi!',
            'role_id.in' => 'Role harus berisi user, admin dll!',
        ]);

        if ($request->password_confirmation && !$request->password) {
            return back()->withError('Password baru tidak sesuai!');
        }

        if ($request->role_id == 5) {
            $request->validate([
                'classroom_id' => 'required',
            ], [
                'classroom_id.required' => 'Kelas harus diisi!',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
                $user->password_hint = $request->password;
            }
            $user->role_id = $request->role_id;

            // Check if the user has a student record
            if (!$user->student) {
                // If not, create a new student record
                $user->student()->create([
                    'classroom_id' => $request->classroom_id,
                ]);
            } else {
                // If yes, update the existing student record
                $user->student->classroom_id = $request->classroom_id;
                $user->student->save();
            }

            $user->save();
        } else {
            // If the new role is not student, remove the student record if exists
            if ($user->student) {
                $user->student->delete();
            }

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
                $user->password_hint = $request->password;
            }
            $user->role_id = $request->role_id;
            $user->save();
        }

        return redirect()->route('admin.users.index')->withSuccess('Pengguna berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->withSuccess('Pengguna berhasil dihapus!');
    }
}
