<?php

namespace Tests\Feature;

use App\User;
use Faker\Provider\Image;
use Faker\Provider\Lorem;
use Faker\Provider\Text;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientTest extends TestCase
{
//    use RefreshDatabase;
    private $users = [];
    private $calories = [];
    private $ingredients = [];
    /**
     * A basic test example.
     * @testdox GET /ingredient get all ingredients
     * @return void
     */
    public function testGetAll()
    {
        //$this->seed('UserTableSeeder');
        for ($i = 0; $i < 10; $i++) {
            $this->setData();
        }

        $response = $this->get('/ingredient');

        $response
            ->assertStatus(200)
            ->assertJson([
                'current_page' => 1,
            ]);
        $this->markTestIncomplete(
            'Этот тест ещё не реализован.'
        );
    }

    /**
     * @testdox GET /ingredient?page=2 get all ingredients by page 2
     */
    public function testGetPageTwo()
    {
        $response = $this->get('/ingredient?page=2');
        $response
            ->assertStatus(200)
            ->assertJson([
                'current_page' => 2,
            ]);
    }

    private function setData()
    {
        $userData = [
            'name' => 'user_' . str_random(10),
            'email' => str_random(10) . '@calories.com',
            'email_verified_at' => now(),
            'password' => app('hash')->make('12345'),
            'remember_token' => str_random(10)
        ];
        $user = DB::table('users')->insertGetId($userData);

        $calories = DB::table('calories')->insertGetId([
            'calories' => floatVal(rand(1, 30) . '.' . rand(1, 9)),
            'proteins' => floatVal(rand(1, 30) . '.' . rand(1, 9)),
            'fats' => floatVal(rand(1, 30) . '.' . rand(1, 9)),
            'carbohydrates' => floatVal(rand(1, 30) . '.' . rand(1, 9)),
            'gi' => rand(1, 100)
        ]);
        Log::info('calories ' . $calories);

        $ingredientData = [
            'name' => str_random(10),
            'thumbnail' => Image::imageUrl(),
            'description' => Lorem::text(),
            'state' => 'raw',
            'status' => \App\Ingredient::ACTIVE,
            'owner_id' => $user,
            'calories_id' => $calories
        ];
        DB::table('ingredients')->insert($ingredientData);
    }
}
