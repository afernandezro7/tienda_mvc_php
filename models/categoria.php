<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoria
 *
 * @author alberto
 */
class Categoria {
    private $id;
    private $nombre;
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    
    public function getAll() {
        $sql='SELECT * FROM categorias;';
        $categories=$this->db->query($sql);
        
        return $categories;
    }
    public function getOne($id) {
        $sql="SELECT * FROM categorias WHERE id=$id;";
        $categoria=$this->db->query($sql);
        
        return $categoria->fetch_object();
    }
    
    public function save() {
        $sql="INSERT INTO categorias VALUES(null,'{$this->getNombre()}');";
        $resp=$this->db->query($sql);
        
        return $resp;
    }

}
