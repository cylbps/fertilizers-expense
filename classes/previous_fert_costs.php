<?php

require_once 'entity.php';

class previous_fert_costs extends entity {
    
    public function getList() {
        $sql = "SELECT "
                . "previous_fert_costs.id, "
                . "previous_fert_costs.fertilizer_id, "
                . "previous_fert_costs.weight, "
                . "fertilizers.name "
                . "FROM previous_fert_costs, fertilizers "
                . "WHERE previous_fert_costs.fertilizer_id = fertilizers.id";
        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }
    
    public function newFertCosts($fertilizerID, $weight) {
        $sql = "INSERT INTO previous_fert_costs (fertilizer_id, weight) VALUES ($fertilizerID, $weight)";

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: previous_fert_costs.php");
    } 
    
    public function prevousWeightFertCost() {
        $sql = "SELECT SUM(weight) "
                . "FROM previous_fert_costs "
                . "GROUP BY fertilizer_id";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $arr = $result->fetch_row();

        $val = $arr[0];

        return $val;        
    }
    
    public function totalWeightFertCost() {
        $sql = "SELECT SUM(weight) "
                . "FROM previous_fert_costs ";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $arr = $result->fetch_row();

        $val = $arr[0];

        return $val;        
    } 
    
    public function delPreviousFertCosts($selected_rows) {
        foreach ($selected_rows as $val) {
            $sql = "DELETE FROM previous_fert_costs WHERE id = $val";
            $this->connection->query($sql) or exit(mysqli_error($this->connection));
        }

        header("Location: previous_fert_costs.php");
    }     
}
