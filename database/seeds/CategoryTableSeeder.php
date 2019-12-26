<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            [ 
               'id' => 1,
                'title' => 'Travel',
                'type' => 'DEFAULT',
            ],
            [ 
                'id' => 2,
                'title' => 'Food',
                'type' => 'DEFAULT',
            ],
            [ 
                'id' => 3,
                'title' => 'Grocery',
                'type' => 'DEFAULT',
            ],
            [ 
                'id' => 4,
                'title' => 'Utility',
                'type' => 'DEFAULT',
            ],
            [ 
                'id' => 5,
                'title' => 'Shopping',
                'type' => 'DEFAULT',
            ],
            [ 
                'id' => 6,
                'title' => 'Healths',
                'type' => 'DEFAULT',
            ]
        ]);
    }
}
