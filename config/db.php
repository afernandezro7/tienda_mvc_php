<?php

class Database {
    
    public static function connect(){
        $serverName='localhost';
        $userName='root';
        $password='root';
        $dbName='tienda_master';
        
        $db= new mysqli($serverName,$userName,$password,$dbName);
        $db->query("SET NAMES 'utf8'");
        
        return $db;
    }
}