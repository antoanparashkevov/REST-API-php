<?php

namespace config;

use PDO;
use PDOException;

class Database
{
    //DB params to connect
    private $host = 'your_host';
    private $db_name = 'db_name';
    private $username = 'db_username';
    private $password = 'db_password';
    private $conn;//represents our connection

    //DB connect

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            echo 'Connection refused: ' . $e->getMessage();
        }
        
        return $this->conn;
    }
}