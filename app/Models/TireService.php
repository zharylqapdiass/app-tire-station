<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class TireService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'room_count',
        'floor',
        'area',
        'description',
    ];
}
