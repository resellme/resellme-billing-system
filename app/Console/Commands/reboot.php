<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class reboot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reboot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reboot Application after deploy. Clear cache and restart queues';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Clear Cache
        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');

        // Restart Queues
        $this->call('horizon:terminate');
    }
}
