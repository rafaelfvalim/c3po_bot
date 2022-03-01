<?php

namespace App\Classes;

class AbapDojoUrlsUtils
{
    private $username;
    private $password;
    private $api_url;

    public function __construct()
    {
        $this->username = env('URLS_ABAP_DOJO_USER');
        $this->password = env('URLS_ABAP_DOJO_PASS');
        $this->api_url = env('URLS_ABAP_DOJO_URL');
    }

    public function shortUrl($url)
    {
        return $this->api("shorturl", $url);
    }

    public function expandUrl($url)
    {
        return $this->api("expand", $url);
    }

    public function status($url)
    {
        return $this->api("url-stats", $url);
    }

    private function api($action, $url)
    {

        switch ($action) {
            case 'shorturl':
                // Init the CURL session
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->api_url);
                curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
                curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
                curl_setopt($ch, CURLOPT_POSTFIELDS, array(     // Data to POST
                    'url' => $url,
                    'format' => 'json',
                    'action' => $action,
                    'username' => $this->username,
                    'password' => $this->password
                ));
                break;
            case 'expand':
                // Init the CURL session
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->api_url);
                curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
                curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
                curl_setopt($ch, CURLOPT_POSTFIELDS, array(     // Data to POST
                    'shorturl' => $url,
                    'format' => 'json',
                    'action' => $action,
                    'username' => $this->username,
                    'password' => $this->password
                ));
                break;
            case 'url-stats':
                // Init the CURL session
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->api_url);
                curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
                curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
                curl_setopt($ch, CURLOPT_POSTFIELDS, array(     // Data to POST
                    'shorturl' => $url,
                    'format' => 'json',
                    'action' => $action,
                    'username' => $this->username,
                    'password' => $this->password
                ));
                $data = curl_exec($ch);
                curl_close($ch);
                return json_decode($data);
            default:
                // Init the CURL session
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->api_url);
                curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
                curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
                curl_setopt($ch, CURLOPT_POSTFIELDS, array(     // Data to POST
                    'url' => $url,
                    'format' => 'json',
                    'action' => $action,
                    'username' => $this->username,
                    'password' => $this->password
                ));
                break;
        }

        $data = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($data);
        return $json;
    }
}
