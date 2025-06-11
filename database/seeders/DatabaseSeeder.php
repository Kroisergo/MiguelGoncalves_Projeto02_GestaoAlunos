<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Cria um administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'), //Vai alterar a password que é opcional
            'role' => 'admin', //Vai definir a role como admin
        ]);

        //Cria um utilizador
        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('user'), //Vai alterar a password que é opcional
            'role' => 'user', //Vai definir a role como user
        ]);

        //Para executar o AlunoSeeder
        $this->call(AlunoSeeder::class);
    }
}
