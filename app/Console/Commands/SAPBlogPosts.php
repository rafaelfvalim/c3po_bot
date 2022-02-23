<?php

namespace App\Console\Commands;

use App\Classes\C3POBot;
use App\Models\Feeds;
use Illuminate\Console\Command;

class SAPBlogPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sapblog:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SAPBlog Feeds';

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
        \Log::info("Excutando SAPBlog Feeds Inicio");
        $feeds = Feeds::where('tipo', 'abapfeed')->where('ativo', true)->get();;
        foreach ($feeds as $feed) {
            C3POBot::sapBlogFeedToTelegram($feed->url, 10, $feed->grupo);
        }
        \Log::info("Excutando SAPBlog Feeds Fim");
    }
}
