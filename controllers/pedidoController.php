<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/pedido.php';
require_once 'models/usuario.php';
require_once 'helpers/utils.php';
class pedidoController {

    public function hacer() {
        
        if(isset($_SESSION['identity'])){
            
            require_once 'views/pedido/hacer.php';

        } else {
            $_SESSION['pedido_identity']=false;
            header('Location: '. base_url. "carrito/index");
        }
        
    }
    
    public function add() {
        
        
        if(isset($_SESSION['identity']) && isset($_POST)){
            
            $provincia= isset($_POST['provincia']) ? $_POST['provincia'] : null;
            $localidad=isset($_POST['localidad']) ? $_POST['localidad'] : null;
            $direccion=isset($_POST['direccion']) ? $_POST['direccion'] : null;                   
            $usuario_id= (int)$_SESSION['identity']->id;
            $stats=Utils::carStats(); 
            $coste=$stats['total'];
            
            if(!empty($provincia) && !empty($localidad) && !empty($direccion)){
                
                $pedido= new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save=$pedido->save();
                $save2=$pedido->save_line();
                
                $doble_query=$save && $save2;
                
                if($doble_query){
                    Utils::deleteSession('carrito');  
                    $_SESSION['pedido'] = 'Completed';                     
                } else {
                    $_SESSION['pedido'] = 'Failed';                  
                }
                
                header('Location: '. base_url . "pedido/confirmado");
                
                
            } else {
                header('Location: '. base_url. "carrito/hacer");
            }
        } else {
            $_SESSION['pedido_identity']=false;
            header('Location: '. base_url. "carrito/index");
        }
    }
    
    public function confirmado() {
        if(isset($_SESSION['pedido']) && isset($_SESSION['identity']) ){  
            $pedido=new Pedido();
            $pedido->setUsuario_id($_SESSION['identity']->id);           
            $ped=$pedido->getOneByUser();
            $ped_products=$pedido->getProductByPedido($ped->id);

          
            require_once 'views/pedido/confirmado.php';    
            Utils::deleteSession('pedido');
            
        } else {
            header('Location: '. base_url);
        }
    }
    
    public function mis_pedidos() {
        Utils::isLogged();
        
        $usuario_id= $_SESSION['identity']->id;
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        
       
        require_once 'views/pedido/mis_pedidos.php';      
    }
    
    public function detalle() {
        Utils::isLogged();
        
        if(isset($_GET['id']) && (int)$_GET['id']!=0){
            $pedido_id=(int)$_GET['id'];
            
            if(isset($_GET['gestion'])){
                $gestion=true;
            }
            
            $pedido= new Pedido();
            $pedido->setId($pedido_id);
            $ped=$pedido->getOne();
            $cliente= new Usuario();
            $cliente->setId($ped->usuario_id);
            $cliente=$cliente->getOne();
            $ped_products=$pedido->getProductByPedido($pedido_id);
            
            require_once 'views/pedido/detalle.php';
            
        } else {
            header('Location: '.base_url."pedido/mis_pedidos"); 
        } 
    }
    
    public function gestion() {
        Utils::isAdmin();
        $gestion=true;
        $pedido = new Pedido();
        $pedidos=$pedido->getAll();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function estado() {
        Utils::isAdmin();
        
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])  ){
            $pedido_id=$_POST['pedido_id'];
            $estado=$_POST['estado'];
            $pedido= new Pedido();
            $pedido->setId($pedido_id);
            $pedido->setEstado($estado);
            
            $estadoDB= $pedido->getOne()->estado;
            
            if($estadoDB!="sent"){
               
                $update = $pedido->updateOne();

                if($update){
                    $_SESSION['cambio_estado']="Completed";
                } else {
                    $_SESSION['cambio_estado']="Failed";               
                }
            } else {
                $_SESSION['cambio_estado']="Invalid";  
            }
            
            header('Location: '.base_url."pedido/detalle&gestion&id=".$pedido_id);           
        } else {
            header('Location: '.base_url."pedido/gestion");
        }     
    }
}