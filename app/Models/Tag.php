<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Tag extends Model
{
    use HasFactory;
    protected $primaryKey = 'name';
    protected $fillable = ['name'];
    protected $keyType = 'string';
    
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
