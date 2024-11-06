<?php
// Inclui o autoloader do Composer
require_once __DIR__ . '/../vendor/autoload.php';

class MqttClient {
    private $mqtt;
    private $config;

    public function __construct($config) {
        $this->config = $config;
        $this->mqtt = new \phpMQTT($config['server'], $config['port'], $config['client_id']);
    }

    public function connect() {
        return $this->mqtt->connect(true, NULL, $this->config['username'], $this->config['password']);
    }

    public function publish($topic, $message) {
        $this->mqtt->publish($topic, $message, 0);
    }

    public function close() {
        $this->mqtt->close();
    }
}

