<?php

require_once 'database.php';
require_once 'common_functions.php';

class entity {
    
    protected $connection;
    protected $db;


    public function __construct() {
        $this->db = database::getInstance();
        $this->connection = $this->db->getConnection();

        if ($this->connection) {
            $sql = "set names utf8";
            $this->connection->query($sql);
        }
    }
    
    /*public function __destruct() {
        $this->db->closeConnection();
    }*/
    
}
