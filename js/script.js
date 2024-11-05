// script.js
document.addEventListener("DOMContentLoaded", function () {
    fetchLog();
    setInterval(fetchLog, 3000); // Atualiza o log a cada 3 segundos
});

function fetchLog() {
    fetch("../logs/log.txt") // Novo caminho para o log
        .then(response => response.text())
        .then(data => {
            document.getElementById("log").innerText = data;
        });
}

function sendPayload(payload) {
    fetch("../php/webhook.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ "variavel": payload })
    }).then(response => response.json())
      .then(data => alert(data.status || data.error));
}
