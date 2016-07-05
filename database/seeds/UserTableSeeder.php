<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CodeCommerce\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@codecommerce.com',
            'is_admin' => true,
            'password' => bcrypt(123456),
        ]);

        factory(CodeCommerce\User::class)->create([
            'name' => 'User',
            'email' => 'user@codecommerce.com',
            'is_admin' => false,
            'password' => bcrypt(123456),
        ]);

        factory(CodeCommerce\User::class, 10)->create();
    }
}
