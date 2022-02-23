<?php

namespace App\Console\Commands;

use App\Classes\C3POBot;
use App\Models\Feeds;
use Illuminate\Console\Command;

class BtpBlogPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'btpBlogPosts:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SAPBlog BTP';

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
        \Log::info("Excutando SAPBlog BTP Feeds Inicio");
        $feeds = Feeds::where('tipo', 'btpfeed')->where('ativo', true)->get();
        foreach ($feeds as $feed) {
            C3POBot::sapBlogFeedToTelegram($feed->url, 10, $feed->grupo);
        }
        \Log::info("Excutando SAPBlog BTP Feeds Fim");
    }
}
