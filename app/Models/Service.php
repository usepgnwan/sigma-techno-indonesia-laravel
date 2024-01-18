<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['artikel'];
    public function artikel()
    {
        return $this->belongsTo(Articel::class, 'id_articel');
    }
}
