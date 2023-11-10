<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    //
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
        return view('backend.student.transaction.transfer',compact('user','profile'));
    }
    public function riwayat(){
        return view('backend.student.transaction.riwayat');
    }
    public function show($id)
{
    // Logic to retrieve and display a single resource
}
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'jumlah' => 'required|integer',
        ]);
        transaction::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'amount' => $request->jumlah,

        ]);
        // StudentProfile::update([
        //     'user_id' => $user->id,
        //     'type' => $request->type,
        //     'amount' => $request->jumlah,

        // ]);
            return redirect()->route('transaksi.index')->with('success','Setor Berhasil');
    }
    public function withdraw(Request $request)
    {
        $user = Auth::user();
        $oldval = StudentProfile::where('id', $user->id)->first();
        $request->validate([
            'jumlah' => 'required|integer',
        ]);
        if ($request->jumlah > $oldval->jumlah) {
            # code...
            return redirect()->back()->with('error','Saldo Tidak Mencukupi');
        }else {
            # code...
            transaction::create([
                'user_id' => $user->id,
                'type' => $request->type,
                'amount' => $request->jumlah,

            ]);
            // StudentProfile::update([
            //     'user_id' => $user->id,
            //     'type' => $request->type,
            //     'amount' => $request->jumlah,

            // ]);
                return redirect()->route('transaksi.index')->with('success','Penarikan Berhasil');
        }
    }
}
