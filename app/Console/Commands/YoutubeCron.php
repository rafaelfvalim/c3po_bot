<?php

namespace App\Console\Commands;

use App\Classes\C3POBot;
use App\Models\Feeds;
use Illuminate\Console\Command;

class YoutubeCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publicações YoutubeFeed';

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
        \Log::info("Excutando Youtube Feeds Inicio");
        $feeds = Feeds::where('tipo', 'youtube')->where('ativo', true)->get();
        foreach ($feeds as $feed) {
            C3POBot::youtubeFeedToTelegram($feed->grupo, $feed->channelid);
        }
        \Log::info("Excutando Youtube Feeds Fim");
    }
}
