<?php
// src/MqttClient.php
require_once '../config/config.php';
require_once '../vendor/autoload.php';  // Certifique-se de que este caminho está correto

class MqttClient {
    private $server;
    private $port;
    private $username;
    private $password;
    private $topic;

    public function __construct() {
        $this->server = MQTT_SERVER;
        $this->port = MQTT_PORT;
        $this->username = MQTT_USERNAME;
        $this->password = MQTT_PASSWORD;
        $this->topic = MQTT_TOPIC;
    }

    public function publish($message) {
        $mqtt = new phpMQTT($this->server, $this->port, "ClientID" . rand());

        if ($mqtt->connect(true, NULL, $this->username, $this->password)) {
            $mqtt->publish($this->topic, $message, 0);
            $mqtt->close();
            return "Mensagem enviada com sucesso.";
        } else {
            return "Erro ao conectar ao broker MQTT.";
        }
    }
}
