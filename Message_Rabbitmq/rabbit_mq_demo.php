<?php

require_once __DIR__.'/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Queue
{
    //constantes
    const EXCHANGE = 'router';
    // atributos de clase
    private $_host;
    private $_user;
    private $_pass;
    private $_port;
    private $_queue;
    private $_channel;

    public function __construct($host, $user, $pass, $port, $queue)
    {
        $this->_host    = $host;
        $this->_user    = $user;
        $this->_pass    = $pass;
        $this->_port    = $port;
        $this->_queue   = $queue;

        $connection = new AMQPConnection(
            $this->_host,
            $this->_port,
            $this->_user,
            $this->_pass,
            '/'
        );
        $this->_channel = $connection->channel();
        /*
            name: $queue
            passive: false
            durable: true // the queue will survive server restarts
            exclusive: false // the queue can be accessed in other channels
            auto_delete: false //the queue won't be deleted once the channel is closed.
        */
        $this->_channel->queue_declare($this->_queue, false, true, false, false);

        /*
            name: router
            type: direct
            passive: false
            durable: true // the exchange will survive server restarts
            auto_delete: false //the exchange won't be deleted once the channel is closed.
        */
        $this->_channel->exchange_declare(self::EXCHANGE, 'direct', false, true, false);
        $this->_channel->queue_bind($this->_queue, self::EXCHANGE);
    }

    public function publish($body)
    {
        $msg = new AMQPMessage($body, array('content_type' => 'application/json', 'delivery_mode' => 2));
        $this->_channel->basic_publish($msg, self::EXCHANGE);
    }

    public function getMessage()
    {
        $msg = $this->_channel->basic_get($this->_queue);
        if (!$msg) {
            return false;
        }
        $this->_channel->basic_ack($msg->delivery_info['delivery_tag']);
        return $msg->body;
    }

    public function close()
    {
        $this->_channel->close();
    }
}

$queue = new Queue('localhost', 'guest', 'guest', 5672, 'ServicesMineQueueDev');

$messages = 10;

// publicar en la cola
for ($i=0; $i < $messages; $i++) {
    $queue->publish("{id: $i, name: 'message $i'}");
}

// descargar los mensajes en cola
while ($msg = $queue->getMessage()) {
    printf("%s\n", $msg);
}

$queue->close();
