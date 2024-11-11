<?php
// Arquivo de configuração com as credenciais de conexão MQTT
$config = [
    'mqtt' => [
        'server' => '10.0.0.32',
        'port' => 1883,
        'username' => 'mqtt',
        'password' => 'planeta',
        'client_id' => 'webhook_server'
    ]
];
return $config;
