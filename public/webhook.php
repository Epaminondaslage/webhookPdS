<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("../config/config.php");
require_once("../src/MqttClient.php");
require_once("../src/WebhookHandler.php");

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

WebhookHandler::logPayload($data);


$config = require('../config/config.php');

$mqttClient = new MqttClient($config['mqtt']);
if ($mqttClient->connect()) {


    // regra de negocio para acionamento de cameras aqui.
    // basta programar em ifs no objeto $data (que vem as infos da camera) e enviar mensagem para o mqtt usando a biblioteca no formato abaixo
    //$data['event']['camera_id']

    if($data['camera_name'] === 'abc'){
        $topic = "O2";
        $mqttClient->publish($topic, 'A');
    }

    if($data['camera_name'] === '123'){
        $topic = "O1";
        $mqttClient->publish($topic, 'A');
    }

    $mqttClient->close();

    http_response_code(200);
    echo json_encode(['status' => 'Webhook recebido e enviado ao MQTT com sucesso']);

} else {
    http_response_code(500);
    echo json_encode(['error' => 'Falha ao conectar ao broker MQTT']);
}
?>
