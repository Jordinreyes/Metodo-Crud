<?php 
    require_once "../conexionGbd/conexion.php";
    require_once "../clases/Select.php";
    require_once "../clases/Update.php";

    $get = new Select($conexion);
    $select = $get->get();

    $title = "";
    $description = "";
    $publicationDate = "";
    $publication = "";

    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])){

        $id = $_GET["id"];
        $stmt = $conexion->prepare("SELECT title, description, publication_date, publication FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($filas = $result->fetch_assoc()) {
            $title = $filas["title"];
            $description = $filas["description"];
            $publicationDate = $filas["publication_date"];
            $publication = $filas["publication"];
        }
    };

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            $id = $_POST["id"] ?? '';
            $title = trim($_POST["title"] ?? '');
            $description = trim($_POST["description"] ?? '');
            $publicationDate = $_POST["publicationDate"] ?? '';
            $publication = $_POST["publication"] ?? '';

            $update = new Update($conexion);
            $update->id($id);
            $update->datos($title, $description, $publicationDate, $publication, $id);

            if($update->update()){
                echo "<h1>Datos actualizado</h1>";
            }else{
                throw new Exception("No se ha podido actualizar los datos");
            }
        }catch (Exception $e){
            echo "<b>Error: </b>" . $e->getMessage();
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <?php require_once "../navbar/navbar.php" ?>
    
    <form action="" method="post">
        <h1 style='color:green'>Update</h1>

        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">

        <div>
            <label for="title">Title: </label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($title) ?>">
        </div><br>

        <div>
            <label for="description">Description: </label>
            <input type="text" name="description" id="description" value="<?= htmlspecialchars($description) ?>">
        </div><br>

        <div>
            <label for="publicationDate">Publication Date: </label>
            <input type="date" name="publicationDate" id="publicationDate" value="<?= htmlspecialchars($publicationDate) ?>">
        </div><br>

        <div>
            <label for="publication">Publication: 
                <select name="publication" id="publication">
                    <?php 
                        $options = ["Choose a option","Si", "No"];
                        foreach($options as $value){ 
                            $selected = ($value == $publication) ? "selected" : "";
                            echo "<option value='$value' $selected>$value</option>";
                        }
                    ?>
                </select>
            </label>
        </div><br>

        <button type="submit">Update</button>
    </form><br><br><br><br>
    
    <table border="1">
        <tr>
            <th>ID NEW</th>
            <th>News title</th>
            <th>Description</th>
            <th>Publication Date</th>
            <th>Publication</th>
            <th>Select</th>
        </tr>

        <?php foreach ($select as $value){ ?>
            <tr>
                <td><?= $value["id"] ?></td>
                <td><?= $value["title"] ?></td>
                <td><?= $value["description"] ?></td>
                <td><?= $value["publication_date"] ?></td>
                <td><?= $value["publication"] ?></td>
                <td>
                    <form action="" method="get">
                        <input type="hidden" name="id" value="<?= $value["id"] ?>">
                        <button type="submit">Select</button>
                    </form>
                </td>
            </tr>
        <?php }?>
    </table>
</body>
</html>
