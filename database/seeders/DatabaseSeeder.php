<?php

namespace Database\Seeders;

use App\Models\Answer;
use Faker\Factory;
use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->times(3)->create()->each(function($u){

            $u->questions()->saveMany(Question::factory()->times(rand(1,5))->make())->each(function($q){
                $q->answers()->saveMany(Answer::factory()->times(rand(1,5))->make());
            });

        });
        //Question::factory()->times(3)->create();
    }
}
