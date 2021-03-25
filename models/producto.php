<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of producto
 *
 * @author alberto
 */
class Producto {
    
    private $id; 
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getCategoria_id() {
        return $this->categoria_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getOferta() {
        return $this->oferta;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setCategoria_id($categoria_id): void {
        $this->categoria_id = (int)$this->db->real_escape_string($categoria_id);
    }

    public function setNombre($nombre): void {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function setPrecio($precio): void {
        $this->precio = floatval($this->db->real_escape_string($precio));
    }

    public function setStock($stock): void {
        $this->stock = (int) $this->db->real_escape_string($stock);
    }

    public function setOferta($oferta): void {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setImagen($imagen): void {
        $this->imagen = $imagen;
    }
    
    public function cat_Products($category_id) {
        $sql= "SELECT * FROM productos WHERE categoria_id=$category_id";
        $products= $this->db->query($sql);

        return $products;
    }
    
    public function getAll() {
        $sql= "SELECT * FROM productos ORDER BY id DESC;";
        $products= $this->db->query($sql);
        
        return $products;
    }
    public function getOne() {
        $sql= "SELECT * FROM productos WHERE id={$this->getId()};";
        $product= $this->db->query($sql);
        
        return $product->fetch_object();
    }
    
    public function save() {
        $sql= "INSERT INTO productos values (NULL,{$this->getCategoria_id()},'{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},NULL, curdate(),'{$this->getImagen()}');";
        $save= $this->db->query($sql);

        return $save;

    }
    
    public static function findById($id) {
        $sql= "SELECT * FROM productos WHERE id=$id;";
        $product= Database::connect()->query($sql);              
        $result = ($product->num_rows==1) ? $product->fetch_object() : null;

        return $result;
    }
    
    public function edit() {
        $sql= "UPDATE productos set  categoria_id={$this->getCategoria_id()}, nombre= '{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}";
        if($this->getImagen()!=null){
            $sql.= ", imagen='{$this->getImagen()}'";           
        }
        $sql.= " WHERE id={$this->getId()};";
        

        $edited= $this->db->query($sql);

        return $edited;
    }
    
    public static function delete($id) {
        $sql= "DELETE FROM productos WHERE id=$id;";
        $deleted= Database::connect()->query($sql);

        return $deleted;
    }
    
    public function getRandom($limit) {
        $sql= "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
        $save= $this->db->query($sql);

        return $save;
    }
}
