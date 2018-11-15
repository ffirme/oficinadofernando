<?php

namespace Core;

use PDO;
use PDOException;

class DataBase
{
    public static function getDataBase(){

        $db = __DIR__ . '/../storage/database.sqlite';
        $db = "sqlite:" . $db;
    
        try{
            $pdo = new PDO($db);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }    
    }
}