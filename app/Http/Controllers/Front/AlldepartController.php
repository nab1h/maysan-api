<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlldepartController extends Controller
{
    public function index(){
        return view('pages.alldepartments');
    }
}
