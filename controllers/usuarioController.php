<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/usuario.php';
class usuarioController {

    public function index() {
        echo 'Controlador Usuario, Acción index';
    }
    
    public function register() {
        require_once 'views/usuario/registro.php';
    }
    
    public function save() {
        
        if(isset($_POST)){
            $nombre= !empty(trim($_POST['nombre'])) ? trim($_POST['nombre']): null;
            $apellidos= !empty(trim($_POST['apellidos'])) ? trim($_POST['apellidos']): null;
            $email=!empty(trim($_POST['email'])) ? trim($_POST['email']): null;
            $password= !empty(trim($_POST['password'])) ? trim($_POST['password']): null;
            
            $errors=array();
           
            if(empty($nombre) || is_integer($nombre)){
                $errors['nombre']='El nombre no es válido';
            }
            if(empty($apellidos) || is_integer($apellidos)){
                $errors['apellidos']='Los apellidos no son válidos';
            }
            if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors['email']='El email no es válido';
            }
            if(empty($password) || strlen($password)<6){
                $errors['password']='El password debe ser mayor de 5 carácteres';
            }
            
            
            if(count($errors)==0){
                
                $usuario= new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $resp=$usuario->save();   
                if($resp){
                    $_SESSION['register']= 'Completed';              
                } else {
                    $_SESSION['register']= 'Failed';               
                }
            } else {
                $_SESSION['errors']=$errors;
                $_SESSION['register']= 'Failed'; 
                
            }
            
        }else {
            $_SESSION['register']= 'Failed';
        }
        header("Location: ".base_url.'usuario/register');
    }
    
    public function login() {
        if(isset($_POST['email']) && isset($_POST['password'])){
            // Identificar al usuario
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $resp= $usuario->login(trim($_POST['password']));
            
            if(is_object($resp)){ 
                $_SESSION['identity'] = $resp;
                unset($_SESSION['identity']->password);
                 
                if($resp->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }

            } else {
                
                $_SESSION['error_login']='Identificación fallida';
            }
        }
        header("Location: ". base_url);
    }
    
    public function logout() {
        
        Utils::deleteSession('identity');
        Utils::deleteSession('admin');
        Utils::deleteSession('carrito');
       
        header("Location: ". base_url);
    }
}