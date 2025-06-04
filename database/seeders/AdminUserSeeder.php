<?php

namespace Database\Seeders;

use Database\Factories\UserFactoryHelper;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $factory = new UserFactoryHelper();

        $factory->createAdminUser('tobyrussell@protonmail.com', 'Toby Russell');
    }
}