<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribuovaná databáza telefónov</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 900px; margin: 0 auto; }
        .header { background-color: #220075; color: #FFFF00; padding: 20px; text-align: center; }
        .sidebar { width: 200px; background-color: #aa0055; padding: 20px; color: #FFFFFF; }
        .content { padding: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Distribuovaná databáza telefónov</h1>
    </div>
    <div class="row">
        <div class="col-md-3 sidebar">
            <?php include("sidebar_menu.php"); ?>
        </div>
        <div class="col-md-9 content">
            <?php
            $m = isset($_GET["menu"]) ? $_GET["menu"] : 3;
            switch ($m) {
                case 4:
                    include("sync_failed_transactions.php");
                    break;
                case 2:
                    include("add_phone_form.php");
                    break;
                case 3:
                default:
                    include("list_phones.php");
                    break;
            }
            ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
