<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // All Return View Function
    public function index(){
        $user = Auth::user(); // Get the authenticated user
        $profile = StudentProfile::where('id', $user->id)->first(); // Assuming 'user_id' is the foreign key linking the user and profile

        return view('backend.student.transaction.index', compact('user', 'profile'));
    }
    public function setor(){
        $user = Auth::user(); // Get the authenticated user
        $profile = StudentProfile::where('id', $user->id)->first(); // Assuming 'user_id' is the foreign key linking the user and profile
        return view('backend.student.transaction.setor',compact('user','profile'));
    }
    public function tarik(){
        $user = Auth::user(); // Get the authenticated user
        $profile = StudentProfile::where('id', $user->id)->first(); // Assuming 'user_id' is the foreign key linking the user and profile
        return view('backend.student.transaction.tarik',compact('user','profile'));
    }
    public function transfer(){
        $user = Auth::user(); // Get the authenticated user
        $profile = StudentProfile::where('id', $user->id)->first(); // Assuming 'user_id' is the foreign key linking the user and profile
        $siswa = User::where('role_id',4)->where('id','!=',$user->id)->get();
        return view('backend.student.transaction.transfer',compact('user','profile','siswa'));
    }
    public function riwayat(){
        return view('backend.student.transaction.riwayat');
    }
    public function show($id)
{
    // Logic to retrieve and display a single resource
}


    // All Store Function
    public function store(Request $request)
    {
        $user = Auth::user();
        $totalRecords = transaction::count();
        $format = 'TR-' . str_pad($totalRecords + 1, 5, '0', STR_PAD_LEFT);
        $request->validate([
            'jumlah' => 'required|numeric|min:1000',
        ],[
        'jumlah.required' => 'Jumlah Tidak Boleh Kosong.',
        'jumlah.numeric' => 'Jumlah Harus Berupa Angka.',
        'jumlah.min' => 'Jumlah Minimal 1000.',
    ]);
        transaction::create([
            'user_id' => $user->id,
            'no_transaksi' => $format,
            'target_user_id' => $user->id,
            'type' => $request->type,
            'amount' => $request->jumlah,

        ]);
            return redirect()->route('transaksi.index')->with('success','Setor Berhasil');
    }
    public function withdraw(Request $request)
    {
        $user = Auth::user();
        $totalRecords = transaction::count();
        $format = 'TR-' . str_pad($totalRecords + 1, 5, '0', STR_PAD_LEFT);
        $oldval = StudentProfile::where('id', $user->id)->first();
        $request->validate([
            'jumlah' => 'required|numeric|min:1000',
        ],[
        'jumlah.required' => 'Jumlah Tidak Boleh Kosong.',
        'jumlah.numeric' => 'Jumlah Harus Berupa Angka.',
        'jumlah.min' => 'Jumlah Minimal 1000.',
    ]);
        if ($request->jumlah > $oldval->jumlah) {
            # code...
            return redirect()->back()->with('error','Saldo Tidak Mencukupi');
        }else {
            # code...
            transaction::create([
                'user_id' => $user->id,
                'no_transaksi' => $format,
                'target_user_id' => $user->id,
                'type' => $request->type,
                'amount' => $request->jumlah,

            ]);
                return redirect()->route('transaksi.index')->with('success','Penarikan Berhasil');
        }
    }
    public function StoreTransfer(Request $request)
    {
        $user = Auth::user();
        $totalRecords = transaction::count();
        $format = 'TR-' . str_pad($totalRecords + 1, 5, '0', STR_PAD_LEFT);
        $oldval = StudentProfile::where('id', $user->id)->first();
        $request->validate([
            'jumlah' => 'required|numeric|min:1000',
        ],[
        'jumlah.required' => 'Jumlah Tidak Boleh Kosong.',
        'jumlah.numeric' => 'Jumlah Harus Berupa Angka.',
        'jumlah.min' => 'Jumlah Minimal 1000.',
    ]);
        if ($request->jumlah > $oldval->jumlah) {
            # code...
            return redirect()->back()->with('error','Saldo Tidak Mencukupi');
        }else {
            # code...
            transaction::create([
                'user_id' => $user->id,
                'no_transaksi' => $format,
                'target_user_id' => $request->target_user_id,
                'type' => $request->type,
                'amount' => $request->jumlah,

            ]);
                return redirect()->route('transaksi.index')->with('success','Transfer Berhasil');
        }
    }
}
