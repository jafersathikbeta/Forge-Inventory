<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $passwordHash = Hash::make(env('SEEDER_PASSWORD', bin2hex(random_bytes(8))));

        // SUPER ADMIN (Owner)
        $owner = User::updateOrCreate(
            ['email' => 'owner@itcore.local'],
            [
                'name' => 'Owner (Super Admin)',
                'password' => $passwordHash,
                'is_owner' => true,
                'telegram_chat_id' => null,
                'telegram_is_group' => false,
                'ownership_transferred_at' => null,
            ]
        );
        $owner->syncRoles(['Super Admin']);

        // ADMIN
        $admin = User::updateOrCreate(
            ['email' => 'admin@itcore.local'],
            [
                'name' => 'Admin User',
                'password' => $passwordHash,
                'is_owner' => false,
                'telegram_chat_id' => null,
                'telegram_is_group' => false,
                'ownership_transferred_at' => null,
            ]
        );
        $admin->syncRoles(['Admin']);

        // OPERATOR
        $operator = User::updateOrCreate(
            ['email' => 'operator@itcore.local'],
            [
                'name' => 'Operator User',
                'password' => $passwordHash,
                'is_owner' => false,
                'telegram_chat_id' => null,
                'telegram_is_group' => false,
                'ownership_transferred_at' => null,
            ]
        );
        $operator->syncRoles(['Operator']);
    }
}
