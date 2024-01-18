<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesPackets extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    public function categories()
    {
        return $this->hasMany(Category::class, 'id');
    }

    public function packet()
    {
        return $this->hasMany(Packet::class, 'id');
    }
}
