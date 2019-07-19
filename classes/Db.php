<?php


class Db
{
    public function connect()
    {
        $servername = "localhost";
        $dbname = "list";
        $username = "root";
        $password = "";
        try {
            $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // if connected successfully
            return $db;

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}