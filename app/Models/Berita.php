<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'berita';
    protected $fillable = [
        'title','slug','excerpt','body','status','cover_path',
        'category','meta_title','meta_description','published_at',
        'created_by','updated_by','published_by',
    ];

    protected $casts = ['published_at' => 'datetime'];

    public function getRouteKeyName(): string { return 'slug'; }
    public function scopePublished($q) { return $q->where('status','published'); }

    public function author()   { return $this->belongsTo(User::class, 'created_by'); }
    public function editor()   { return $this->belongsTo(User::class, 'updated_by'); }
    public function publisher(){ return $this->belongsTo(User::class, 'published_by'); }
}
