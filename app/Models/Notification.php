<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'is_read'];

    protected $dates = ['created_at', 'updated_at'];

    public $timestamps = false;
}

