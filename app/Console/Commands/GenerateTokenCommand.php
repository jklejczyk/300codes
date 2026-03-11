<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generuje token API dla użytkownika';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $user = User::find(1);

        if (! $user) {
            $this->error('Nie znaleziono użytkownika o ID 1.');

            return self::FAILURE;
        }

        $token = $user->createToken('api-token')->plainTextToken;

        $this->info("Token dla użytkownika {$user->name} (ID: {$user->id}):");
        $this->line($token);

        return self::SUCCESS;
    }
}
