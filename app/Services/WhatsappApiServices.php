<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsappApiServices
{
    protected $base_uri;
    protected $session_id;

    public function __construct()
    {
        $this->base_uri = env('WA_API_URI');
        $this->session_id = env('WA_SESSION_ID');
    }

    public function sendMessage($number, $message)
    {
        $response = Http::post($this->base_uri . '/chats/send?id='.$this->session_id, [
            'receiver' => (string)$number,
            'message' => [
                'text' => (string)$message,
            ]
        ]);

        return $response->json();
    }
}
