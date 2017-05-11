<?php

require_once 'entity.php';

class fields extends entity {

    public function getList() {
        $sql = "SELECT "
                . "fields.id, "
                . "fields.name, "
                . "fields.department_id, "
                . "fields.total_area, "
                . "departments.name as dep_name "
                . "FROM fields, departments "
                . "WHERE fields.department_id = departments.id "
                . "ORDER BY fields.name";
        
        /*echo $sql;
        exit;*/
        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }

    public function getFieldsOnDepartment($departmentID) {
        $sql = "SELECT * FROM fields WHERE department_id = $departmentID";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }
    
    public function newField($name, $departmentID, $totalArea=100) {
        $sql = "INSERT INTO fields (name, department_id, total_area) "
                . "VALUES ('$name', $departmentID, $totalArea)";
        
        echo $sql;

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: fields.php");
    }  
    
    public function delFields($selected_rows) {
        foreach ($selected_rows as $val) {
            $sql = "DELETE FROM fields WHERE id = $val";
            $this->connection->query($sql) or exit(mysqli_error($this->connection));
        }

        header("Location: fields.php");
    } 
    
    public function getField($fieldID) {
        $sql = "SELECT "
                . "fields.id, "
                . "fields.name as field_name, "
                . "fields.department_id, "
                . "fields.total_area, "
                . "departments.name as department_name "
                . "FROM fields, departments "
                . "WHERE fields.id = $fieldID "
                . "AND fields.department_id = departments.id";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        
        $common = new common_functions();
        return $common->dbArrayAssoc($result);
    } 
    
    public function editField($id, $name, $departmentID, $totalArea) {
        $sql = "UPDATE fields SET name = '$name', "
                . "department_id = $departmentID, "
                . "total_area = $totalArea "
                . "WHERE id = $id"; 
        
        /*echo $sql;
        exit;*/

        $this->connection->query($sql) or exit("Ошибка редактирования поля".mysqli_error($this->connection));
        header("Location: fields.php");       
    }    

}
