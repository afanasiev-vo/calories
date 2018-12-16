<?php
/**
 * Created by PhpStorm.
 * User: afanasievv
 * Date: 07.12.18
 * Time: 22:55
 */

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        factory(\App\User::class, 3)->create();
    }
}
