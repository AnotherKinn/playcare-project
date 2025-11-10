<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogTailCommand extends Command
{
    protected $signature = 'log:tail {lines=20}';
    protected $description = 'Menampilkan beberapa baris terakhir dari log Laravel (kompatibel dengan Windows)';

    public function handle()
    {
        $lines = (int) $this->argument('lines');
        $path = storage_path('logs/laravel.log');

        if (!file_exists($path)) {
            $this->error('File log tidak ditemukan.');
            return Command::FAILURE;
        }

        // Baca isi file log
        $content = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (empty($content)) {
            $this->warn('Log masih kosong.');
            return Command::SUCCESS;
        }

        // Ambil beberapa baris terakhir
        $lastLines = array_slice($content, -$lines);

        $this->info("📜 Menampilkan {$lines} baris terakhir dari laravel.log:\n");
        foreach ($lastLines as $line) {
            $this->line($line);
        }

        return Command::SUCCESS;
    }
}
