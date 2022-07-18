<?php
class DB
{
    const DB_HOST = "localhost";
    const DB_NAME = "internPJ4_ecom";
    const DB_USERNAME = "nmk";
    const DB_PSW = '123456';
    protected $table = null;
    protected $sql = '';

    function __construct(string $table = null)
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
        $this->table = $table;
    }

    protected function crud($query, $data = null, $fetch = null, $fetchAll = null)
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

    public function all(string $table = null)
    {
        $table = $table ?? $this->table;
        return $this->crud("SELECT * FROM $table", null, null, true);
    }

    public function get(string $table = null)
    {
        $table = $table ?? $this->table;
        $query = "SELECT * FROM $table" . $this->sql;
        // return $query;
        $this->sql = '';
        return $this->crud($query, null, null, true);
    }

    public function first(string $table = null)
    {
        $table = $table ?? $this->table;
        $query = "SELECT * FROM $table" . $this->sql;
        // return $query;
        $this->sql = '';
        return $this->crud($query, null, true);
    }

    public function find($findValue, $column = "id", string $table = null)
    {
        $table = $table ?? $this->table;
        $query = "SELECT * FROM $table WHERE $column='$findValue'";
        return $this->crud($query, null, true, null);
    }

    public function store(array $data, string $table = null)
    {
        $table = $table ?? $this->table;
        $columns = join(',', array_keys($data));
        $values = join(',', array_map(function ($i) {
            return "'$i'";
        }, array_values($data)));
        $query = "INSERT INTO $table($columns) VALUES($values)";
        return $this->crud($query);
    }

    public function update(array $data, string $table = null)
    {
        $table = $table ?? $this->table;
        $query = "UPDATE $table SET ";
        foreach ($data as $column => $value) {
            $query .= " $column='$value',";
        };
        $query = rtrim($query, ',') . $this->sql;
        // return $query;
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

    public function where($column, $operator = null, $value = null)
    {
        if (is_object($column)) {
            if ($this->sql) { //sql is not empty
                $currentSql = $this->sql;
                $this->sql = "";
                $column($this);
                $this->sql =  $currentSql . " AND (" . trim(str_replace("WHERE", '', $this->sql)) . ")";
            } else { //sql is empty ortherwise first where
                $column($this);
                $this->sql = " WHERE (" . trim(str_replace("WHERE", '', $this->sql)) . ")";
            }
            return $this;
        }


        if (!$value) {
            $value = $operator;
            $operator = "=";
        }
        // $operatorFilterArr = ['<', '>', 'in', '!'];
        // if (!in_array($operator, $operatorFilterArr)) {
        //     $value = $operator;
        //     $operator = "=";
        // }

        // if (is_array($column)) {
        //     $this->sql = " WHERE " . "(" . trim(str_replace("WHERE", "", $this->sql)) . ")";
        //     return $this;
        // }

        if (is_array($value)) {
            $value = "(" . join(',', $value) . ")";
        } else {
            $value = "'" . $value . "'";
        }

        if (str_contains($this->sql, 'WHERE')) {
            $this->sql .= " AND $column $operator $value";
        } else {
            $this->sql .= " WHERE $column $operator $value";
        };

        return $this;
    }

    public function orWhere($column, $operator = null, $value = null)
    {
        if (is_object($column)) {
            if ($this->sql) { //sql is not empty
                $currentSql = $this->sql;
                $this->sql = "";
                $column($this);
                $this->sql =  $currentSql . " OR (" . trim(str_replace("WHERE", '', $this->sql)) . ")";
            } else { //sql is empty ortherwise first where
                $column($this);
                $this->sql = " WHERE (" . trim(str_replace("WHERE", '', $this->sql)) . ")";
            }

            return $this;
        }

        //where('id',77)
        if (!$value) {
            $value = $operator;
            $operator = "=";
        }

        if (is_array($value)) {
            $value = "(" . join(',', $value) . ")";
        } else {
            $value = "'" . $value . "'";
        }

        if (str_contains($this->sql, 'WHERE')) {
            $this->sql .= " OR $column $operator $value";
        } else {
            $this->sql .= " WHERE $column $operator $value";
        };

        return $this;
    }


    public function between($column, $start, $end)
    {
        $this->sql .= " WHERE $column BETWEEN $start AND $end ";
        return $this;
    }

    public function dd($table = null)
    {
        $table = $table ?? $this->table;
        return "SELECT * FROM $table " . $this->sql;
    }
}
