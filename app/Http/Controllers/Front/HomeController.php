<?php

namespace App\Http\Controllers\Front;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\Faq;
use App\Models\Media;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $setting= Setting::first();
        $content = HomeContent::firstOrCreate(['id' => 1]);
        $faqs = Faq::where('is_active', true)->get();
        $heroVideo = Media::where('type', 'hero_video')->where('is_active', true)->first();
        $heroImage = Media::where('type', 'hero_image')->where('is_active', true)->first();
        $galleryImages = Media::where('type', 'gallery_image')->where('is_active', true)->ordered()->get();
        $stats = Statistic::orderBy('sort_order')->get();
        $testimonials = Testimonial::where('is_active', true)
            ->latest()
            ->get();
        $latestArticles = Article::with('department')->latest()->take(3)->get();
        return view('home',compact('setting', 'latestArticles', 'stats', 'content', 'faqs',  'heroVideo', 'heroImage', 'galleryImages', 'testimonials'));
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privcy()
    {
        return view('pages.privcy');
    }
}
