<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller {

    public function index() {
        $news = News::latest()->get();
        return view('admin.news.index', compact('news'));
    }

    public function create() {
        return view('admin.news.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'content' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        try {
            $path = $request->file('thumbnail')->store('news', 'public');

            // 1. Logika Author Bersih
            $authorName = 'Nottbell';
            if (Auth::check()) {
                $authorName = str_replace(['Admin ', 'admin '], '', Auth::user()->name);
            }

            // 2. Logika Smart Slug (Mencegah Duplikat tanpa Random String)
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;

            while (News::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            News::create([
                'title' => $request->title,
                'slug' => $slug,
                'category' => $request->category,
                'content' => $request->content,
                'author' => $authorName,
                'thumbnail' => $path
            ]);

            return redirect()->route('admin.news.index')->with('success', 'Berita Berhasil Terbit!');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Gagal: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(News $news) {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news) {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        try {
            $data = [
                'title' => $request->title,
                'category' => $request->category,
                'content' => $request->content,
            ];

            // 3. Logika Update Slug (Hanya jika judul berubah)
            if ($news->title !== $request->title) {
                $slug = Str::slug($request->title);
                $originalSlug = $slug;
                $count = 1;

                while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }
                $data['slug'] = $slug;
            }

            if ($request->hasFile('thumbnail')) {
                if($news->thumbnail) Storage::disk('public')->delete($news->thumbnail);
                $data['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
            }

            $news->update($data);
            return redirect()->route('admin.news.index')->with('success', 'Berita Berhasil Diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Gagal update: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(News $news) {
        if($news->thumbnail) Storage::disk('public')->delete($news->thumbnail);
        $news->delete();
        return back()->with('success', 'Berita Telah Dihapus!');
    }
}