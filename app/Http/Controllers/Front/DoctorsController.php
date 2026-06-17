<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index(){
        return view('pages.doctors');
    }
}
