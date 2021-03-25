<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of carritoController
 *
 * @author alberto
 */
require_once 'models/producto.php';
require_once 'helpers/utils.php';
class carritoController {
    
    public function index() {
        $carrito = null;
        if(isset($_SESSION['carrito'])){               
            $carrito = $_SESSION['carrito']; 
            
        }
        
        require 'views/carrito/index.php';
    }
    
    public function add() {
        if($_GET['id']){
            $product_id=$_GET['id'];
            
            if(!isset($_SESSION['carrito'])){
                $_SESSION['carrito']=array();
            }
            
            $producto= Producto::findById($product_id);

            if(is_object($producto)){
                $counter=0;
                foreach ($_SESSION['carrito'] as $indice => $elemento ) {
                    
                    if($elemento['id_producto']==$producto->id){
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $counter++;                       
                    }
                }
                
                if($counter==0){
                    $_SESSION['carrito'][]=array(
                        "id_producto"=>$producto->id,
                        "precio"=>$producto->precio,
                        "unidades"=>1,
                        "producto"=>$producto
                    );                                     
                }                
            }
            header("Location: ".base_url."carrito/index");
            
        } else {
            header("Location: ".base_url);
        } 
    }
    
    public function delete() {
        
        if( isset($_GET['index']) && isset($_SESSION['carrito'])){
            $indice= (int)$_GET['index'];
            unset($_SESSION['carrito'][$indice]);
        }
        header('Location: '.base_url."carrito/index");
    }
    public function up() {
        
        if( isset($_GET['index']) && isset($_SESSION['carrito'])){
            $indice= (int)$_GET['index'];
            $_SESSION['carrito'][$indice]['unidades']++;
        }
        header('Location: '.base_url."carrito/index");
    }
    public function down() {
        
        if( isset($_GET['index']) && isset($_SESSION['carrito'])){
            $indice= (int)$_GET['index'];
            if($_SESSION['carrito'][$indice]['unidades']>1){             
                $_SESSION['carrito'][$indice]['unidades']--;
            }
        }
        header('Location: '.base_url."carrito/index");
    }
    
    public function delete_all() {
        Utils::deleteSession('carrito');
        header("Location: ".base_url."carrito/index");
    }
}
