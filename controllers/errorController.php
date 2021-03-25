<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class errorController {

    public function index() {
        
        //renderizar una vista
        echo "<h1>Pagina que buscas no existe</h1>";
        echo "<img src='". base_url ."assets/img/error.jpg' alt='error'/>";
    }

}