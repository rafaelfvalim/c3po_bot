<?php

namespace App\Classes;

class BotTest
{
    private $idGrupo = "";
    private $apiToken = "";

    public function __construct($idGrupo)
    {
        $this->idGrupo = $idGrupo;
        $this->apiToken = "2008051556:AAFz2wjLdYfI13WUuSRYiXd12zimF-ihLIE";
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

    public function getBotUpdates($timeout, $update_id)
    {

        $apiToken = $this->apiToken;
        $data = [
            'timeout' => $timeout,
            'update_id' => $update_id,
        ];

        $data = file_get_contents("https://api.telegram.org/bot$apiToken/getUpdates?timeout=100");
        return json_decode($data)->result;
    }

    public function setRespostaBot($message, $chat_id)
    {

        $apiToken = $this->apiToken;
        $data = [
            'text' => $message,
            'chat_id' => $this->idGrupo,
            'parse_mode' => 'html'
        ];

        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
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

function consoleLog($result)
{
    error_log(json_encode($result), 0);
}

$telegram = new TelegramUtils("@abap_dojo_sandbox");
$update_id = null;
while (1 == 1) {
    $results = $telegram->getBotUpdates
  foreach ($results as $result) {
      consoleLog($result->message->text);
  }
}

