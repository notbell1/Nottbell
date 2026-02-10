@extends('layouts.admin')

@section('admin_content')
<div class="max-w-4xl mx-auto py-8">
    {{-- Header Page --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Create News</h1>
            <p class="text-slate-500 text-sm">Write and publish your latest stories to the world.</p>
        </div>
        <a href="{{ route('admin.news.index') }}" class="text-slate-400 hover:text-slate-900 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </a>
    </div>

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="bg-white p-10 rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100">
            <div class="space-y-8">

                {{-- TITLE --}}
                <div class="group">
                    <label class="block text-[10px] font-black text-slate-400 mb-3 uppercase tracking-[0.2em] group-focus-within:text-blue-600 transition-colors">Article Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="w-full p-5 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all text-lg font-bold text-slate-800 placeholder:font-normal"
                           placeholder="Enter a catchy title..." required>
                    @error('title') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- CATEGORY --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 mb-3 uppercase tracking-[0.2em]">Category</label>
                        <div class="relative">
                            <select name="category" class="w-full p-5 bg-slate-50 border-2 border-slate-50 rounded-2xl focus:bg-white focus:border-blue-500 outline-none appearance-none font-bold text-slate-700 cursor-pointer">
                                <option value="Technology">Technology</option>
                                <option value="Development">Development</option>
                                <option value="UI/UX Design">UI/UX Design</option>
                                <option value="Personal Update">Personal Update</option>
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    {{-- THUMBNAIL --}}
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 mb-3 uppercase tracking-[0.2em]">Thumbnail Image</label>
                        <div class="relative group">
                            <input type="file" name="thumbnail" id="thumbnail-input"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>
                            <div class="p-4 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl text-center group-hover:border-blue-400 transition-all flex items-center justify-center gap-3">
                                <i class="fas fa-cloud-upload-alt text-slate-400 group-hover:text-blue-500"></i>
                                <span class="text-sm font-bold text-slate-500 group-hover:text-blue-600" id="file-name">Upload Image</span>
                            </div>
                        </div>
                        @error('thumbnail') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- HIDDEN AUTHOR (Set to Nottbell by default) --}}
                <input type="hidden" name="author" value="Nottbell">

                {{-- CONTENT --}}
                <div>
                    <label class="block text-[10px] font-black text-slate-400 mb-3 uppercase tracking-[0.2em]">Main Content</label>
                    <textarea name="content" rows="12"
                              class="w-full p-6 bg-slate-50 border-2 border-slate-50 rounded-3xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all text-slate-700 leading-relaxed font-medium"
                              placeholder="Once upon a time...">{{ old('content') }}</textarea>
                    @error('content') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex items-center gap-4">
            <button type="submit" class="flex-grow bg-slate-900 text-white font-black py-5 rounded-[2rem] hover:bg-blue-600 shadow-2xl shadow-blue-200 transition-all transform hover:-translate-y-1 uppercase tracking-widest text-sm">
                Publish Article
            </button>
            <button type="button" onclick="window.history.back()" class="px-10 bg-white text-slate-400 font-bold py-5 rounded-[2rem] border border-slate-100 hover:bg-slate-50 transition-all uppercase tracking-widest text-sm">
                Cancel
            </button>
        </div>
    </form>
</div>

{{-- Script simple untuk ganti teks saat upload --}}
<script>
    document.getElementById('thumbnail-input').onchange = function() {
        let fullPath = this.value;
        if (fullPath) {
            let startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            let filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            document.getElementById('file-name').textContent = filename;
        }
    };
</script>
@endsection
