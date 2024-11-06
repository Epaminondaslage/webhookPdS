<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Logs do Webhook</title>
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
            <tbody id="log-table-body"></tbody>
        </table>
    </div>
    <script src="../js/scripts.js"></script>
</body>
</html>
