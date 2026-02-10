<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller {

    public function index() {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create() {
        return view('admin.projects.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|max:2048',
            'gallery.*' => 'image|max:2048',
            'description' => 'required'
        ]);

        $path = $request->file('image')->store('projects', 'public');

        $galleryPaths = [];
        if($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('projects/gallery', 'public');
            }
        }

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
            'link' => $request->link,
            'architecture' => $request->architecture,
            'duration' => $request->duration,
            'gallery' => $galleryPaths
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project) {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project) {
        // 1. Validasi semua field yang mungkin masuk
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        try {
            // 2. Masukkan SEMUA field ke dalam array data
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
                'architecture' => $request->architecture, // Tambahkan ini
                'duration' => $request->duration,         // Tambahkan ini
            ];

            // 3. Handle Update Thumbnail Utama
            if ($request->hasFile('image')) {
                if($project->image) Storage::disk('public')->delete($project->image);
                $data['image'] = $request->file('image')->store('projects', 'public');
            }

            // 4. Handle Update Gallery (Multiple)
            if ($request->hasFile('gallery')) {
                // Hapus gallery lama jika Anda ingin mengganti semua foto gallery
                if($project->gallery) {
                    foreach($project->gallery as $oldGallery) {
                        Storage::disk('public')->delete($oldGallery);
                    }
                }

                $galleryPaths = [];
                foreach($request->file('gallery') as $file) {
                    $galleryPaths[] = $file->store('projects/gallery', 'public');
                }
                $data['gallery'] = $galleryPaths;
            }

            // 5. Eksekusi Update
            $project->update($data);

            return redirect()->route('admin.projects.index')->with('success', 'Project Berhasil Diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Gagal update: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Project $project) {
        try {
            if($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            // Hapus juga gallery dari storage saat project dihapus
            if($project->gallery) {
                foreach($project->gallery as $gal) {
                    Storage::disk('public')->delete($gal);
                }
            }
            $project->delete();
            return back()->with('success', 'Project Berhasil Dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Gagal hapus: ' . $e->getMessage()]);
        }
    }
}
