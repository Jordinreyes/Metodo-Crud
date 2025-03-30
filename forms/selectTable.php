<?php 
    require_once "../clases/Select.php";
    require_once "../conexionGbd/conexion.php";

    $get = new Select($conexion);
    $select = $get->get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select</title>
</head>
<body>
    <?php require_once "../navbar/navbar.php" ?>
    
    <h1 style='color:#48e'>All the news</h1>
    <table border="1">
        <tr>
            <th>ID NEW</th>
            <th>News title</th>
            <th>Description</th>
            <th>Publication Date</th>
            <th>Publication</th>
        </tr>

        <?php foreach ($select as $value){ ?>
            <tr>
                <td><?= $value["id"] ?></td>
                <td><?= $value["title"] ?></td>
                <td><?= $value["description"] ?></td>
                <td><?= $value["publication_date"] ?></td>
                <td><?= $value["publication"] ?></td>
            </tr>
        <?php }?>
    </table>
</body>
</html>