<?php
require_once("../config/config.php");
require_once("../src/MqttClient.php");
require_once("../src/WebhookHandler.php");

// Configurando cabeçalho para aceitar JSON
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido. Use POST.']);
    exit();
}

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE || !isset($data['event_type'], $data['event'], $data['camera_name'], $data['analytics_name'])) {
    http_response_code(400);
    echo json_encode(['error' => 'JSON inválido ou campos ausentes.']);
    exit();
}

// Log do payload
WebhookHandler::logPayload($data);

$message = WebhookHandler::formatMqttMessage($data);
$config = require('../config/config.php');

$mqttClient = new MqttClient($config['mqtt']);
if ($mqttClient->connect()) {
    $topic = "eventos/object_detection_event/" . $data['camera_name'];
    $mqttClient->publish($topic, $message);
    $mqttClient->close();

    http_response_code(200);
    echo json_encode(['status' => 'Webhook recebido e enviado ao MQTT com sucesso']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Falha ao conectar ao broker MQTT']);
}
?>
