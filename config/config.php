<?php

class DB
{
    const DB_HOST = "localhost";
    const DB_NAME = "internPJ4_ecom";
    const DB_USERNAME = "nmk";
    const DB_PSW = '123456';
    protected $pdo = null;

    function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:dbhost=" . self::DB_HOST . ";dbname=" . self::DB_NAME, self::DB_USERNAME, self::DB_PSW, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
    public function checkEmailExist($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE email=:email");
        $stmt->execute([
            ':email' => $email
        ]);
        return $stmt->fetch();
    }
    public function crud($query, $data = null, $fetch = null, $fetchAll = null)
    {
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute($data);
        if ($fetch) return $stmt->fetch();

        if ($fetchAll) return $stmt->fetchAll();

        return $result;
    }
    public function getlastInsertID()
    {
       return $this->pdo->lastInsertId();
    }
}
