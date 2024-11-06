<?php
// Arquivo de configuração com as credenciais de conexão MQTT
$config = [
    'mqtt' => [
        'server' => 'broker.endereco.com',
        'port' => 1883,
        'username' => 'usuario',
        'password' => 'senha',
        'client_id' => 'webhook_server'
    ]
];
return $config;
