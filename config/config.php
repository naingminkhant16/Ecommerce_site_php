<?php

class DB
{
    const DB_HOST = "localhost";
    const DB_NAME = "internPJ4_ecom";
    const DB_USERNAME = "nmk";
    const DB_PSW = '123456';
    protected $sql = '';
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
    //Query Builder 
    public function all($table)
    {
        $query = "SELECT * FROM $table" . $this->sql;
        // return $query;
        $this->sql = '';
        return $this->crud($query, null, null, true);
    }

    public function find($table, $findValue, $column = "id")
    {
        $query = "SELECT * FROM $table WHERE $column='$findValue'";
        return $this->crud($query, null, true, null);
    }

    public function store(array $data, $table)
    {
        $columns = join(',', array_keys($data));
        $values = join(',', array_map(function ($i) {
            return "'$i'";
        }, array_values($data)));
        $query = "INSERT INTO $table($columns) VALUES($values)";
        return $this->crud($query);
    }

    public function update(array $data, $table)
    {
        $query = "UPDATE $table SET ";
        foreach ($data as $column => $value) {
            $query .= " $column='$value',";
        };
        $query = rtrim($query, ',') . $this->sql;
        $this->sql = '';
        return $this->crud($query);
    }

    public function limit($start, $end)
    {
        $this->sql .= " LIMIT $start,$end";
        return $this;
    }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->sql .= " ORDER BY $column $direction ";
        return $this;
    }

    public function where($column, $operator, $value)
    {
        if (is_array($value)) {
            $value = "(" . join(',', $value) . ")";
        } else {
            $value = "'" . $value . "'";
        }
        $this->sql .= " WHERE $column $operator $value ";
        return $this;
    }

    public function between($column, $start, $end)
    {
        $this->sql .= " WHERE $column BETWEEN $start AND $end ";
        return $this;
    }
}
