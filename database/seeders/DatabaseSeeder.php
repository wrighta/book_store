<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $this->call(PublisherSeeder::class);
        //   $this->call(BookSeeder::class);
        $this->call(AuthorSeeder::class);
    //    $this->call(AuthorBookSeeder::class);
    }
}
