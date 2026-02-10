<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = ['title', 'description', 'image', 'link', 'architecture', 'duration', 'gallery'];
    protected $casts = ['gallery' => 'array'];
}
