<?php

namespace Database\Seeders;

use Carbon\Traits\Date;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class DBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i <= 5; $i++) {
            DB::table('teachers')->insert([
                'firstName' => Str::random(10),
                'lastName' => Str::random(10),
                'birth' => Carbon::yesterday(),
            ]);
        }

        for ($i = 0; $i <= 5; $i++) {
            DB::table('students')->insert([
                'firstName' => Str::random(10),
                'lastName' => Str::random(10),
                'birth' => Carbon::yesterday(),
                'enrollment' => Carbon::yesterday(),
                'credits' => 0,
            ]);

            /*
            DB::table('subjects')->insert([
                'name' => Str::random(10),
                'credits' => rand(1, 10),
                'semester' => rand(1, 2),
                'garant' => rand(1, 5),
            ]);
            */

            DB::table('groups')->insert([
                'code' => Str::random(10),
                'semester' => rand(1, 2),
            ]);
        }
        /*
        for ($i = 0; $i <= 5; $i++) {
            $owner = $faker->randomElement(DB::table('subjects')->pluck('id'));
            $prereq = $faker->randomElement(DB::table('subjects')->pluck('id')->whereNotIn('id',$owner));
            DB::table('prerequisites')->insert([
                'owner' => $owner,
                'prereq' => $prereq,
            ]);
        }
        */
    }
}
