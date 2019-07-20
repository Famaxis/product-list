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
                VALUES ("Beer", "Just some beer", "100"),
                       ("Vodka", "Don\'t drink much", "50"),
                       ("Tea", "It\'s tea time!", "200")';
        $this->connect()->exec($sql);
    }

    public function selectMany()
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

    public function selectOne($id)
    {
        $sql = "SELECT * FROM products WHERE ID = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert($fields)
    {
        $columns = implode(', ', array_keys($fields));
        $placeholder = implode(', :', array_keys($fields));
        $sql = "INSERT INTO products ($columns) VALUES (:".$placeholder.")";
        $stmt = $this->connect()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(':'.$key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            header('Location: /');
        }
    }

    public function update($fields, $id)
    {
        $st ="";
        $counter = 1;
        $total_fields = count($fields);

        foreach ($fields as $key => $value) {
            if ($counter === $total_fields) {
                $set = "$key = :" . $key;
                $st = $st . $set;
            } else {
                $set = "$key = :" . $key. ", ";
                $st = $st . $set;
                $counter++;
            }
        }

        $sql = "";
        $sql.= "UPDATE products SET " . $st;
        $sql.= " WHERE ID = " . $id;
        $stmt = $this->connect()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            header('Location: /');
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE ID = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }
}