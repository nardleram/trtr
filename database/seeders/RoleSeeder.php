<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\RoleFactory;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $factory = new RoleFactory();

        $factory->createAdminRole('Admin');
        $factory->createAuthorRole('Author');
        $factory->createGuestRole('Guest');
    }
}
