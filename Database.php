<?php

interface ModelInterface
{
    public function insert($data);
    public function update($data, $id);
    public function delete($id);
    public function select($id);
    public static function selectAll();
}

class Database
{
    private $host = "localhost";
    private $db = "Lab_5b";
    private $user = "root";
    private $pass = "";

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    public function select($query, ...$params)
    {
        $stmt = $this->conn->prepare($query);
        if ($params) {
            $stmt->bind_param(str_repeat("s", count($params)), ...$params);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public function execute($query, ...$params): bool
    {
        $stmt = $this->conn->prepare($query);
        if ($params) {
            $stmt->bind_param(str_repeat("s", count($params)), ...$params);
        }
        return $stmt->execute();
    }

    public static function getInstance()
    {
        return new Database();
    }
}