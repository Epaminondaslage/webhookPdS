<?php
// mqtt_client.php
require_once '/path/to/phpMQTT.php'; // Aponte para a biblioteca phpMQTT

class MQTTClient {
    private $client;
    private $logFilePath = "../logs/log.txt"; // Caminho para o log

    public function __construct($server, $port, $username, $password) {
        $this->client = new Bluerhinos\phpMQTT($server, $port, "ClientID" . rand());
        if (!$this->client->connect(true, NULL, $username, $password)) {
            file_put_contents($this->logFilePath, "Erro de conexão com o broker\n", FILE_APPEND);
            exit(1);
        }
    }

    public function publish($topic, $payload) {
        return $this->client->publish($topic, $payload, 0);
    }

    public function close() {
        $this->client->close();
    }
}
