<?php

require_once 'entity.php';

class fertilizers extends entity {
    
    public function getList() {
        $sql = "SELECT * FROM fertilizers";
        $result = $this->connection->query($sql) or exit(mysqli_error());

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }
    
    public function newFertilizer($name) {
        $sql = "INSERT INTO fertilizers (name) VALUES ('$name')";

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: fertilizers.php");
    } 
    
    public function delFertilizer($selected_rows) {
        foreach ($selected_rows as $val) {
            $sql = "DELETE FROM fertilizers WHERE id = $val";
            $this->connection->query($sql) or exit(mysqli_error($this->connection));
        }

        header("Location: fertilizers.php");
    } 
    
    public function getFertilizer($fertilizerID) {
        $sql = "SELECT * FROM fertilizers WHERE id = $fertilizerID";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        
        $common = new common_functions();
        return $common->dbArrayAssoc($result);
    }
    
    public function editFertilizer($id, $name) {
        $sql = "UPDATE fertilizers SET name = '$name' "
                . "WHERE id = $id";  

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: fertilizers.php");       
    } 
    
    public function fertilizerToCulture($cultureID) {
        $sql = "SELECT "
                . "fertilizers.id as fert_id, "
                . "fertilizers.name, "
                . "fertilizer_plans.norm "
                . "FROM "
                . "fertilizer_plans, cultures, fertilizers "
                . "WHERE "
                . "fertilizer_plans.culture_id = $cultureID "
                . "AND fertilizer_plans.fertilizer_id = fertilizers.id "
                . "AND fertilizer_plans.culture_id = cultures.id";
        
        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        
        $common = new common_functions();
        return $common->dbArrayAssoc($result);       
    }
}
