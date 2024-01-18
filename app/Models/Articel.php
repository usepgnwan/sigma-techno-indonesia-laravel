<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;   


class Articel extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded = ['id'];
    protected $with = ['category'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
}
