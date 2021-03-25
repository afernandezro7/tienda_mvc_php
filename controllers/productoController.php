<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'models/producto.php';
class productoController {

    public function index() {
        $producto = new Producto();
        $prod_rand=$producto->getRandom(6);
        //renderizar una vista
        require_once 'views/producto/destacados.php';
    }
    
    public function gestion() {
        Utils::isAdmin();
        
        $producto = new Producto();
        $productos = $producto->getAll();
        
        //renderizar una vista
        require_once 'views/producto/gestion.php';
    }
    
    public function crear() {
        Utils::isAdmin();

        //renderizar una vista
        require_once 'views/producto/crear.php';
    }
    
    public function save() {
        Utils::isAdmin();
        
        if(isset($_POST)){
            $nombre= !empty(trim($_POST['nombre'])) ? trim($_POST['nombre']) : null;
            $descripcion= !empty(trim($_POST['descripcion'])) ? trim($_POST['descripcion']) : null;
            $precio= !empty(trim($_POST['precio'])) ? floatval($_POST['precio']) : null;
            $stock= isset($_POST['stock']) ? (int) $_POST['stock'] : null;
            $categoria_id= isset($_POST['categoria']) ? (int)trim($_POST['categoria']) : null;
            
            $errors=array();
            
            if(empty($nombre) || is_integer($nombre)){
                $errors['nombre']='El nombre no es válido';
            }
            if(empty($descripcion) || is_integer($descripcion)){
                $errors['nombre']='La descripción no es válida';
            }
              
            if(empty($precio) || !filter_var($precio ,FILTER_VALIDATE_FLOAT)){
                $errors['precio']='El precio no es válido';
            }
            
            if(empty($stock) || !is_integer($stock)){
                $errors['stock']='El stock no es válido';
            }
                       
            if(empty($categoria_id) || !is_integer($categoria_id)){
                $errors['categoria']='La categoria no es válida';
            }
            
            if($_FILES['imagen']['size']!=0){
                
                $file= $_FILES['imagen'];
                $filename= "img".rand()."_".$file['name'];
                $mimetype= $file['type'];

                if(!$mimetype =="image/jpg" && !$mimetype =="image/jpeg" && !$mimetype =="image/png" && !$mimetype =="image/gif"){
                    $errors['imagen']='Formato de imagen no válida';
                }
            }
            

            
            if(count($errors)==0){
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria_id);  
                
                if(isset($file)){
                    
                    if(!is_dir("uploads/images")){
                        mkdir("uploads/images",0777,true);
                    }

                    $producto->setImagen($filename);
                    move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                }
                
                if(isset($_GET['id'])){
                    $producto->setId($_GET['id']);
                    $save=$producto->edit();
                } else {                    
                    $save=$producto->save();
                }
                
                if($save){
                    $_SESSION['producto']='Completed';
                } else {
                    $_SESSION['producto']='Failed';
                }               
            } else {
                $_SESSION['producto']='Failed';
            } 
        } else {
            $_SESSION['producto']='Failed';
        } 
        
        header("Location: ".base_url."producto/gestion");
    }
    
    public function editar() {
        Utils::isAdmin();
        $edit=true;
        
        if($_GET['id']){
            $product_id = (int)$_GET['id'];
            
            $producto= Producto::findById($product_id);
            
            if(is_object($producto)){               
                //renderizar una vista

                require_once 'views/producto/crear.php';
            }else {
                header("Location: ".base_url."producto/gestion");
            }           
        } else {
            header("Location: ".base_url."producto/gestion");
        }
        
    }   
    
    public function eliminar() {
        Utils::isAdmin();
        
        if($_GET['id']){
            $id = (int)$_GET['id'];
            
            $filename=Producto::findById($id)->imagen;
            if(!empty($filename) && file_exists("uploads/images/$filename")){
                unlink("uploads/images/$filename");               
            }
            $eliminado= Producto::delete($id);
            
            if($eliminado){
                $_SESSION['accion']='Completed';
            } else {
                $_SESSION['accion']='Completed';
            }
        }
        header("Location: ".base_url."producto/gestion");
    }
    
    public function ver() {  
        
        if(isset($_GET['id'])){          
            $product_id= $_GET['id'];
            

            $prod= Producto::findById($product_id);
            
            
            require_once 'views/producto/ver.php';                          
        } else {
            
            header('Location: '.base_url);
        }        
    }
}