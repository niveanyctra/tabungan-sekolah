<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Vocational;
use App\Models\transaction;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $users = User::all()->count();
        $vocationals = Vocational::all()->count();
        $classrooms = Classroom::all()->count();
        $students = StudentProfile::all()->count();
        $tidak_aktif = User::where('role_id', 4)->where('status', false)->get();

        $status = User::with(['student', 'student.classroom', 'student.classroom.vocational'])
            ->where('role_id', 4)
            ->where('status', false)
            ->orderby('status')
            ->limit(10)
            ->latest('updated_at')
            ->get();

        $trans = transaction::with('user')
            ->where('status', false)
            ->orderby('created_at')
            ->orderby('status')
            ->limit(10)
            ->get()
            ->sortBy('status');

        $chartData = [
            'bulan' => [], // Add your month data here
            'type' => [
                'Setor' => [],
                'Tarik' => [],
            ],
        ];
        // Fetch data for each month
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        foreach ($months as $month) {
            // Calculate total transactions for 'Setor' and 'Tarik' for each month
            $setorTotal = Transaction::where('type', 'Setor')->where('status',true)->whereMonth('updated_at', '=', date('n', strtotime($month)))->sum('amount');
            $tarikTotal = Transaction::where('type', 'Tarik')->where('status',true)->whereMonth('updated_at', '=', date('n', strtotime($month)))->sum('amount');
            $chartData['bulan'][] = $month;
            $chartData['type']['Setor'][] = $setorTotal;
            $chartData['type']['Tarik'][] = $tarikTotal;
        }

        return view('backend.admin.dashboard', compact('users', 'vocationals', 'classrooms', 'students', 'status', 'trans', 'tidak_aktif', 'chartData'));
    }

    public function teacherDashboard()
    {
        $teacher = Auth::user();
        $kelas = Classroom::with('ht')->where('ht_id',$teacher->id)->first();
        $students = StudentProfile::with('classroom')->whereRelation('classroom', 'ht_id',$teacher->id)->get()->count();
        $masuk = transaction::with(['user', 'user.student'])->where('status',true)->where('type', 'Setor')->whereRelation('user.student', 'classroom_id', $kelas->id)->get();
        $tarik = transaction::with(['user', 'user.student'])->where('status',true)->where('type', 'Tarik')->whereRelation('user.student', 'classroom_id', $kelas->id)->get();

        $chartData = [
            'bulan' => [], // Add your month data here
            'type' => [
                'Setor' => [],
                'Tarik' => [],
            ],
        ];
        // Fetch data for each month
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        foreach ($months as $month) {
            // Calculate total transactions for 'Setor' and 'Tarik' for each month
            $setorTotal = Transaction::with(['user', 'user.student'])->where('type', 'Setor')->where('status',true)->whereMonth('updated_at', '=', date('n', strtotime($month)))->whereRelation('user.student', 'classroom_id', $kelas->id)->sum('amount');
            $tarikTotal = Transaction::with(['user', 'user.student'])->where('type', 'Tarik')->where('status',true)->whereMonth('updated_at', '=', date('n', strtotime($month)))->whereRelation('user.student', 'classroom_id', $kelas->id)->sum('amount');
            $chartData['bulan'][] = $month;
            $chartData['type']['Setor'][] = $setorTotal;
            $chartData['type']['Tarik'][] = $tarikTotal;
        }

        return view('backend.homeroom-teacher.dashboard', compact('teacher', 'kelas', 'students', 'masuk', 'tarik', 'chartData'));
    }
}
