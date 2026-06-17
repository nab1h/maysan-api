<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchesController extends Controller
{
    public function Index(){
        return view('pages.branches');
    }
    public function show(Branch $branch)
    {
        $branch->load(['doctors', 'reels', 'location']);

        return view('pages.showbranches', compact('branch'));
    }
}
