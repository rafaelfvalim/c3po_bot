<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramMembros extends Model
{
    use HasFactory;
    protected $fillable = ['grupo', 'qte'];

}
