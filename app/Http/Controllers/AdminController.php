<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function show(){
        $attendances = Attendance::with('person')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Dashboard', compact('attendances'));
    }
}
