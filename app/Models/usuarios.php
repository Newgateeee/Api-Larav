<?php

namespace App\Models;
use HasApiTokens, Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    use HasFactory;
    protected $fillable=['name','usuario','pass'];
}
