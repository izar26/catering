<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'make:admin
                            {username=admin : Username admin}
                            {email=admin@example.com : Email admin}
                            {password=password123 : Password admin}
                            {name=Admin : Nama lengkap admin}';

    protected $description = 'Create an admin user with given username, email and password';

    public function handle()
    {
        $username = $this->argument('username');
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->argument('name');

        if (User::where('username', $username)->exists()) {
            $this->error("User dengan username '$username' sudah ada.");
            return 1;
        }

        User::create([
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'name' => $name,
        ]);

        $this->info("User admin '$username' berhasil dibuat.");
        return 0;
    }
}
