<?php
class User
{
    private $connection;
    public $name;
    public $email;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function save()
    {
        $statement = $this->connection->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $statement->bind_param("ss", $this->name, $this->email);
        return $statement->execute();
    }

    public static function findAll($db)
    {
        $sql = "SELECT * FROM users ORDER BY id ASC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
