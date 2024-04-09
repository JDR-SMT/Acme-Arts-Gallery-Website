<?php
//  Team Name: MRS Tech
// 	Team Member: Jack Dylan Rendle
// 	Date: 02/04/2024

class config
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "gallery";
    protected $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
}
