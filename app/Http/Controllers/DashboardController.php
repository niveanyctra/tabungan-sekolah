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
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get();

        $masukYear = transaction::where('status',true)->where('type', 'Setor')
            ->whereYear('updated_at', '=', Carbon::now())
            ->get();
        $tarikYear = transaction::where('status',true)->where('type', 'Tarik')
            ->whereYear('updated_at', '=', Carbon::now())
            ->get();
        $totalYear = $masukYear->sum('amount') - $tarikYear->sum('amount');

        $masukMonth = transaction::where('status',true)->where('type', 'Setor')
            ->whereMonth('updated_at', '=', Carbon::now())
            ->get();
        $tarikMonth = transaction::where('status',true)->where('type', 'Tarik')
            ->whereMonth('updated_at', '=', Carbon::now())
            ->get();
        $totalMonth = $masukMonth->sum('amount') - $tarikMonth->sum('amount');

        $chartData = [
            'bulan' => [], // Add your month data here
            'type' => [
                'Setor' => [],
                'Tarik' => [],
            ],
        ];
        // Fetch data for each month
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        foreach ($months as $month) {
            // Get the first and last day of the month
            $firstDayOfMonth = date('Y-m-d', strtotime("first day of $month"));
            $lastDayOfMonth = date('Y-m-d', strtotime("last day of $month"));

            // Calculate total transactions for 'Setor' and 'Tarik' for each month
            $setorTotal = Transaction::where('type', 'Setor')
                ->whereBetween('updated_at', [$firstDayOfMonth, $lastDayOfMonth])
                ->where('status',true)
                ->sum('amount');

            $tarikTotal = Transaction::where('type', 'Tarik')
                ->whereBetween('updated_at', [$firstDayOfMonth, $lastDayOfMonth])
                ->where('status',true)
                ->sum('amount');

            $chartData['bulan'][] = $month;
            $chartData['type']['Setor'][] = $setorTotal;
            $chartData['type']['Tarik'][] = $tarikTotal;
        }

        return view('backend.admin.dashboard', compact('users', 'vocationals', 'classrooms', 'students', 'status', 'trans', 'tidak_aktif', 'masukYear', 'tarikYear', 'totalYear', 'masukMonth', 'tarikMonth', 'totalMonth', 'chartData'));
    }

    public function teacherDashboard()
    {
        $teacher = Auth::user();
        $kelas = Classroom::with('ht')->where('ht_id',$teacher->id)->first();
        $students = StudentProfile::with('classroom')->whereRelation('classroom', 'ht_id',$teacher->id)->get()->count();

        $chartData = [
            'bulan' => [], // Add your month data here
            'type' => [
                'Setor' => [],
                'Tarik' => [],
            ],
        ];
        // Fetch data for each month
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        foreach ($months as $month) {
            // Get the first and last day of the month
            $firstDayOfMonth = date('Y-m-d', strtotime("first day of $month"));
            $lastDayOfMonth = date('Y-m-d', strtotime("last day of $month"));

            // Calculate total transactions for 'Setor' and 'Tarik' for each month
            $setorTotal = Transaction::with(['user', 'user.student'])
                ->where('type', 'Setor')
                ->whereBetween('updated_at', [$firstDayOfMonth, $lastDayOfMonth])
                ->where('status',true)
                ->whereRelation('user.student', 'classroom_id', $kelas->id)
                ->sum('amount');

            $tarikTotal = Transaction::with(['user', 'user.student'])
                ->where('type', 'Tarik')
                ->whereBetween('updated_at', [$firstDayOfMonth, $lastDayOfMonth])
                ->where('status',true)
                ->whereRelation('user.student', 'classroom_id', $kelas->id)
                ->sum('amount');

            $chartData['bulan'][] = $month;
            $chartData['type']['Setor'][] = $setorTotal;
            $chartData['type']['Tarik'][] = $tarikTotal;
        }
        $masuk = transaction::with(['user', 'user.student'])
            ->where('status',true)->where('type', 'Setor')
            ->whereRelation('user.student', 'classroom_id', $kelas->id)
            ->whereMonth('updated_at', '=', Carbon::now())
            ->get();
        $tarik = transaction::with(['user', 'user.student'])
            ->where('status',true)->where('type', 'Tarik')
            ->whereRelation('user.student', 'classroom_id', $kelas->id)
            ->whereMonth('updated_at', '=', Carbon::now())
            ->get();

        return view('backend.homeroom-teacher.dashboard', compact('teacher', 'kelas', 'students', 'masuk', 'tarik', 'chartData'));
    }
}
