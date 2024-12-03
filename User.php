<?php
require_once 'Database.php';

class User implements ModelInterface
{
    private $table = 'users';
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert($data)
    {
        $query = "INSERT INTO $this->table (matric, name, password, role) VALUES (?, ?, ?, ?)";
        return $this->db->execute($query, $data['matric'], $data['name'], $data['password'], $data['role']);
    }

    public function update($data, $matric)
    {
        $query = "UPDATE $this->table SET matric = ?, name = ?, role = ? WHERE matric = ?";
        return $this->db->execute($query, $data['matric'], $data['name'], $data['role'], $matric);
    }

    public function delete($matric)
    {
        $query = "DELETE FROM $this->table WHERE matric = ?";
        return $this->db->execute($query, $matric);
    }

    public function select($matric)
    {
        $query = "SELECT * FROM $this->table WHERE matric = ?";
        return $this->db->select($query, $matric)->fetch_assoc();
    }

    public static function selectAll()
    {
        $query = "SELECT * FROM ". User::getTable();
        return Database::getInstance()->select($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function login($matric, $password)
    {
        $query = "SELECT * FROM $this->table WHERE matric = ?";
        $user = $this->db->select($query, $matric)->fetch_assoc();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    private static function getTable()
    {
        $user = new User();
        return $user->table;
    }
}
