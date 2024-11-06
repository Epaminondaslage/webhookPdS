<?php
$logFile = '../logs/webhook_log.txt';
$response = ['logs' => []];

if (file_exists($logFile) && is_readable($logFile)) {
    $logs = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($logs as $logEntry) {
        list($dateTime, $message) = explode(" - ", $logEntry, 2);
        $response['logs'][] = [
            'date' => $dateTime,
            'message' => $message
        ];
    }
}

header("Content-Type: application/json");
echo json_encode($response);
