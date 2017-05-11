<?php

require_once 'entity.php';

class cultures extends entity{

    public function getList() {
        $sql = "SELECT * FROM cultures";
        $result = $this->connection->query($sql) or exit(mysqli_error());

        $common = new common_functions();

        return $common->dbArray($result);
    } 
    
    public function newCulture($name) {
        $sql = "INSERT INTO cultures (name) VALUES ('$name')";

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: cultures.php");
    } 
    
    public function getCulture($cultureID) {
        $sql = "SELECT * FROM cultures WHERE id = $cultureID";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        
        $common = new common_functions();
        return $common->dbArrayAssoc($result);
    }
    
    public function editCulture($id, $name) {
        $sql = "UPDATE cultures SET name = '$name' "
                . "WHERE id = $id";

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: cultures.php");       
    }
    
    public function delCultures($selectedRows) {
        foreach ($selectedRows as $val) {
            $sql = "DELETE FROM cultures WHERE id = $val";
            $this->connection->query($sql) or exit(mysqli_error($this->connection));
        }

        header("Location: cultures.php");
    }    

}
