@extends('layouts.admin')

@section('admin_content')
<div class="max-w-4xl mx-auto animate__animated animate__fadeInUp">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">New Project</h2>
            <p class="text-slate-500 text-sm">Lengkapi detail project untuk hasil yang maksimal.</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="text-slate-400 hover:text-slate-600 font-medium">Cancel</a>
    </div>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Project Title</label>
                    <input type="text" name="title" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-cyan-500 outline-none transition-all" placeholder="E-Commerce App" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Live Link (URL)</label>
                    <input type="url" name="link" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-cyan-500 outline-none transition-all" placeholder="https://example.com">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Architecture</label>
                    <input type="text" name="architecture" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-cyan-500 outline-none transition-all" placeholder="e.g. MVC, Microservices">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Duration</label>
                    <input type="text" name="duration" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-cyan-500 outline-none transition-all" placeholder="e.g. 2 Weeks">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Main Thumbnail</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-200 border-dashed rounded-2xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all">
                        <span class="text-slate-400 text-sm">Click to upload thumbnail</span>
                        <input type="file" name="image" class="hidden" required />
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Project Gallery (Multiple)</label>
                <input type="file" name="gallery[]" multiple class="w-full p-3 bg-slate-50 border border-slate-100 rounded-2xl">
                <p class="text-[10px] text-slate-400 mt-2 italic">*Pilih beberapa file sekaligus untuk dokumentasi project.</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Full Description</label>
                <textarea name="description" rows="6" class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-cyan-500 outline-none transition-all" placeholder="Describe the project process, challenges, and tech stack..."></textarea>
            </div>
        </div>

        <button type="submit" class="w-full bg-slate-900 text-white font-bold py-5 rounded-3xl hover:bg-cyan-600 shadow-xl transition-all transform hover:-translate-y-1">
            Publish Project to Portfolio
        </button>
    </form>
</div>
@endsection
