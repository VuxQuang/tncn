<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use HasFactory;

    protected $table = 'vocabulary'; // Tên bảng

    protected $fillable = ['word', 'meaning', 'example'];
}
