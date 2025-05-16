<?php
include("config/local.php");

global $servername, $username, $password, $dbname;

$id = $_GET['id'];
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM phones WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$phone = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upraviť telefón</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Upraviť telefón</h2>
    <form action="edit_phone_action.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $phone['id']; ?>">
        <div class="form-group">
            <label for="brand">Značka:</label>
            <input type="text" class="form-control" id="brand" name="brand" value="<?php echo htmlspecialchars($phone['brand']); ?>" required>
        </div>
        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" class="form-control" id="model" name="model" value="<?php echo htmlspecialchars($phone['model']); ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Cena:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($phone['price']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Upraviť</button>
    </form>
</div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
