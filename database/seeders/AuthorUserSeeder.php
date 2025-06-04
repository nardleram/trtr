<?php

namespace Database\Seeders;

use Database\Factories\UserFactoryHelper;
use Illuminate\Database\Seeder;

class AuthorUserSeeder extends Seeder
{
    public function run(): void
    {
        $factory = new UserFactoryHelper();

        $factory->createAuthorUser('ernest@hemmingway.com', 'Ernest');
    }
}