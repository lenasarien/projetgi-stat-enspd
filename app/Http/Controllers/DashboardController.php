<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Department;
use App\Models\Filiere;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard(Request $req) {
        $Y = $req->year ?? now()->year;
        $students = Student::count();
        $filieres = Filiere::count();
        $departments = Department::count();
        $cycles = Cycle::count();

        return view('dashboard', compact('students', 'filieres', 'departments', 'cycles'));
    }
}
