<?php

class database {

    protected $connection;
    private static $instance;

    private function __construct() {
        $this->connection = new mysqli('localhost', 'root', 'iukao7', 'field_works');
        if ($this->connection->connect_errno) {
            die('Не удальсь подключиться к базе данных.');
        }
    }
    
    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }    

    public function getConnection() {
        return $this->connection;
    }
    
    public function closeConnection() {
        $this->connection->close();
    }

    public function login($user, $password) {

        $connectionLoc = $this->getConnection();
        $characterQuery = "set names utf8";
        $connectionLoc->query($characterQuery);

        $loginQuery = "SELECT * FROM users WHERE user = '" . $user . "'";
        $result = $connectionLoc->query($loginQuery);
        if ($result->num_rows > 0) {
            $ar = $result->fetch_assoc();
        }
        if ($ar['password'] === $password) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function validUser() {
        if(session_status() !== 2) {
            session_start();
        }    
        if (!$_SESSION['valid_user']) {
            header('Location: login.php');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
