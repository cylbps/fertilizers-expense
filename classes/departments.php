<?php

require_once 'entity.php';

class departments extends entity {

    public function getList() {
        $sql = "SELECT * FROM departments";
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }

    public function delDepartments($selected_rows) {
        foreach ($selected_rows as $val) {
            $sql = "DELETE FROM departments WHERE id = $val";
            $this->connection->query($sql) or exit(mysqli_error($this->connection));
        }

        header("Location: departments.php");
    }

    public function newDepartment($name) {
        $sql = "INSERT INTO departments (name) VALUES ('$name')";

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: departments.php");
    }

    public function getDepartment($departmentID) {
        $sql = "SELECT * FROM departments WHERE id = $departmentID";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        
        $common = new common_functions();
        return $common->dbArrayAssoc($result);
    }

    public function editDepartment($id, $name) {
        $sql = "UPDATE departments SET name = '$name' "
                . "WHERE id = $id";  

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: departments.php");       
    }
}
