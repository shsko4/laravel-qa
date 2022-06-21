<?php

namespace App\Models;

use App\Models\Question;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions(){

        return $this->hasMany(Question::class);

    }

    public function getUrlAttribute()
    {
        //return route('questions.show',$this->id);
        return '#';
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 25;
        $avUrl = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
        return $avUrl;
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class,'favorites')->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class,'votable')->withTimestamps();
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class,'votable');
    }

    public function voteQuestion(Question $question,$vote)
    {
        $voteQuestions = $this->voteQuestions();

        if($voteQuestions->where('votable_id',$question->id)->exists()){

            $voteQuestions->updateExistingPivot($question,['vote' => $vote]);
        }
        else{
            $voteQuestions->attach($question,['vote' => $vote]);
        }

        $question->load('votes');
        $downVotes = (int) $question->downVotes()->sum('vote');
        $upVotes = (int) $question->upVotes()->sum('vote');

        $question->votes_count = $upVotes + $downVotes;
        $question->save();
    }

    public function voteAnswer(Answer $answer,$vote)
    {
        $voteAnswer = $this->voteAnswers();

        if($voteAnswer->where('votable_id',$answer->id)->exists()){

            $voteAnswer->updateExistingPivot($answer,['vote' => $vote]);
        }
        else{
            $voteAnswer->attach($answer,['vote' => $vote]);
        }

        $answer->load('votes');
        $downVotes = (int) $answer->downVotes()->sum('vote');
        $upVotes = (int) $answer->upVotes()->sum('vote');

        $answer->votes_count = $upVotes + $downVotes;
        $answer->save();
    }


}
