<?php


class Product extends Db
{
    public function checkTable()
    {
        try {
            $sql = "SELECT * FROM products";
            $result = $this->connect()->query($sql);
            if ($result->rowCount() == 0) {
                $this->fillTable();
            }
        } catch (Exception $e) {
            $this->createTable();
            $this->fillTable();
        }
    }

    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `products` 
        ( 
            `ID` INT NOT NULL AUTO_INCREMENT, 
            `title` VARCHAR(40) NOT NULL,
            `descr` VARCHAR(250) NOT NULL,
            `price` INT NOT NULL,
            PRIMARY KEY (`ID`)
        ) ";
        $this->connect()->exec($sql);
    }

    public function fillTable()
    {
        $sql = 'INSERT INTO products (title, descr, price) 
                VALUES ("Beer", "Some tasty beer", "100"),
                       ("Vodka", "Don\'t drink much", "50"),
                       ("Tea", "It\'s tea time!", "200")';
        $this->connect()->exec($sql);
    }

    public function select()
    {
        $sql = "SELECT * FROM products";
        $result = $this->connect()->query($sql);
        if ($result->rowCount() > 0){
            while ($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        } else {
            echo "Table is empty";
        }
    }
}