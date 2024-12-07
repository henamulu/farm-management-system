<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Command
{
    protected $signature = 'password:change {email} {password}';
    protected $description = 'Change user password';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found");
            return;
        }

        $user->password = Hash::make($password);
        $user->save();

        $this->info("Password changed successfully for {$email}");
    }
} 