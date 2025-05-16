<?php
include("config/remote_node2.php");
include("config/remote_node3.php");

function syncFailedTransactions($remote_servername, $remote_username, $remote_password, $remote_dbname, $filename) {
    @$conn = new mysqli($remote_servername, $remote_username, $remote_password, $remote_dbname);

    if ($conn->connect_error) {
        echo "<div class='alert alert-danger'>Failed to connect to remote DB on {$remote_servername}: {$conn->connect_error}</div>";
        return false;
    }

    $success = true;
    if (file_exists($filename) && filesize($filename) > 0) {
        $queries = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($queries as $query) {
            $query = str_replace("INSERT INTO", "INSERT IGNORE INTO", $query);
            echo "<div>Attempting query on {$remote_servername}: {$query}</div>";

            if ($conn->query($query) === TRUE) {
                echo "<div class='alert alert-success'>Query executed successfully on {$remote_servername}: {$query}</div>";
            } else {
                echo "<div class='alert alert-danger'>Error executing query on {$remote_servername}: {$conn->error}</div>";
                $success = false;
                break;
            }
        }
    } else {
        echo "<div class='alert alert-info'>No failed transactions to sync for {$remote_servername}.</div>";
    }

    $conn->close();

    return $success;
}

$filename = 'failed_transactions.txt';

$node2_synced = syncFailedTransactions($remote_servername2, $remote_username2, $remote_password2, $remote_dbname2, $filename);
$node3_synced = syncFailedTransactions($remote_servername3, $remote_username3, $remote_password3, $remote_dbname3, $filename);

if ($node2_synced && $node3_synced) {
    file_put_contents($filename, '');
    echo "<div class='alert alert-success'>All nodes synchronized successfully. Failed transactions cleared.</div>";
} else {
    echo "<div class='alert alert-warning'>Some nodes failed to synchronize. The failed transactions file was not cleared.</div>";
}
?>
