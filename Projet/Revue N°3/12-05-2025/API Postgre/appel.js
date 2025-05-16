document.getElementById("loadData").addEventListener("click", function () {
    // Appeler l'API pour récupérer les données
    fetch("api.php?action=getData")
        .then(response => response.json())
        .then(data => {
            const display = document.getElementById("dataDisplay");
            display.innerHTML = ""; // Réinitialiser l'affichage

            if (data.success) {
                // Construire un tableau des données
                const table = document.createElement("table");
                table.border = "1";
                const headerRow = document.createElement("tr");

                // En-têtes du tableau
                ["ID", "Nom", "Description"].forEach(header => {
                    const th = document.createElement("th");
                    th.textContent = header;
                    headerRow.appendChild(th);
                });

                table.appendChild(headerRow);

                // Ajouter des lignes de données
                data.data.forEach(row => {
                    const tr = document.createElement("tr");
                    Object.values(row).forEach(cellData => {
                        const td = document.createElement("td");
                        td.textContent = cellData;
                        tr.appendChild(td);
                    });
                    table.appendChild(tr);
                });

                display.appendChild(table);
            } else {
                display.textContent = data.message;
            }
        })
        .catch(error => {
            console.error("Erreur lors de la récupération des données :", error);
            document.getElementById("dataDisplay").textContent = "Erreur lors de la récupération des données.";
        });
});

// Gérer l'ajout de données
document.getElementById("addDataForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value;
    const description = document.getElementById("description").value;

    fetch("api.php?action=addData", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `name=${encodeURIComponent(name)}&description=${encodeURIComponent(description)}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                document.getElementById("addDataForm").reset();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error("Erreur lors de l'ajout des données :", error);
            alert("Erreur lors de l'ajout des données.");
        });
});