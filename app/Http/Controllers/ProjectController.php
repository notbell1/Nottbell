<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\News;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        // Mengambil semua project untuk diserahkan ke Alpine.js
        $projects = Project::latest()->get();

        // Ambil berita dengan pagination untuk kebutuhan fetch AJAX di sliding window
        $news = News::latest()->paginate(4);

        return view('index', compact('projects', 'news'));
    }

    public function show($id) {
    $project = Project::findOrFail($id);

    // Ambil project sebelumnya dan setelahnya
    $previous = Project::where('id', '<', $project->id)->orderBy('id', 'desc')->first();
    $next = Project::where('id', '>', $project->id)->orderBy('id', 'asc')->first();

    return view('project-detail', compact('project', 'previous', 'next'));
}

    public function showNews($slugOrId) {
        // Cek apakah yang dikirim Slug atau ID agar tidak 404
        $news = News::where('slug', $slugOrId)
                    ->orWhere('id', $slugOrId)
                    ->firstOrFail();

        // Navigasi Next & Prev berdasarkan ID
        $previous = News::where('id', '<', $news->id)->orderBy('id', 'desc')->first();
        $next = News::where('id', '>', $news->id)->orderBy('id', 'asc')->first();

        return view('news-detail', compact('news', 'previous', 'next'));
    }
}