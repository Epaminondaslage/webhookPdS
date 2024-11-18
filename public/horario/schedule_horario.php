<?php
$day = $_POST['day'];
$time_on = $_POST['time_on'];
$time_off = $_POST['time_off'];

$server = "10.0.0.32";
$port = 1883;
$username = "mqtt";
$password = "planeta";
$topic = "horario_alarm";

// Comando MQTT para ativação e desativação
$command_on = "php mqtt_client.php '$server' '$port' '$username' '$password' '$topic' 'alarm on'";
$command_off = "php mqtt_client.php '$server' '$port' '$username' '$password' '$topic' 'alarm off'";

// Configuração de cron para ativar e desativar o alarme nos horários especificados
exec("(crontab -l; echo '$time_on * * $day $command_on') | crontab -");
exec("(crontab -l; echo '$time_off * * $day $command_off') | crontab -");

// Testa a publicação diretamente
$output_on = shell_exec($command_on);
$output_off = shell_exec($command_off);

echo "Resultado do teste de conexão: <br>";
echo "Ativação: " . ($output_on ?: "Erro ao conectar no broker") . "<br>";
echo "Desativação: " . ($output_off ?: "Erro ao conectar no broker") . "<br>";
?>

