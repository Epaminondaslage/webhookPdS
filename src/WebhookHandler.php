<?php

class WebhookHandler {
    public static function logPayload($data) {
        // Registra o payload recebido no arquivo de log
        $logEntry = date('Y-m-d H:i:s') . " - " . json_encode($data) . PHP_EOL;
        file_put_contents('/var/www/html/webhookPdS/logs/webhook_log.txt', $logEntry, FILE_APPEND);
    }

    public static function formatMqttMessage($data) {
        // Formata a mensagem para publicação no broker MQTT
        return json_encode([
            'event_type' => $data['event_type'],
            'camera' => [
                'id' => $data['event']['camera_id'],
                'name' => $data['camera_name']
            ],
            'analytics' => [
                'id' => $data['event']['analytics_id'],
                'name' => $data['analytics_name']
            ],
            'timestamp' => $data['event']['event_timestamp'],
            'files' => [
                'video' => $data['event']['video_filename'],
                'thumbnail' => $data['event']['thumbnail_filename']
            ]
        ]);
    }
}
