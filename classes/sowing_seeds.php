<?php

require_once 'entity.php';
require_once 'classes/common_functions.php';

class sowing_seeds extends entity {
    
    public function getList() {
        $sql = "SELECT "
                . "sowing_seeds.id as sow_seeds_id, "
                . "sowing_seeds.sowing_date sow_seeds_date, "
                . "sowing_seeds.reproduction as sow_seeds_reproduction, "
                . "sowing_seeds.sown_area as sow_seeds_sown_area, "
                . "sowing_seeds.weight as sow_seeds_weight, "
                . "sowing_seeds.deviation as sow_seeds_deviation, "
                . "fields.name as field_name, "
                . "cultures.name as culture_name, "
                . "grades.name grade_name "
                . "FROM sowing_seeds, fields, sowings, cultures, grades "
                . "WHERE sowing_seeds.field_id = fields.id "
                . "AND sowing_seeds.sowing_id = sowings.id "
                . "AND sowings.culture_id = cultures.id "
                . "AND sowing_seeds.grade_id = grades.id"; 
        

        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);        
    }
}
