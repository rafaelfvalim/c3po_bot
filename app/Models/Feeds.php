<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeds extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao' , 'tipo', 'url', 'channelid', 'grupo'];
}
