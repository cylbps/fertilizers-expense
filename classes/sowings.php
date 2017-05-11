<?php

require_once 'entity.php';
require_once 'classes/common_functions.php';

class sowings extends entity {

    public function getList() {
        $sql = "SELECT "
                . "sowings.id as sowing_id, "
                . "sowings.area, "                
                . "fields.id as field_id, " 
                . "cultures.id as culture_id, "              
                . "fields.name as fields_name, "
                . "cultures.name as cultures_name "                
                . "FROM sowings, fields, cultures "
                . "WHERE sowings.field_id = fields.id "
                . "AND sowings.culture_id = cultures.id "
                . "ORDER BY field_id";
        
        /*echo $sql;
        exit;*/
        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }    
    
    public function getSowing($sowingID) {
        $sql = "SELECT "
                . "sowings.id as sowing_id, "
                . "sowings.area, "                
                . "fields.id as field_id, " 
                . "cultures.id as culture_id, "              
                . "fields.name as fields_name, "
                . "cultures.name as cultures_name "                
                . "FROM sowings, fields, cultures "
                . "WHERE sowings.id = $sowingID "
                . "AND sowings.field_id = fields.id "
                . "AND sowings.culture_id = cultures.id";
        
        /*echo $sql;
        exit;*/
        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }      
    
    public function SowingsToField($fieldID) {
        $sql = "SELECT "
                . "sowings.id, sowings.field_id, sowings.culture_id, "
                . "sowings.area, cultures.name "
                . "FROM sowings, cultures "
                . "WHERE sowings.culture_id = cultures.id "
                . "AND sowings.field_id = $fieldID";


        $result = $this->connection->query($sql) or exit(mysqli_error());
        
        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }

    public function newSowing($fieldID, $cultureID, $area) {
        $sql = "INSERT INTO sowings (field_id, culture_id, area) "
                . "VALUES ($fieldID, $cultureID, $area)";

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: sowings.php");
    } 
    
    public function delSowings($selected_rows) {
        foreach ($selected_rows as $val) {
            $sql = "DELETE FROM sowings WHERE id = $val";
            $this->connection->query($sql) or exit(mysqli_error($this->connection));
        }

        header("Location: sowings.php");
    } 
    
    public function editSowing($id, $fieldID, $cultureID, $area) {
        $sql = "UPDATE sowings SET field_id = $fieldID, "
                . "culture_id = $cultureID, "
                . "area = $area "
                . "WHERE id = $id"; 
        
        /*echo $sql;
        exit;*/

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: sowings.php");       
    }    
}
