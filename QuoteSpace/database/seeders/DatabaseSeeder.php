<?php

namespace Database\Seeders;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo Owner User
        $user1 = User::create([
            'name' => 'Eleanor Vance',
            'email' => 'eleanor@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Demo User 2
        $user2 = User::create([
            'name' => 'Julian Blackwell',
            'email' => 'julian@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Demo Quotes
        $quotesUser1 = [
            'No live organism can continue for long to exist sanely under conditions of absolute reality.',
            'Words are, in my not-so-humble opinion, our most inexhaustible source of magic.',
            'We are all in the gutter, but some of us are looking at the stars.',
            'It is a far, far better thing that I do, than I have ever done.',
        ];

        $quotesUser2 = [
            'Not all those who wander are lost.',
            'To live is the rarest thing in the world. Most people exist, that is all.',
            'Whatever our souls are made of, his and mine are the same.',
        ];

        foreach ($quotesUser1 as $q) {
            $user1->quotes()->create(['content' => $q]);
        }

        foreach ($quotesUser2 as $q) {
            $user2->quotes()->create(['content' => $q]);
        }
    }
}
