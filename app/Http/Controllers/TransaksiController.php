<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classroom;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function adminIndex()
    {
        $transactions = transaction::where('status', true)->latest('updated_at')->get();

        return view('backend.admin.transactions.index', compact('transactions'));
    }
    public function adminConfirmation(){
        $trans = transaction::with('user')
            ->where('status', false)
            ->orderby('created_at')
            ->orderby('status')
            ->get()
            ->sortBy('status');
        return view('backend.admin.transactions.confirm',compact('trans'));
    }

    public function konfirmasiTransaksi($id)
    {
        $trans = transaction::find($id);

        if (!$trans) {
            return redirect()->route('admin.adminTransaksiIndex')->with('error', 'Transaksi tidak ditemukan.');
        }

        $trans->update(['status' => true]);

        return redirect()->route('admin.students.index')->with('success', 'Transaksi berhasil dikonfirmasi.');
    }
    public function adminSetor($id)
    {
        $user = User::find($id);
        $student = StudentProfile::with('user')->whereRelation('user','id', $user->id)->first();
        return view('backend.admin.transactions.setor', compact('user','student'));
    }
    public function adminStore(Request $request, $id)
    {
        $user = StudentProfile::find($id);
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
            'status' => true,
        ]);
        return redirect()->route('admin.students.index')->with('success','Setor Berhasil');
    }
    public function adminTarik($id)
    {
        $user = User::find($id);
        $student = StudentProfile::with('user')->whereRelation('user','id', $user->id)->first();
        return view('backend.admin.transactions.tarik', compact('user','student'));
    }
    public function adminWithdraw(Request $request, $id)
    {
        $user = StudentProfile::find($id);
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
                'status' => true,
            ]);
            return redirect()->route('admin.students.index')->with('success','Setor Berhasil');
        }
    }
    // All Return View Function
    public function index(){
        $user = Auth::user(); // Get the authenticated user
        $profile = StudentProfile::where('id', $user->id)->first(); // Assuming 'user_id' is the foreign key linking the user and profile
        $trans = transaction::with('user')->where('user_id', $user->id)->latest()->first();
        // $penerima = User::where('id', $trans->target_user_id)->first();

        return view('backend.student.transaction.index', compact('user', 'profile','trans'));
    }
    public function teacherIndex(){
        // $trans = transaction::with('user')->get();
        $auth = Auth::user();
        $kelas = Classroom::with('ht')->with('vocational')->where('ht_id',$auth->id)->first();
        $siswa = StudentProfile::with('classroom')->where('classroom_id',$kelas->id)->get();
        return view('backend.homeroom-teacher.transaction.index',compact('auth','kelas','siswa'));
    }
    public function setor($name){
        $auth = Auth::user();
        $kelas = Classroom::with('ht')->where('ht_id',$auth->id)->first();
        $iduser = User::with('student')->where('name','=',$name)->first();
        $siswa = StudentProfile::with('classroom')->where('classroom_id',$kelas->id)->where('id',$iduser->id)->first();
        $student = StudentProfile::with('user')->get();
        $transSiswa = User::with('student')->where('name','=', $name)->first();
        return view('backend.homeroom-teacher.transaction.setor',compact('auth','kelas','siswa','student','transSiswa','iduser'));
    }
    public function tarik($name){
        $auth = Auth::user();
        $kelas = Classroom::with('ht')->where('ht_id',$auth->id)->first();
        $iduser = User::with('student')->where('name','=',$name)->first();
        $siswa = StudentProfile::with('classroom')->where('classroom_id',$kelas->id)->where('id',$iduser->id)->first();
        $student = StudentProfile::with('user')->get();
        $transSiswa = User::with('student')->where('name','=', $name)->first();
        return view('backend.homeroom-teacher.transaction.tarik',compact('auth','kelas','siswa','student','transSiswa','iduser'));
    }
    // public function transfer(){
    //     $user = Auth::user(); // Get the authenticated user
    //     $profile = StudentProfile::where('id', $user->id)->first(); // Assuming 'user_id' is the foreign key linking the user and profile
    //     $siswa = User::where('role_id',4)->where('id','!=',$user->id)->get();
    //     return view('backend.student.transaction.transfer',compact('user','profile','siswa'));
    // }
    public function riwayat($id){
        $trans = transaction::with('user')->where('user_id','=',$id)->where('status',true)->get();
        return view('backend.student.transaction.riwayat',compact('trans'));
    }
    public function teacherRiwayat(){
        $auth = Auth::user();
        $class = Classroom::where('ht_id',$auth->id)->first();
        // $riwayat = StudentProfile::where('classroom_id',$class->id)->get();
        $riwayat = transaction::with(['user', 'user.student'])->where('status',true)->whereRelation('user.student', 'classroom_id', $class->id)->get();
        return view('backend.homeroom-teacher.transaction.riwayat',compact('riwayat'));
    }
    public function bukti(){
        $user = Auth::user(); // Get the authenticated user
        $profile = StudentProfile::where('id', $user->id)->first(); // Assuming 'user_id' is the foreign key linking the user and profile
        $trans = transaction::with('user')->where('user_id', $user->id)->latest()->first();
        $penerima = User::where('id', $trans->target_user_id)->first();
        // $pdfContent = $this->generatePDFContent($trans);
        // $pdfFilePath = 'pdfs/' . $trans->no_transaksi . '_document.pdf';
        // $this->savePDFToStorage($pdfContent, $pdfFilePath);
        // PDF::loadview('invoice',$trans);
        return view('backend.student.transaction.bukti', compact('user', 'profile','trans','penerima'));
    }
    // public function generateBukti(transaksi $trans){
    //     $data = [
    //         'trans' => $trans,
    //     ];

    //     $pdf = PDF::loadView('pdf', $data);

    //     return $pdf->download('custom_pdf.pdf');
    // }
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
            'user_id' => $request->user_id,
            'no_transaksi' => $format,
            'type' => $request->type,
            'amount' => $request->jumlah,

        ]);

        if ($user->role_id == 2) {
            # code...
            return redirect()->route('admin.adminTransaksiIndex')->with('success','Setor Berhasil');
        }elseif($user->role_id == 3){

            return redirect()->route('ht.htIndex')->with('success','Setor Berhasil');
        }


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
                return redirect()->back()->with('success','Penarikan Berhasil');
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
