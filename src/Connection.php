<?php

namespace Fac;

use PDO;

abstract class Connection{
    private static $instance = null;
    private const PDO_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    public static function getConnection(){
        if(self::$instance === null){
            self::$instance = new PDO('mysql:host=localhost;dbname=facturation', 'root', 'WINmaths42', self::PDO_OPTIONS);
        }
        return self::$instance;
    }
}