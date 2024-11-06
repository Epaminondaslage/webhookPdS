<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Logs do Webhook</title>
    <!-- Referência ao arquivo CSS para estilos e responsividade -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Logs de Eventos do Webhook</h1>
        <p>Esta tabela exibe os eventos recebidos pelo webhook e atualiza automaticamente a cada 5 segundos.</p>
        <table>
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Mensagem</th>
                </tr>
            </thead>
            <tbody id="log-table-body">
                <!-- O conteúdo será carregado dinamicamente pelo JavaScript -->
            </tbody>
        </table>
    </div>
    <!-- Referência ao arquivo JavaScript para atualização dinâmica dos logs -->
    <script src="../js/scripts.js"></script>
</body>
</html>
