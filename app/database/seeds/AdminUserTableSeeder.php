<?php

use App\User;
use Illuminate\Database\Seeder;


class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(User::class)->create([
            'name' => 'admin',
            'email' => 'admin@test.loc',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN,
            'state' => User::STATE_ACTIVE,
        ]);

    }
}
