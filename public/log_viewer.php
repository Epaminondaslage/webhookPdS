<!DOCTYPE html>
<!--
****************************************************************************************************
*         Este arquivo deve ser copiado no diretorio /var/www/html/webhookPdS/public               *
*                                    VERSAO 11 de Novembro 2024                                    *
*                  Este HTML é executado automaticamente  pelo /webhookPdS/public/index.php        *
*                     Arquivo de visualização de log de webhook do sistema de Alarme               *
****************************************************************************************************
-->
<html lang="pt-BR">
<head>
    <!-- Define a codificação de caracteres como UTF-8 -->
    <meta charset="UTF-8">
    
    <!-- Configura a viewport para responsividade em dispositivos móveis -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Título da página que aparece na aba do navegador -->
    <title>Visualização de Logs do Webhook</title>
    
    <!-- Link para o arquivo CSS externo -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <!-- Contêiner principal da página -->
    <div class="container">
        <!-- Cabeçalho principal -->
        <h1>Logs de Eventos do Webhook</h1>
        
        <!-- Descrição da tabela de logs -->
        <p>Esta tabela exibe os eventos recebidos pelo webhook e atualiza automaticamente a cada 5 segundos.</p>
        
        <!-- Contêiner para a tabela de logs com rolagem interna -->
        <div class="log-container">
            <table>
                <thead>
                    <!-- Cabeçalho da tabela com duas colunas: Data e Hora, e Mensagem -->
                    <tr>
                        <th>Data e Hora</th>
                        <th>Mensagem</th>
                    </tr>
                </thead>
                
                <!-- Corpo da tabela onde os logs serão inseridos dinamicamente -->
                <tbody id="log-table-body"></tbody>
            </table>
        </div>
    </div>
    
    <!-- Link para o arquivo JavaScript externo -->
    <script src="../js/scripts.js"></script>
</body>
</html>
