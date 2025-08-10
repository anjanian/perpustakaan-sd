<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUserRole extends Command
{
    /**
     * Nama dan signature command.
     *
     * @var string
     */
    protected $signature = 'user:role {user_id}';

    /**
     * Deskripsi command.
     *
     * @var string
     */
    protected $description = 'Cek role dari user berdasarkan ID';

    /**
     * Jalankan command.
     */
    public function handle()
    {
        $userId = $this->argument('user_id');
        $user = User::find($userId);

        if (! $user) {
            $this->error("User dengan ID {$userId} tidak ditemukan.");
            return Command::FAILURE;
        }

        $roles = $user->getRoleNames(); // dari Spatie
        $this->info("User: {$user->name} ({$user->email})");
        $this->info("Roles: " . ($roles->isEmpty() ? 'Tidak punya role' : $roles->implode(', ')));

        return Command::SUCCESS;
    }
}
