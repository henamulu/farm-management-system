<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Farm;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $farms = Farm::all();

        foreach ($farms as $farm) {
            Message::create([
                'user_id' => $farm->user_id,
                'farm_id' => $farm->id,
                'subject' => 'Important Farm Update',
                'content' => 'This is a test message for ' . $farm->name,
                'priority' => 'high',
                'status' => 'unread'
            ]);

            Message::create([
                'user_id' => $farm->user_id,
                'farm_id' => $farm->id,
                'subject' => 'Weekly Report',
                'content' => 'Weekly status update for ' . $farm->name,
                'priority' => 'normal',
                'status' => 'unread'
            ]);
        }
    }
} 