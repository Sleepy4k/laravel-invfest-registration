<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServerReCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'naka:re-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old server cache with the new one for some reason';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Remove old cache
        $this->call('optimize:clear');

        // Cache all data
        $this->call('optimize');
    }
}
