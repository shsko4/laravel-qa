<?php

namespace App\Models;

use purifier;
use Parsedown;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\votableTrait;
use PhpParser\Builder\Function_;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title','body'];

    use votableTrait;

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function setTitleAttribute($value){

        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function getUrlAttribute()
    {
        return route('questions.show',$this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if($this->answers_count > 0){

            if($this->best_answer_id){

                return 'answer-accepted';

            }

            return 'answered';
        }

        return 'unanswered';




    }

    public function getBodyHtmlAttribute()
    {
        return purifier::clean($this->bodyHtml());

    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function acceptBestAnswer(Answer $answer)
    {
        if($this->best_answer_id === $answer->id){

            $this->best_answer_id = NULL;
            $this->save();

        }else{

            $this->best_answer_id = $answer->id;
            $this->save();
        }

    }

    public function favorites()
    {
        return $this->belongsToMany(User::class,'favorites')->withTimestamps();
    }

    public function isFavorited()
    {
            return $this->favorites()->where('user_id',auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getfavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function getExcerptAttribute()
    {
        return $this->excerpt(250); ;
    }

    private function bodyHtml()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function excerpt($limit)
    {
        return str_limit(strip_tags($this->bodyHtml()), $limit);
    }


}
