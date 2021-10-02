<?php

namespace Database\Seeders;

use Carbon\Traits\Date;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<=5;$i++) {
            DB::table('students')->insert([
                'firstName' => Str::random(10),
                'lastName' => Str::random(10),
                'birth' => Carbon::yesterday(),
                'enrollment' => Carbon::yesterday(),
                'credits' => 0,
            ]);
        }
    }
}
