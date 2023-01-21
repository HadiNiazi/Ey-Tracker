<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $waitingStudentsCount = Student::where('type', 'waiting')->count();
        $currentStudentsCount = Student::where('type', 'current')->count();
        $leavedStudentsCount = Student::where('type', 'leaved')->count();
        $graduatedStudentsCount = Student::where('type', 'graduated')->count();

        return view('admin.dashboard', [
            'waitingStudentsCount' => $waitingStudentsCount, 'currentStudentsCount' => $currentStudentsCount, 
            'leavedStudentsCount' => $leavedStudentsCount, 'graduatedStudentsCount' => $graduatedStudentsCount
        ]);
    }
}
