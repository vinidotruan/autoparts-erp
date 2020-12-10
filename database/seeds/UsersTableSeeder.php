<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create(
            [
                'name' => 'admin',
                'email' => 'admin@admin',
                'user' => 'admin',
                'active' => 1,
                'activation_token' => 'admin',
                'cpf' => 04037131021,
                'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
                'role_id' => 1
            ]
        );
        // factory(User::class, 5)->create();
    }
}
