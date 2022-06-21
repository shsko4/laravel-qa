<?php
namespace App\Models;
trait votableTrait
{
    public function votes()
    {
        return $this->morphToMany(User::class,'votable')->withTimestamps();
    }

    public function downVotes()
    {
        return $this->votes()->wherePivot('vote',-1);
    }

    public function upVotes()
    {
        return $this->votes()->wherePivot('vote',1);
    }
}



?>
