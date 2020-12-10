<?php
require_once 'models/conection.model.php';

class CiudadModel extends ConectionModel
{

    public function get($id)
    {
        $sentencia = $this->db->prepare("SELECT * FROM ciudad WHERE id = ?");
        $sentencia->execute($id);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function getAll()
    {
        $sentencia = $this->db->prepare("SELECT * FROM ciudad");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

}
