<?php

/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 19/08/2015
 * Time: 20:31
 */

/**
 * Class Connection - connect with database
 */
class Database
{
    private static $connect;
    private static function connect(){
        if(is_null(self::$connect)) {
            $host = '127.9.246.2:3306';
            $db   = "missaocalebe";
            $user = "admin76BzSYb";
            $pass = "acCYTLKGzIdB";
            $host = 'localhost';
            $db   = "missaocalebe";
            $user = "root";
            $pass = "";
            $dns = 'mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8';
            self::$connect = new PDO($dns, $user, $pass);
            self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connect;
    }

    public static function ReadAll($table, $campos, $where=null){
        $query = Database::connect()->query("SELECT ".$campos." FROM ".$table." ".$where);

        if($query->rowCount() > 0){
            return $query->fetchAll();
        }else{
            return false;
        }
    }

    public static function ReadOne($table, $campos, $where=null){
        $query = self::connect()->prepare("SELECT ".$campos." FROM ".$table." ".$where);
        $query->execute();

        if($query->rowCount() == 1){
            return $query->fetch();
        }else{
            return false;
        }
    }

    public static function Insert($table, $campos, $values){
        $query = Database::connect()->prepare("INSERT INTO $table ($campos) VALUES ($values)");
        $query->execute();

        return Database::connect()->lastInsertId($table);

    }

    public static function InsertGeneric($table, array $values){
        foreach($values as $campo=>$valor){
                $campos[] = $campo;
                $valores[] = $valor;
                $subs[] = '?';
        }

        $campos = implode(', ', $campos);
        $subs = implode(', ', $subs);
        $query = Database::connect()->prepare("INSERT INTO $table ($campos) VALUES($subs)");
        $query->execute($valores);

        return Database::connect()->lastInsertId($table);
    }

    public static function UpdateGeneric($table, array $values, $where){
        foreach($values as $campo=>$valor){
            if($campo != 'acao'){
                $campos[] = "$campo=?";
                $valores[] = $valor;
            }
        }
        $campos = implode(', ', $campos);
        $query = self::connect()->prepare('UPDATE '.$table.' SET '.$campos.' '.$where);
        $query->execute($valores);

        if($query){
            return true;
        }else{
            return false;
        }
    }


    public static function Update($table, $values, $where){
        $query = self::connect()->prepare('UPDATE '.$table.' SET '.$values.' '.$where);
        $query->execute();

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public static function Delete($table, $where){
        $query = self::connect()->query('DELETE FROM '.$table.' '.$where);
        $query->execute();

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public static function SQL($sql){
        $query = self::connect()->prepare($sql);
        $query->execute();

        if($query){
            return true;
        }else{
            return false;
        }
    }

}