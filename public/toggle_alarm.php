<?php
//****************************************************************************************************
//*         Este arquivo deve ser copiado no diretorio /var/www/html/webhookPdS/public               *
//*                                    VERSAO 13 de Novembro 2024                                    *
//*                  É executado automaticamente  pelo /webhookPdS/public/alarm_status.html          *
//*                                 Arquivo: toggle_alarm.php                                        *
//*   Este arquivo lida com a publicacao do estado do alarme no broker MQTT e a criacao do log       * 
//****************************************************************************************************

require('../vendor/autoload.php');
use Bluerhinos\phpMQTT;

$server = "10.0.0.32";
$port = 1883;
$username = "mqtt";
$password = "planeta";
$topic = "status_alarm";
$logFile = '../logs/mqtt_log.txt';

try {
    // Cria o diretório de logs, caso não exista
    if (!file_exists('../logs')) {
        mkdir('../logs', 0777, true);
    }

    // Conecta ao broker MQTT
    $mqtt = new phpMQTT($server, $port, "webhookPdS_client");
    if (!$mqtt->connect(true, NULL, $username, $password)) {
        throw new Exception("Erro ao conectar ao Broker MQTT.");
    }

    // Verifica o status atual do tópico
    $initialStatus = "Alarme Desligado";
    $statusReceived = false;

    $mqtt->subscribe([$topic => ['qos' => 0, 'function' => function($topic, $msg) use (&$initialStatus, &$statusReceived) {
        $initialStatus = $msg;
        $statusReceived = true;
    }]], 0);

    // Aguarda uma mensagem até ser recebida ou até o timeout de 5 segundos
    $timeout = time() + 5;
    while ($mqtt->proc() && time() < $timeout && !$statusReceived) {
    }
    $mqtt->close();

    // Publica a mensagem recebida via POST no tópico MQTT
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $mqtt = new phpMQTT($server, $port, "webhookPdS_client");
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish($topic, $status, 0);
            $mqtt->close();

            // Registra a mensagem no arquivo de log
            $logMessage = date('Y-m-d H:i:s') . " - Status: " . $status . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);

            // Retorna uma resposta JSON indicando sucesso
            echo json_encode(['status' => 'success', 'message' => 'Alarme atualizado para: ' . $status, 'initial_status' => $status]);
        }
    } else {
        // Retorna o status inicial se nenhum POST for feito
        echo json_encode(['status' => 'success', 'initial_status' => $initialStatus]);
    }
} catch (Exception $e) {
    // Em caso de erro, registra o erro no arquivo de log e retorna uma resposta JSON indicando falha
    $logMessage = date('Y-m-d H:i:s') . " - Erro: " . $e->getMessage() . "\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>