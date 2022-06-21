<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('users')->delete();
        
        User::factory()->times(3)->create()->each(function($u){

            $u->questions()->saveMany(Question::factory()->times(rand(1,5))->make())->each(function($q){
                $q->answers()->saveMany(Answer::factory()->times(rand(1,5))->make());
            });

        });
    }
}
