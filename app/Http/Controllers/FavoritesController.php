<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Question $question)
    {
        //dd('store');
        $question->favorites()->attach(auth()->id());

        return back();
    }

    public function destroy(Question $question)
    {
        //dd('delete');
        $question->favorites()->detach(auth()->id());

        return back();

    }
}
