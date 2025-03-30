<?php 

    require_once "../clases/Post.php";
    require_once "../conexionGbd/conexion.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $error = [];

    
        if(empty($_POST["title"])){
            $error["title"] = "<b style='color:#f00'>Campo obligatorio</b>" . "<br>";
        }else{
            $title = htmlspecialchars($_POST["title"]);
        };

        if(empty($_POST["description"])){
            $error["description"] = "<b style='color:#f00'>Campo obligatorio</b>" . "<br>";
        }else{
            $description = htmlspecialchars($_POST["description"]);
        };

        if(empty($_POST["publicationDate"])){
            $error["publicationDate"] = "<b style='color:#f00'>Campo obligatorio</b>" . "<br>";
        }else{
            $publicationDate = htmlspecialchars($_POST["publicationDate"]);
        };

        if(empty($_POST["publication"])){
            $error["publication"] = "<b style='color:#f00'>Campo obligatorio</b>" . "<br>";
        }else{
            $publication = htmlspecialchars($_POST["publication"]);
        };

        if(empty($error)){
            try{
                $post = new Post($conexion);
                $post->getDatos($title, $description, $publicationDate, $publication);

                if($post->posts()){
                    echo "<h1 style='color:green'>Added News</h1>";
                }else{
                    throw new Exception("No se ha podido insertar en la base de datos");
                }
            }catch(Exception $e){
                echo "<b>Error: </b>" . $e->GetMessage();
            };
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Post</title>
</head>
<body>
    <?php require_once "../navbar/navbar.php" ?>
    
    <form action="" method="post">
        <h1>Add News</h1>
        <div>
            <?= isset($error["title"]) ? $error["title"] : '' ?>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div><br>

        <div>
            <?= isset($error["description"]) ? $error["description"] : '' ?>
            <label for="description">Description: </label>
            <input type="text" name="description" id="description">
        </div><br>

        <div>
            <?= isset($error["publicationDate"]) ? $error["publicationDate"] : '' ?>
            <label for="publicationDate">Publication Date: </label>
            <input type="date" name="publicationDate" id="publicationDate">
        </div><br>

        <div>
            <label for="publication">Publication: 
                <select name="publication" id="publication">
                    <?php $options = ["Choose a option","Si", "No"] ?>;
                    <?php foreach($options as $value){ ?>
                        <option><?=$value?></option>
                    <?php }?>
                </select>
            </label>
        </div><br>
        
        <button type="submit">Add News</button>
    </form>
</body>
</html>