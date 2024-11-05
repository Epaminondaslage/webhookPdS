<?php
// webhook.php
require_once 'mqtt_client.php';

// Recebe e processa o webhook
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !isset($data['variavel'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid payload"]);
    exit;
}

// Definições MQTT
$brokerIp = "10.0.0.32";
$brokerPort = 1883;
$topic = "alarme";
$username = "mqtt";
$password = "planeta";

// Conecta ao broker MQTT
$mqtt = new MQTTClient($brokerIp, $brokerPort, $username, $password);
$payload = "";

switch ($data['variavel']) {
    case 'valor1':
        $payload = "alarme 1 on";
        break;
    case 'valor2':
        $payload = "alarme 2 on";
        break;
    default:
        http_response_code(400);
        echo json_encode(["error" => "Unknown variable value"]);
        exit;
}

// Define o caminho para o log
$logFilePath = "../logs/log.txt";

if ($mqtt->publish($topic, $payload)) {
    file_put_contents($logFilePath, "Publicado: $payload\n", FILE_APPEND);
    echo json_encode(["status" => "Payload enviado com sucesso"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Erro ao enviar payload ao MQTT"]);
}
