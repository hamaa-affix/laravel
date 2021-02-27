<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PostTableSeeder::class);
        //this->call(LessonSeeder::class);
        $this->call(ItemConditionSeeder::class);
        $this->call(PrimaryCategorySeeder::class);
        $this->call(SecondaryCategorySeeder::class);
    }
}
