<?php

namespace App\Console\Commands;

use App\Models\Author;
use Illuminate\Console\Command;

class CreateAuthorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'author:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tworzy nowego autora na podstawie podanego imienia i nazwiska';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $firstName = $this->ask('Podaj imię autora');
        $lastName = $this->ask('Podaj nazwisko autora');

        $author = Author::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        $this->info("Autor {$author->first_name} {$author->last_name} został utworzony (ID: {$author->id}).");

        return self::SUCCESS;
    }
}
