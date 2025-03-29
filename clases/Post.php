<?php 

class Post
{
    private $id;
    private $title;
    private $description;
    private $publicationDate;
    private $publication;
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getDatos($title, $description, $publicationDate,$publication)
    {
        $this->title=$title;
        $this->description=$description;
        $this->publicationDate=$publicationDate;
        $this->publication=$publication;
    }

    public function posts()
    {
        try{
            $stmt = $this->conexion->prepare("INSERT INTO posts (title, description, publication_date, publication) VALUE (?,?,?,?)");
            $stmt->bind_param("ssss", $this->title, $this->description, $this->publicationDate, $this->publication);

            if($stmt->execute()){
                return true;
            }else{
                throw new Exception("No se ha podido insertar en la base de datos");
            }
        }catch(Exception $e){
            return $e->GetMessage();
        }
    }
}