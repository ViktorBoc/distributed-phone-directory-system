<?php
include("config/local.php");
include("config/remote_node2.php");
include("config/remote_node3.php");

$id = $_GET['id'];

// SQL dotaz pre lokálnu databázu
$local_sql = "DELETE FROM phones WHERE id='$id'";
$remote_sql = $local_sql; // Rovnaký dotaz pre vzdialené uzly

// Funkcia na uloženie zlyhaného dotazu do súboru
function logFailedTransaction($sql) {
    file_put_contents('failed_transactions.txt', $sql . PHP_EOL, FILE_APPEND);
}

// Pripojenie k lokálnej databáze
$local_conn = new mysqli($servername, $username, $password, $dbname);
if ($local_conn->connect_error) {
    die("Connection failed to local DB: " . $local_conn->connect_error);
}
if ($local_conn->query($local_sql) === TRUE) {
    echo "Record successfully deleted in the local database.<br>";
} else {
    echo "Error: " . $local_conn->error;
}
$local_conn->close();

// Pokus o synchronizáciu s Uzlom 2
try {
    $remote_conn2 = new mysqli($remote_servername2, $remote_username2, $remote_password2, $remote_dbname2);
    if ($remote_conn2->connect_error) {
        throw new Exception("Connection failed to remote DB on Node 2: " . $remote_conn2->connect_error);
    }
    if (!$remote_conn2->query($remote_sql)) {
        throw new Exception("Error executing query on Node 2: " . $remote_conn2->error);
    }
    $remote_conn2->close();
} catch (Exception $e) {
    logFailedTransaction($remote_sql);
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}

// Pokus o synchronizáciu s Uzlom 3
try {
    $remote_conn3 = new mysqli($remote_servername3, $remote_username3, $remote_password3, $remote_dbname3);
    if ($remote_conn3->connect_error) {
        throw new Exception("Connection failed to remote DB on Node 3: " . $remote_conn3->connect_error);
    }
    if (!$remote_conn3->query($remote_sql)) {
        throw new Exception("Error executing query on Node 3: " . $remote_conn3->error);
    }
    $remote_conn3->close();
} catch (Exception $e) {
    logFailedTransaction($remote_sql);
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}

// Presmerovanie po úspešnom alebo neúspešnom zápise
header('Location: index.php?menu=8');
exit;
?>
