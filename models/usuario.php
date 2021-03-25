<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author alberto
 */

class Usuario {
    
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
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

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setId($id): void {
        $this->id = $this->db->real_escape_string($id);
    }

    public function setNombre($nombre): void {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setApellidos($apellidos): void {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function setEmail($email): void {
        $this->email = $this->db->real_escape_string($email);
    }

    public function setPassword($password): void {
        $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost'=>4]);
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }

    public function setImagen($imagen): void {
        $this->imagen = $imagen;
    }

    public function save() {
        $sql= "INSERT INTO usuarios values (NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user',NULL);";
        $save= $this->db->query($sql);

        return $save;
    }
    
    public function login($password) {
        $sql= "SELECT * FROM usuarios WHERE email='{$this->getEmail()}'";
        $login= $this->db->query($sql);
        
        $result=false;
        
        if($login && $login->num_rows==1){
            $usuariodb = $login->fetch_object();
            
            if(password_verify($password, $usuariodb->password) ){
                $result= $usuariodb;
            }
        }
        
        return $result;           
    }
    
    public function getOne() {
        $sql= "SELECT * FROM usuarios WHERE id={$this->getId()}";
        $usuario= $this->db->query($sql);
        
        return $usuario->fetch_object();
    }
}
