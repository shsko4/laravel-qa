<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillabl = ['title','body'];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function setTitleAttribute($value){

        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value, '-');
    }


}
