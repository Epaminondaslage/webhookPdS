document.addEventListener("DOMContentLoaded", function() {
    function loadLogs() {
        fetch("log_data.php")
            .then(response => response.json())
            .then(data => {
                const logTable = document.getElementById("log-table-body");
                logTable.innerHTML = "";
                data.logs.forEach(log => {
                    const row = document.createElement("tr");
                    row.innerHTML = `<td>${log.date}</td><td>${log.message}</td>`;
                    logTable.appendChild(row);
                });
            })
            .catch(error => console.error("Erro ao carregar os logs:", error));
    }
    loadLogs();
    setInterval(loadLogs, 5000);
});
