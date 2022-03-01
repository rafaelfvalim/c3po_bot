<?php

namespace App\Classes;

class TelegramUtils
{
    private $idGrupo = "";
    private $apiToken = "";

    public function __construct($idGrupo)
    {
        $this->idGrupo = $idGrupo;
        $this->apiToken = env('TELEGRAM_API_TOKEN');;
    }

    public function sendMessage($message)
    {
        $apiToken = $this->apiToken;
        $data = [
            'text' => $message,
            'chat_id' => $this->idGrupo,
            'parse_mode' => 'html'
        ];

        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
        sleep(1);
    }

    public function count()
    {
        $apiToken = $this->apiToken;
        $data = [
            'chat_id' => $this->idGrupo,
        ];
        $data = file_get_contents("https://api.telegram.org/bot$apiToken/getChatMembersCount?" . http_build_query($data));
        return json_decode($data)->result;
    }

    public function getUpdates()
    {
        $apiToken = $this->apiToken;
        $data = [
            'chat_id' => $this->idGrupo,
        ];
        $data = file_get_contents("https://api.telegram.org/bot$apiToken/getUpdates?" . http_build_query($data));
        return json_decode($data)->result;
    }

    public function getUsers()
    {
        $apiToken = $this->apiToken;
        $data = [
            'chat_id' => $this->idGrupo,
        ];
        $data = file_get_contents("https://api.telegram.org/bot$apiToken/contacts.getContacts?" . http_build_query($data));
        return json_decode($data)->result;

    }


}
