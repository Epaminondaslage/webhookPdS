# webhookPdS
web hook sistema de alarme sitio pe de serra


'''
/var/www/html/webhookPdS
├── css
│   └── style.css          # Estilo para o HTML
├── html
│   └── index.html         # Página HTML com log dinâmico
├── js
│   └── script.js          # JavaScript para atualização dinâmica do log
├── php
│   ├── webhook.php        # Arquivo PHP que recebe e processa o webhook
│   └── mqtt_client.php    # Classe para lidar com a conexão MQTT  
├── logs
│   └── log.txt            # Arquivo de log para armazenar as requisições
└── shell
    └── webhook_monitor.sh # Script para manter o servidor ativo e subscrito
'''
