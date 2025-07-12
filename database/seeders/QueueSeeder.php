<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Queue;

class QueueSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            Queue::create([
                'number' => $i,
                'status' => 'waiting',
                'called_at' => null,
            ]);
        }
    }
}
