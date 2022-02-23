<?php

namespace App\Classes;

use App\Mail\ReportCliques;
use App\Models\Params;
use App\Models\Post;
use App\Models\TelegramMembros;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Array_;

class C3POBot
{

    public static function sapBlogFeedToTelegram($link, $qtemensagens, $grupo)
    {
        $telegram = new TelegramUtils($grupo);
        $rss_feed = simplexml_load_file($link);
        if (!empty($rss_feed)) {
            $message = (string)$rss_feed->title;
            $dateString = strtotime((string)$rss_feed->updated);
            $date = date("d/m/Y", $dateString);
            $telegram->sendMessage($message . " - " . $date);
            $i = 0;
            foreach ($rss_feed->entry as $entry) {
                if ($i >= $qtemensagens) break;
                $href = (string)$entry->link["href"];
                $telegram->sendMessage($href);
                $i++;
            }
        }

    }

    public static function youtubeFeedToTelegram($grupo, $channelId)
    {
        $urlUtils = new AbapDojoUrlsUtils();
        $youtubeUitls = new YoutubeUtils($channelId);
        $video = $youtubeUitls->video();
        $urlVideo = "https://www.youtube.com/watch?v=" . $video['id'];
        $title = (string)$video['title'];
        $post = Post::where('url', $urlVideo)->where('grupo', $grupo)->first();
        var_dump($post);
        if (empty($post)) {
            $urlShort = $urlUtils->shortUrl($urlVideo)->shorturl;
            $newPost = new Post();
            $newPost->url = $urlVideo;
            $newPost->shorturl = $urlShort;
            $newPost->descricao = $title;
            $newPost->grupo = $grupo;
            $newPost->clicks = 0;
            $newPost->save();
            if (!empty($urlShort)) {
                $mensagemTelegram = "<b>" . $video['author'] . "</b> - " . $video['title'] . "  " . $urlShort;
                $telegramUtils = new TelegramUtils($grupo);
                $telegramUtils->sendMessage($mensagemTelegram);
            }
        }
    }

    public static function telegramUserCount($grupo)
    {
        $telegramUtils = new TelegramUtils($grupo);
        $qteGrupo = $telegramUtils->count();
        $telegramMembros = TelegramMembros::where('grupo', $grupo)->latest()->first();
        $param = Params::where('chave', 'comemora_membros')->first();
        if (empty($param)) return;
        $mensagem = sprintf($param->valor, $qteGrupo);
        if (empty($telegramMembros)) {
            $new = new TelegramMembros();
            $new->grupo = $grupo;
            $new->qte = $qteGrupo;
            $new->save();
        } elseif ($qteGrupo > $telegramMembros->qte && $qteGrupo % 10 == 0) {
            $new = new TelegramMembros();
            $new->grupo = $grupo;
            $new->qte = $qteGrupo;
            $new->save();
            $telegramUtils->sendMessage($mensagem);
        }
    }

    public static function reportClicks($grupo, $email)
    {
        $urlUtils = new AbapDojoUrlsUtils();
        $posts = Post::where('grupo', $grupo)->get();

        foreach ($posts as $post) {
            $data = $urlUtils->status($post->shorturl);
            if ($data->statusCode == '200')
                Post::where('url', $post->url)->where('grupo', $grupo)->update(['clicks' => $data->link->clicks]);
        }
        $newPosts = Post::where('grupo', $grupo)->get();
        self::sendEmail($email, $newPosts);
    }

    protected static function sendEmail($email, $posts)
    {
        Mail::to($email)->send(new ReportCliques($posts));
    }

}
