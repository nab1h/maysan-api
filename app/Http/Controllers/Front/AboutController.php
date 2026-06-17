<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\HomeContent;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $image = Media::where('type', 'hero_image')->first();
        $content = HomeContent::firstOrCreate(['id' => 1]);
        return view('pages.about',compact('image', 'content'));
    }
}
