<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('department')->latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.articles.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title'         => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:articles,slug',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'excerpt'       => 'nullable|string',
            'content'       => 'nullable|string',
            'docx_file'     => 'nullable|mimes:docx|max:5120', // حد أقصى 5MB
        ], [
            'department_id.required' => 'يرجى اختيار القسم',
            'title.required'        => 'عنوان المقال مطلوب',
            'slug.required'         => 'الرابط اللطيف مطلوب',
            'slug.unique'           => 'هذا الرابط مستخدم بالفعل',
            'docx_file.mimes'       => 'يجب أن يكون الملف بصيغة docx',
        ]);

        $data = $request->except(['image', 'docx_file']);
        $data['slug'] = Str::slug($request->slug);

        if ($request->hasFile('docx_file')) {
            $data['content'] = $this->parseDocx($request->file('docx_file'));
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')
            ->with('status', 'تم إضافة المقال بنجاح');
    }

    public function edit(Article $article)
    {
        $departments = Department::all();
        return view('admin.articles.edit', compact('article', 'departments'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title'         => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:articles,slug,' . $article->id,
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'excerpt'       => 'nullable|string',
            'content'       => 'nullable|string',
            'docx_file'     => 'nullable|mimes:docx|max:20120',
        ]);

        $data = $request->except(['image', 'docx_file']);
        $data['slug'] = Str::slug($request->slug);

        if ($request->hasFile('docx_file')) {
            $data['content'] = $this->parseDocx($request->file('docx_file'));
        }

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('status', 'تم تحديث المقال بنجاح');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('status', 'تم حذف المقال بنجاح');
    }


    private function parseDocx($file)
    {
        $phpWord = IOFactory::load($file->getPathname());
        $html = '';

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) {
                    $text = $element->getText();
                    if (is_array($text)) {
                        $text = implode(' ', $text);
                    }
                    $html .= '<p>' . trim($text) . '</p>';
                } elseif (method_exists($element, 'getElements')) {
                    foreach ($element->getElements() as $childElement) {
                        if (method_exists($childElement, 'getText')) {
                            $text = $childElement->getText();
                            if (is_array($text)) {
                                $text = implode(' ', $text);
                            }
                            $html .= '<p>' . trim($text) . '</p>';
                        }
                    }
                }
            }
        }

        return $html;
    }
}
