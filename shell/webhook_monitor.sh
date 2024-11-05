#!/bin/bash
# webhook_monitor.sh

PHP_PATH="/usr/bin/php"
WEBHOOK_PATH="/var/www/html/webhookPdS/php/webhook.php"
LOG_FILE="/var/www/html/webhookPdS/logs/monitor.log"

# Checa se o processo está ativo
if ! pgrep -f "$PHP_PATH $WEBHOOK_PATH" > /dev/null; then
    nohup $PHP_PATH $WEBHOOK_PATH > /dev/null 2>&1 &
    echo "$(date): Webhook reiniciado" >> $LOG_FILE
fi

# Comando cron para executar a cada minuto
# * * * * * /var/www/html/webhookPdS/shell/webhook_monitor.sh
