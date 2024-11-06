document.addEventListener("DOMContentLoaded", function() {
    // Função para carregar logs dinamicamente
    function loadLogs() {
        fetch("log_data.php")
            .then(response => response.json())
            .then(data => {
                const logTable = document.getElementById("log-table-body");
                logTable.innerHTML = ""; // Limpa a tabela antes de adicionar novos logs

                // Itera sobre os logs e os adiciona à tabela
                data.logs.forEach(log => {
                    const row = document.createElement("tr");

                    const dateCell = document.createElement("td");
                    dateCell.textContent = log.date;
                    row.appendChild(dateCell);

                    const messageCell = document.createElement("td");
                    messageCell.textContent = log.message;
                    row.appendChild(messageCell);

                    logTable.appendChild(row);
                });
            })
            .catch(error => console.error("Erro ao carregar os logs:", error));
    }

    // Carregar logs inicialmente e depois a cada 5 segundos
    loadLogs();
    setInterval(loadLogs, 5000);
});
