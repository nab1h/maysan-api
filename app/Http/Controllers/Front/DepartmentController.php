<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;


class DepartmentController extends Controller
{
    public function showServices(Department $department)
    {
        $department->load('services');
        return view('pages.services', compact('department'));
    }
}
