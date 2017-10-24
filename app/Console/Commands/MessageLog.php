<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MessageLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a Message to Pendaftfar via SMS';

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
     * @return mixed
     */
    public function handle()
    {
        Log::info("Time : ".\Carbon\Carbon::now());
        Log::info("Percobaan Log Pesan");
    }
}
