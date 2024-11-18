<?php
// public/mqtt_client.php
require_once("../src/MqttClient.php");

$message = $argv[1] ?? 'default_message';

$mqttClient = new MqttClient();
echo $mqttClient->publish($message);
