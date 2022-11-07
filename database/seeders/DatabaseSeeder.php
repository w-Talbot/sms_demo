<?php

namespace Database\Seeders;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Study;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         DB::statement('SET FOREIGN_KEY_CHECKS=0');

//         DB::table('roles')->truncate();
//         DB::table('users')->truncate();
//         DB::table('tags')->truncate();
//         DB::table('item_tag')->truncate();
//         DB::table('categories')->truncate();
//         DB::table('items')->truncate();

        $this->call([RolesTableSeeder::class, UsersTableSeeder::class]);
        $this->call([TagsTableSeeder::class, CategoriesTableSeeder::class, ItemsTableSeeder::class]);

        Study::factory(10)->create();
//
//        Study::create([
//            'id' => 2,
//            'study_name' => 'ALKALINE',
//            'api' => 'AABB1234CCDD5678EEFF910GG',
//            'url' => 'https://test.com'
//        ]);
//        Study::create([
//            'id' => 3,
//            'study_name' => 'ARCHIE',
//            'api' => 'AABB1234CCDD5678EEFF910GG',
//            'url' => 'https://test.com'
//        ]);
//        Study::create([
//            'id' => 4,
//            'study_name' => 'DUMMY',
//            'api' => 'AABB1234CCDD5678EEFF910GG',
//            'url' => 'https://test.com'
//        ]);


        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
