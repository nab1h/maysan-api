<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.articles.index') }}" class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">تعديل المقال</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">
                <div class="flex items-center gap-2 mb-2 font-semibold"><i class="fa-solid fa-circle-exclamation"></i> يرجى تصحيح الأخطاء:</div>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 sm:p-8">
                <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-2">القسم <span class="text-red-500">*</span></label>
                            <select name="department_id" id="department_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition bg-white">
                                @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $article->department_id) == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">عنوان المقال <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="slug" class="block text-sm font-semibold text-gray-700 mb-2">الرابط اللطيف (Slug) <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-400 whitespace-nowrap">articles/</span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug) }}" dir="ltr" class="flex-1 border border-gray-300 rounded-lg px-4 py-3 text-left focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition font-mono text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">صورة الغلاف</label>
                            <div class="flex items-center gap-3">
                                @if($article->image)
                                <img src="{{ Storage::url($article->image) }}" class="w-16 h-10 rounded-lg object-cover border border-gray-200">
                                @endif
                                <input type="file" name="image" accept="image/*" class="flex-1 text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#135158]/10 file:text-[#135158] hover:file:bg-[#135158]/20 transition cursor-pointer">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fa-solid fa-file-word text-blue-500 ml-1"></i> استبدال بملف وورد
                            </label>
                            <input type="file" name="docx_file" accept=".docx" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 text-blue-700 hover:file:bg-blue-100 transition cursor-pointer">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">ملخص قصير</label>
                        <textarea name="excerpt" id="excerpt" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition resize-none">{{ old('excerpt', $article->excerpt) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">محتوى المقال</label>
                        <textarea name="content" id="content" rows="15" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#135158]/20 focus:border-[#135158] transition">{{ old('content', $article->content) }}</textarea>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center gap-2 bg-[#135158] text-white px-6 py-3 rounded-lg hover:bg-[#0a3a40] transition font-semibold">
                            <i class="fa-solid fa-check text-sm"></i> تحديث المقال
                        </button>
                        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-600 px-6 py-3 rounded-lg hover:bg-gray-200 transition font-semibold">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.1.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                language: 'ar',
                toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link', 'blockQuote', 'insertTable', '|', 'undo', 'redo'],
            })
            .then(editor => {
                writer.setAttribute('dir', 'rtl', editor.editing.view.document.getRoot());
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
