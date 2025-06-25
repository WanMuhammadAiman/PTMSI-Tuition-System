<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Show list of all students.
     */
    public function listStudents()
    {
        $students = User::where('role', 'student')->paginate(10);
        return view('admin.index', compact('students'));
    }

    /**
     * Show detailed info for a single student.
     */
    public function viewStudent($id)
{
    $student = \App\Models\User::with(['enrolments.subject'])->findOrFail($id);
    return view('admin.view', compact('student'));
}

}
