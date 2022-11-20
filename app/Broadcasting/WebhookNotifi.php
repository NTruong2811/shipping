<?php

namespace App\Broadcasting;

use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Log\Logger;
use Illuminate\Notifications\Notification;

class WebhookNotifi
{
    private $client;
    private $logger;
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct(Client  $client, Logger $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        //
    }
    /**
     * @param Notifiable $notifiable
     * @param Notification $notification
     * @throws WebHookFailedException
     */
    public function send($notifiable, Notification $notification)
    {
        $request = new Request('POST', 'http://127.0.0.1:8001/', $notification);
        $response = $this->client->send($request);
    }
}
