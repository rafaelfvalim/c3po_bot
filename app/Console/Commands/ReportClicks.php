<?php

namespace App\Console\Commands;

use App\Classes\C3POBot;
use Illuminate\Console\Command;

class ReportClicks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reportClicks:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Report Clicks';

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
        \Log::info("Excutando ReportClicks Inicio");
        C3POBot::reportClicks('@abap_dojo', 'rafael.figueiredo.valim@gmail.com');
        sleep(1);
        C3POBot::reportClicks('@leoabap', 'leonardonobre@gmail.com');
        \Log::info("Excutando ReportClicks Fim");
    }
}
