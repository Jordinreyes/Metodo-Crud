<?php 
    require_once "../clases/Delete.php";
    require_once "../conexionGbd/conexion.php";
    require_once "../clases/Select.php";

    $get = new Select($conexion);
    $select = $get->get();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["id"])){
            return "error";
        }else{
            $id = $_POST["id"];
        };

        $delete = new Delete($conexion);
        $delete->id($id);
        $delete->delete();        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    <?php require_once "../navbar/navbar.php" ?>
    
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
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $value["id"] ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php }?>
    </table>
</body>
</html>