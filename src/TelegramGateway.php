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

    private function mergeMultipart($key, $file, $array)
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

    private function mergeArray($array, $object)
    {
        foreach (array_keys($array) as $key) {
            $object[$key] = $array[$key];
        }
        return $object;
    }

    public function sendContact($phone_number, $first_name, $array)
    {
        return $this->post(__FUNCTION__, $this->mergeArray(compact('phone_number', 'first_name'), $array));
    }

    public function sendVideoNote($voiceNote, $array)
    {
        return $this->multipart(__FUNCTION__, $this->mergeMultipart('video_note', $voiceNote, $array));
    }

    public function sendLocation($latitude, $longitude, $array)
    {
        return $this->post(__FUNCTION__, $this->mergeArray(compact('latitude', 'longitude'), $array));
    }

    public function getFile($file_id) {
        return $this->post(__FUNCTION__, compact('file_id'));
    }

    public function sendVoice($voice, $array)
    {
        return $this->multipart(__FUNCTION__, $this->mergeMultipart('voice', $voice, $array));
    }

    public function sendAnimation($animation, $array)
    {
        return $this->multipart(__FUNCTION__, $this->mergeMultipart('animation', $animation, $array));
    }

    public function sendVideo($video, $array)
    {
        return $this->multipart(__FUNCTION__, $this->mergeMultipart('video', $video, $array));
    }

    public function sendDocument($document, $array)
    {
        return $this->multipart(__FUNCTION__, $this->mergeMultipart('document', $document, $array));
    }

    public function sendAudio($audio, $array)
    {
        return $this->multipart(__FUNCTION__, $this->mergeMultipart('audio', $audio, $array));
    }

    public function sendPhoto($photo, $array)
    {
        return $this->multipart(__FUNCTION__, $this->mergeMultipart('photo', $photo, $array));
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
