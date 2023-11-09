<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
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

        $users = User::with('roles')->get();
        return view('backend.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('backend.admin.users.create', compact('roles'));
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

        $username = strtok($request->email, '@');
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $username.rand(1,100),
            'password' => Hash::make($request->password),
            'password_hint' => $request->password,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')->withSuccess('Pengguna berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Role::get();
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        return view('backend.admin.users.edit', compact('user','roles'));
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
            'username' => 'required|unique:users,username,' . $user->id . '|min:5|max:255',
            'password' => 'nullable|confirmed|min:5|max:255',
        ], [
            'name.required' => 'Nama harus diisi!',
            'name.max' => 'Maksimal 255 karakter!',
            'email.unique' => 'Email telah digunakan oleh akun lain!',
            'email.required' => 'Email harus diisi!',
            'email.max' => 'Maksimal 255 karakter!',
            'email.min' => 'Minimal 5 karakter!',
            'username.required' => 'Username harus diisi!',
            'username.unique' => 'Username telah digunakan oleh akun lain!',
            'username.max' => 'Maksimal 255 karakter!',
            'username.min' => 'Minimal 5 karakter!',
            'password.max' => 'Maksimal 255 karakter!',
            'password.min' => 'Minimal 5 karakter!',
            'password.confirmed' => 'Password dan Password konfirmasi tidak sama!',
            'role_id.required' => 'Role harus diisi!',
            'role_id.in' => 'Role harus berisi user, admin dll !',
        ]);

        if ($request->password_confirmation && !$request->password) {
            return back()->withError('Password baru tidak sesuai!');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->password_hint = $request->password;
        }
        $user->role_id = $request->role_id;

        $user->save();

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
