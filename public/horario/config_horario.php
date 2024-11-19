<?php
// config/config.php
return [
    'server' => '10.0.0.32',
    'port' => 1883,
    'username' => 'mqtt',
    'password' => 'planeta',
    'client_id' => 'ClientID_' . rand(),
    'topic' => 'horario_alarm',
];