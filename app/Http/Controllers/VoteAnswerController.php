<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;


class VoteAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Answer $answer)
    {
        $vote = request()->vote;
        
        auth()->user()->voteAnswer($answer,$vote);

        return back();
    }
}
