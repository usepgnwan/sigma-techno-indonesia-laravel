<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['category'];
    public function category()
    {
        return $this->belongsToMany(Category::class, 'categories_packets','packet_id','categori_id');
    }
}
