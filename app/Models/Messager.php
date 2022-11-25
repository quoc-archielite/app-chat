<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messager extends Model
{
    use HasFactory;
    protected $table = 'messagers';

    protected $fillable = [
        'id_sender',
        'id_receiver',
        'content',
    ];
}
