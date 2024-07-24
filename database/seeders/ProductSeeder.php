<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['user_id' => 1,
            'name' => 'Aqua',
             'type' => 'Beverages',
             'stock' => 50,
             'description' => 'Aqua.',
             'image' => 'aqua.jpg'],
             
             ['user_id' => 1,
             'name' => 'Chiki',
             'type' => 'Snack',
             'stock' => 30,
             'description' => 'Chiki',
             'image' => 'chiki.jpeg'],

             ['user_id' => 1,
             'name' => 'Teh Botol',
             'type' => 'Beverages',
             'stock' => 50,
             'description' => 'Tehbotol',
             'image' => 'tehbotol.png']
            ]);
    }
}
