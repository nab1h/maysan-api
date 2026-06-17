<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Department;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $query = Article::with('department')->latest();

        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });
        }

        $articles = $query->paginate(9);

        $articles->appends($request->query());

        $departments = Department::withCount('articles')->get();

        return view('articles.index', compact('articles', 'departments'));
    }


    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $article->increment('views');

        $relatedArticles = Article::where('department_id', $article->department_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        $latestArticles = Article::latest()->take(4)->get();

        return view('articles.show', compact('article', 'relatedArticles', 'latestArticles'));
    }
}
