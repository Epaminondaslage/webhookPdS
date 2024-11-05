<img src="/img/webhook.jpg" width="50%" />
# Webhook Sitio Pé de Serra


## O que é Webhook

Um webhook é um método de comunicação entre sistemas, onde uma aplicação envia dados para outra de maneira automática e em tempo real quando um evento específico ocorre. Em vez de a aplicação de destino precisar solicitar informações repetidamente (o que é conhecido como "polling"), o webhook notifica assim que há uma atualização ou evento, proporcionando uma comunicação mais rápida e eficiente.

## Como Funciona um Webhook?

Um webhook funciona como um "ponto de escuta" que recebe dados automaticamente. Ele é configurado como uma URL específica onde a aplicação de origem envia uma requisição HTTP (geralmente do tipo POST) assim que o evento ocorre. Essa requisição contém informações do evento no formato de um payload JSON (ou outro formato), que a aplicação de destino processa.

## Usos Comuns de Webhooks

* Notificações em tempo real: Receber atualizações instantâneas sobre novos pedidos, pagamentos ou eventos de sistema.
* Integrações entre serviços: Conectar diferentes serviços, como receber notificações de novas issues do GitHub em um canal do Slack.
* Automatização de tarefas: Criar workflows automáticos, como enviar um email ou atualizar registros em uma planilha.

## Estrutura de uma Requisição de Webhook

* URL do Webhook: A URL que a aplicação de origem envia os dados do evento.
* Método HTTP: Normalmente POST, mas pode variar.
* Headers HTTP: Contêm metadados sobre a requisição.
* Payload: Dados enviados (normalmente em JSON), que descrevem o evento e suas informações.

## Vantagens de Usar Webhooks

* Eficiência: Diminui o número de chamadas desnecessárias entre sistemas.
* Tempo Real: Notifica assim que um evento ocorre, ao contrário do polling, que pode ter atrasos.
* Escalabilidade: Suporta uma comunicação mais rápida e simplificada entre vários sistemas.

## Diagrama de conexões 

<img src="/img/arquitetura.png" width="50%" />

##  WebhookPdS

Projeto para rodar em servidor Linux 10.0.0.5 , com os arquivos e diretórios organizados conforme a árvore abaixo. O projeto envolve criação de um webhook em PHP que recebe um JSON via POST, processa-o para subscrever em um broker MQTT e exibe o log em uma interface web. o sistema pose ser desativado através de um botao na página html.  

**Servidor** 
```
http://10.0.0.5/var/www/html/webhookPdS
```
## Estrurura do Serviço

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

No terminal do servidor (10.0.0.5), crie o diretório para armazenar os logs:

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

### Definições do Broker MQTT

```
brokerIp = "10.0.0.32";
brokerPort = 1883;
topic = "alarme";
username = "mqtt";
password = "planeta";
```

#### Webhook (PHP):
        
O webhook.php recebe uma requisição JSON com o valor da variável variavel, que indica o alarme a ser acionado. A variável mqtt_client.php gerencia a conexão e o envio do payload MQTT ao broker. Dependendo do valor de variavel, o payload MQTT será enviado como alarme 1 on ou alarme 2 on.

```
PHP_PATH="/usr/bin/php"
WEBHOOK_PATH="/var/www/html/webhookPdS/php/webhook.php"
LOG_FILE="/var/www/html/webhookPdS/logs/monitor.log"
```
    

#### Interface Web (HTML e JS):

A interface index.html exibe um log dinâmico dos payloads recebidos e enviados ao broker. Os botões enviam o payload alarme 1 off ou alarme 2 off, dependendo do acionamento.

#### Script de Monitoramento (Shell):

webhook_monitor.sh garante que o servidor PHP para o webhook esteja sempre ativo. O script pode ser configurado no cron para rodar a cada minuto.

        
