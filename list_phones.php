<!doctype html>
<html lang="en">
<head>
    <title>Zoznam telefónov</title>
</head>
<body>
<div class="container">
    <h2>Zoznam telefónov</h2>
    <?php
    include("config/local.php");
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT id, brand, model, price FROM phones";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo "<thead><tr><th>ID</th><th>Značka</th><th>Model</th><th>Cena</th><th>Akcie</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["brand"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["model"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["price"]) . " €</td>";
            echo "<td>";
            echo "<a href='edit_phone_form.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-warning btn-sm'>Upraviť</a> ";
            echo "<a href='delete_phone_action.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Naozaj chcete vymazať tento záznam?\");'>Vymazať</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Žiadne výsledky</p>";
    }
    $conn->close();
    ?>
</div>
</body>
</html>
