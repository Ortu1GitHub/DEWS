<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('students')->insert([
            'name'=> 'Juan',
            'phone'=> '610000000',
            'age'=>44,
            'pass'=>'1111',
            'email'=>'juan@hotmail.com',
            'gender'=>'M'
        ]);

        DB::table('students')->insert([
            'name'=> 'Maria',
            'phone'=> '610000001',
            'age'=>45,
            'pass'=>'1112',
            'email'=>'maria@hotmail.com',
            'gender'=>'F'
        ]);

        DB::table('students')->insert([
            'name'=> 'Luis',
            'phone'=> '610000002',
            'age'=>35,
            'pass'=>'1113',
            'email'=>'luis@hotmail.com',
            'gender'=>'M'
        ]);
    }
}
