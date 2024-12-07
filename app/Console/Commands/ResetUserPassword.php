<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetUserPassword extends Command
{
    protected $signature = 'user:reset-password {email}';
    protected $description = 'Reset user password and send notification';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found");
            return 1;
        }

        // Generate new password
        $newPassword = Str::random(12);
        
        // Update user password
        $user->password = Hash::make($newPassword);
        $user->save();

        // Send notification to user
        $user->notify(new \App\Notifications\PasswordReset($newPassword));

        $this->info("Password has been reset for {$email}");
        $this->info("A notification has been sent to the user");
        
        return 0;
    }
} 