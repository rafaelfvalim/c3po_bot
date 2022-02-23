<?php

namespace App\Console\Commands;

use App\Classes\C3POBot;
use App\Models\Feeds;
use Illuminate\Console\Command;

class TelegramMembros extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegramMembros:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Conta Membros do Grupo';

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
        \Log::info("Excutando Contagem de Membros Inicio");
        C3POBot::telegramUserCount('@abap_dojo');
        \Log::info("Excutando Contagem de Membros Fim");
    }
}
