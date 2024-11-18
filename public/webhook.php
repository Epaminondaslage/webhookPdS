<?php

//****************************************************************************************************
//*         Este arquivo deve ser copiado no diretorio /var/www/html/webhookPdS/public               *
//*                                    VERSAO 11 de Novembro 2024                                    *
//*                  Este HTML é executado automaticamente  pelo /webhookPdS/public/index.php        *
//*                     Arquivo de visualização de log de webhook do sistema de Alarme               *
//****************************************************************************************************
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

    // Atua no Arduino Mini 01
    if($data['camera_name'] === 'Abcd'){
        $topic = "O1";
        $mqttClient->publish($topic, 'A');
    }
    if($data['camera_name'] === 'aBcd'){
        $topic = "O1";
        $mqttClient->publish($topic, 'B');
    }
    if($data['camera_name'] === 'abCd'){
        $topic = "O1";
        $mqttClient->publish($topic, 'C');
    }
    if($data['camera_name'] === 'abcD'){
        $topic = "O1";
        $mqttClient->publish($topic, 'D');
    }

    // Atua no Arduino Mini 02
    if($data['camera_name'] === 'Abcd'){
        $topic = "O2";
        $mqttClient->publish($topic, 'A');
    }
    if($data['camera_name'] === 'aBcd'){
        $topic = "O2";
        $mqttClient->publish($topic, 'B');
    }
    if($data['camera_name'] === 'abCd'){
        $topic = "O2";
        $mqttClient->publish($topic, 'C');
    }
    if($data['camera_name'] === 'abcD'){
        $topic = "O2";
        $mqttClient->publish($topic, 'D');
    }

    // Atua no Arduino Mini 03
    if($data['camera_name'] === 'Abcd'){
        $topic = "O3";
        $mqttClient->publish($topic, 'A');
    }
    if($data['camera_name'] === 'aBcd'){
        $topic = "O3";
        $mqttClient->publish($topic, 'B');
    }
    if($data['camera_name'] === 'abCd'){
        $topic = "O3";
        $mqttClient->publish($topic, 'C');
    }
    if($data['camera_name'] === 'abcD'){
        $topic = "O3";
        $mqttClient->publish($topic, 'D');
    }
    $mqttClient->close();

    http_response_code(200);
    echo json_encode(['status' => 'Webhook recebido e enviado ao MQTT com sucesso']);

} else {
    http_response_code(500);
    echo json_encode(['error' => 'Falha ao conectar ao broker MQTT']);
}
?>
