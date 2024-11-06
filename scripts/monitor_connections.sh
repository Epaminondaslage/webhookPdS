#!/bin/bash

CONFIG_FILE="/var/www/html/webhookPdS/config/config.php"
MQTT_SERVER=$(php -r "include('$CONFIG_FILE'); echo \$config['mqtt']['server'];")
MQTT_PORT=$(php -r "include('$CONFIG_FILE'); echo \$config['mqtt']['port'];")
MQTT_CLIENT_ID=$(php -r "include('$CONFIG_FILE'); echo \$config['mqtt']['client_id'];")

if mosquitto_pub -h "$MQTT_SERVER" -p "$MQTT_PORT" -t "test/connection" -m "connection_check" -i "$MQTT_CLIENT_ID" -q 1; then
    echo "$(date): Conexão MQTT está ativa."
else
    echo "$(date): Conexão MQTT falhou. Tentando reconectar..."
    php /var/www/html/webhookPdS/public/webhook.php
fi