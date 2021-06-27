<?php


namespace Mahdiidea\TelegramApi;


class TelegramGateway
{
    public $config;
    public $address;

    public function __construct()
    {
        $this->config = app('config');
        $this->address = "https://api.telegram.org/bot" . $this->config->get('telegram.telegram_bot_token') . "/";
    }

    private function post($method, $array)
    {
        $client = new \GuzzleHttp\Client();

        $res = $client->post($this->address . $method, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'json' => $array
        ]);

        return json_decode($res->getBody());
    }

    private function get($method)
    {
        $client = new \GuzzleHttp\Client();

        $res = $client->post($this->address . $method, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);

        return json_decode($res->getBody());
    }

    private function multipart($method, $array)
    {
        $client = new \GuzzleHttp\Client();

        $res = $client->post($this->address . $method, [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'multipart' => $array
        ]);

        return json_decode($res->getBody());
    }

    private function makeMultipart($key, $file, $array)
    {
        $multipart = array([
            'name' => $key,
            'contents' => fopen($file, 'r')
        ]);

        foreach (array_keys($array) as $key) {
            array_push($multipart, ['name' => $key, 'contents' => $array[$key]]);
        }

        return $multipart;
    }

//    public function sendMediaGroup($fileArray, $array)
//    {
//        $files = array();
//        $multipart = array();
//
//        foreach ($fileArray as $item) {
//            array_push($files, fopen($item, 'r'));
//        }
//
//        array_push($multipart, ['name' => 'media', 'contents' => $files]);
//
//        foreach (array_keys($array) as $key) {
//            array_push($multipart, ['name' => $key, 'contents' => $array[$key]]);
//        }
//
//        return $this->multipart(__FUNCTION__, $multipart);
//    }

    public function sendVideoNote($voiceNote, $array)
    {
        return $this->multipart(__FUNCTION__, $this->makeMultipart('video_note', $voiceNote, $array));
    }

    public function sendVoice($voice, $array)
    {
        return $this->multipart(__FUNCTION__, $this->makeMultipart('voice', $voice, $array));
    }

    public function sendAnimation($animation, $array)
    {
        return $this->multipart(__FUNCTION__, $this->makeMultipart('animation', $animation, $array));
    }

    public function sendVideo($video, $array)
    {
        return $this->multipart(__FUNCTION__, $this->makeMultipart('video', $video, $array));
    }

    public function sendDocument($document, $array)
    {
        return $this->multipart(__FUNCTION__, $this->makeMultipart('document', $document, $array));
    }

    public function sendAudio($audio, $array)
    {
        return $this->multipart(__FUNCTION__, $this->makeMultipart('audio', $audio, $array));
    }

    public function sendPhoto($photo, $array)
    {
        return $this->multipart(__FUNCTION__, $this->makeMultipart('photo', $photo, $array));
    }

    public function copyMessage($array)
    {
        return $this->post(__FUNCTION__, $array);
    }

    public function forwardMessage($array)
    {
        return $this->post(__FUNCTION__, $array);
    }

    public function sendMessage($array)
    {
        return $this->post(__FUNCTION__, $array);
    }

    public function getMe()
    {
        return $this->get(__FUNCTION__);
    }
}
