# webhookPdS

Projeto para rodar em servidor Linux 10.0.0.5 , com os arquivos e diretórios organizados conforme solicitadárvore abaixo. O projeto envolve criação de um webhook em PHP que recebe um JSON via POST, processa-o para subscrever em um broker MQTT e exibe o log em uma interface web. o sistema pose ser desativado através de um botao na página html.                


```
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
```


### Criação do Diretório de Log

No terminal do servidor, crie o diretório para armazenar os logs:

```
sudo mkdir -p /var/www/html/webhookPdS/logs
sudo touch /var/www/html/webhookPdS/logs/log.txt
sudo chmod 777 /var/www/html/webhookPdS/logs/log.txt  # Permissão de escrita para o log
```
# Comando cron para executar a cada minuto

```
/var/www/html/webhookPdS/shell/webhook_monitor.sh
```

### Documentação do Funcionamento

#### Webhook (PHP):
        O webhook.php recebe uma requisição JSON com o valor da variável variavel, que indica o alarme a ser acionado.
        A variável mqtt_client.php gerencia a conexão e o envio do payload MQTT ao broker.
        Dependendo do valor de variavel, o payload MQTT será enviado como alarme 1 on ou alarme 2 on.

#### Interface Web (HTML e JS):
        A interface index.html exibe um log dinâmico dos payloads recebidos e enviados ao broker.
        Os botões enviam o payload alarme 1 off ou alarme 2 off, dependendo do acionamento.

#### Script de Monitoramento (Shell):
        webhook_monitor.sh garante que o servidor PHP para o webhook esteja sempre ativo.
        O script pode ser configurado no cron para rodar a cada minuto.

        
