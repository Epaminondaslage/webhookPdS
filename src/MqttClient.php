<?php
// Inclui a biblioteca phpMQTT
require_once("phpMQTT.php");

class MqttClient {
    private $mqtt;
    private $config;

    public function __construct($config) {
        // Inicializa as configurações e cria a conexão MQTT
        $this->config = $config;
        $this->mqtt = new phpMQTT($config['server'], $config['port'], $config['client_id']);
    }

    public function connect() {
        // Conecta ao broker MQTT com as credenciais
        return $this->mqtt->connect(true, NULL, $this->config['username'], $this->config['password']);
    }

    public function publish($topic, $message) {
        // Publica a mensagem no tópico especificado
        $this->mqtt->publish($topic, $message, 0);
    }

    public function close() {
        // Fecha a conexão com o broker
        $this->mqtt->close();
    }
}
