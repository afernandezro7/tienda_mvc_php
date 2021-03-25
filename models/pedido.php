<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pedido
 *
 * @author alberto
 */
class Pedido {
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUsuario_id() {
        return $this->usuario_id;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCoste() {
        return $this->coste;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUsuario_id($usuario_id): void {
        $this->usuario_id = (int)$usuario_id;
    }

    public function setProvincia($provincia): void {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    public function setLocalidad($localidad): void {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    public function setDireccion($direccion): void {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function setCoste($coste): void {
        $this->coste = $coste;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setHora($hora): void {
        $this->hora = $hora;
    }
    
    public function save() {
        $sql="INSERT INTO pedidos VALUES(NULL,{$this->getUsuario_id()},'{$this->getProvincia()}','{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', curdate(), curtime())";
        $resp=$this->db->query($sql);
        
        return $resp;
    }
    
    public function save_line() {
        $sql="SELECT LAST_INSERT_ID() AS 'id_pedido';";               
        $resp=$this->db->query($sql);       
        $id_pedido=(int)$resp->fetch_object()->id_pedido;
        
        $foreach_result=true;
        foreach($_SESSION['carrito'] as $index => $element){
            $id_producto=(int)$element['id_producto'];
            $unidades=(int)$element['unidades'];
            $sql="INSERT INTO lineas_pedidos VALUES(NULL,$id_pedido ,$id_producto,$unidades );";
            $resp2=$this->db->query($sql); 
            
            $foreach_result= $foreach_result && $resp2;
        }
        
        return $foreach_result && $resp;
    }
    
    public function getAll() {
        $sql='SELECT * FROM pedidos ORDER BY id DESC;';
        $pedidos=$this->db->query($sql);
        
        return $pedidos;
    }
    
    public function getOne() {
        $sql="SELECT * FROM pedidos WHERE id={$this->getId()};";
        $pedido=$this->db->query($sql);
        return $pedido->fetch_object(); 
    }
    
    public function getOneByUser() {
        $sql="SELECT p.id, p.coste FROM pedidos p "
            //."INNER JOIN lineas_pedidos lp ON lp.pedido_id=p.id "  
            ."WHERE p.usuario_id={$this->getUsuario_id()} "
            ."ORDER BY p.id DESC LIMIT 1";
        $pedido=$this->db->query($sql);
        
        return $pedido->fetch_object();  
    }
    
    public function getProductByPedido($id) {
        $sql="SELECT pr.*, lp.unidades FROM productos pr "
            ."INNER JOIN lineas_pedidos lp ON pr.id=lp.producto_id "
            ."WHERE lp.pedido_id={$id};";
        $productos=$this->db->query($sql);

        return $productos;
    }
    
    public function getAllByUser() {
        $sql="SELECT * FROM pedidos "
            ."WHERE usuario_id={$this->getUsuario_id()} "
            . "ORDER BY id DESC";
            
        $pedidos=$this->db->query($sql);
        
        return $pedidos;  
    }
    
    public function updateOne() {
        $sql="UPDATE pedidos set  estado='{$this->getEstado()}' WHERE id={$this->getId()};";
        $pedido=$this->db->query($sql);
        return $pedido; 
    }
}
