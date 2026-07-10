<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    protected $fillable = ['name', 'content', 'photo_path', 'is_active'];
}
