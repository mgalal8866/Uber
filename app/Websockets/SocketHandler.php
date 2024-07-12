<?php

namespace App\Websockets;

use App\Events\Message;
use stdClass;
use Exception;
use App\Models\Chat;
use App\Models\User;
use App\Events\MessageSent;
use Ratchet\ConnectionInterface;
use Illuminate\Support\Facades\Broadcast;
use Ratchet\RFC6455\Messaging\MessageInterface;

use Ratchet\WebSocket\MessageComponentInterface;
use BeyondCode\LaravelWebSockets\QueryParameters;
use BeyondCode\LaravelWebSockets\Facades\StatisticsLogger;
use BeyondCode\LaravelWebSockets\Dashboard\DashboardLogger;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;

class SocketHandler extends BaseSocketHandler  implements MessageComponentInterface
// class UpdateDriverHandler implements MessageComponentInterface
{

    protected $subscribedConnections = [];
    protected $channelName;

    protected stdClass $payload;


    function onMessage(ConnectionInterface $connection, MessageInterface $msg)
    {
        $body = collect(json_decode($msg->getPayload(), true));

        if ($body->get('action') === 'subscribe') {
            $channel = $body->get('channel');
            $this->channelName = $channel;
            $channel = $this->channelManager->findOrCreate($connection->app->id, $this->channelName);
            $channel->subscribe($connection,  (object)['channel' => $this->channelName]);
        }

        // Example: Handling a message to be sent to a channel
        if ($body->get('action') === 'sendmessage') {
            $channel = $body->get('channel');
            $event = $body->get('event');
            $message = $body->get('message');
            $conversion = [
                'sender_id'     => 1,
                'message'       => $message,
                'receiver_id'   => 2,
                'room_id'       => 1,
            ];
            // $conversion = Chat::create($conversion);

            $connection->send(json_encode(['status' => 'success']));

             $this->handleMessageAsync($message);
            // DashboardLogger::clientMessage(  $connection, json_decode($msg->getPayload()));
        }

        // Example: Update user's location
        if ($body->get('action') === 'updateLocation') {
            $payload = $body->get('payload');

            $user =  User::findToken($connection->httpRequest->getHeader('Authorization')[0]);
            if ($user != null) {
                $user->update(['lat' => $payload['lat'], 'long' => $payload['long']]);
                $connection->send(json_encode(['status' => 'success' , 'data' =>['lat' => $payload['lat'], 'long' => $payload['long']]]));
                // Message::dispatch($payload);
            } else {
                $connection->send(json_encode(['status' => 'error']));
            }
        }
    }
    public function subscribe(ConnectionInterface $connection)
    {
        $this->saveConnection($connection);

        $connection->send(json_encode([
            'event' => 'subscription_succeeded',
            'channel' => $this->channelName,
        ]));
    }

    public function hasConnections(): bool
    {
        return count($this->subscribedConnections) > 0;
    }

    protected function saveConnection(ConnectionInterface $connection)
    {
        $hadConnectionsPreviously = $this->hasConnections();
        $this->subscribedConnections[$connection->socketId] = $connection;
        if (!$hadConnectionsPreviously) {
            DashboardLogger::occupied($connection, $this->channelName);
        }
        DashboardLogger::subscribed($connection, $this->channelName);
    }

    public function broadcast($payload)
    {
        foreach ($this->subscribedConnections as $connection) {
            $connection->send(json_encode($payload));
        }
    }

    public function broadcastToOthers(ConnectionInterface $connection, $payload)
    {
        $this->broadcastToEveryoneExcept($payload, $connection->socketId);
    }

    public function broadcastToEveryoneExcept($payload, ?string $socketId = null)
    {
        if (is_null($socketId)) {
            return $this->broadcast($payload);
        }

        foreach ($this->subscribedConnections as $connection) {
            if ($connection->socketId !== $socketId) {
                $connection->send(json_encode($payload));
            }
        }
    }

    protected function handleMessageAsync($message)
    {
        $conversion = [
            'sender_id' => 1,
            'message' => $message,
            'receiver_id' => 2,
            'room_id' => 1,
        ];
        // $conversion = Chat::create($conversion);
        // broadcast(new MessageSent($conversion, 1))->toOthers();

        // $pid = pcntl_fork();
        // if ($pid == -1) {
        //     // Fork failed
        //     throw new Exception('Could not fork process');
        // } elseif ($pid) {
        //     // Parent process
        //     // Return to handle other messages
        //     return;
        // } else {
        //     // Child process
        //     $conversion = [
        //         'sender_id' => 1,
        //         'message' => $message,
        //         'receiver_id' => 2,
        //         'room_id' => 1,
        //     ];
        //     $conversion = Chat::create($conversion);
        //     broadcast(new MessageSent($conversion, 1))->toOthers();
        //     exit(0); // Ensure the child process exits after completing the task
        // }
    }
}
