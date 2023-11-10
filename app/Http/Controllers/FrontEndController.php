<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function getKelasByJurusan($vocational_id)
    {
        $kelas = Classroom::where('vocational_id', $vocational_id)->get();
        return response()->json($kelas);
    }
}
