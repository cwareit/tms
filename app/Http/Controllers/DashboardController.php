<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $total_schools = User::where('type', 'school')->count();
        $schools_by_type = User::where('type', 'school')->groupBy('school_type')->selectRaw('count(*) as count, school_type')->get();


        $total_teachers = Teacher::count();
        $teachers_by_type = Teacher::groupBy('type')->selectRaw('count(*) as count, type')->get();
        $teachers_by_level = Teacher::groupBy('level')->selectRaw('count(*) as count, level')->get();
        $teachers_by_type_and_level = Teacher::groupBy('type', 'level')->selectRaw('count(*) as count, type, level')->get();
        return view('dashboard.dashboard',[
            'total_schools' => $total_schools,
            'schools_by_type' => $schools_by_type,
            'total_teachers' => $total_teachers,
            'teachers_by_type' => $teachers_by_type,
            'teachers_by_level' => $teachers_by_level,
            'teachers_by_type_and_level' => $teachers_by_type_and_level,
        ]);
    }
}
