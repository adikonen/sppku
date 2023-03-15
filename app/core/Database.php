<?php

class Database
{
    /**
     * @var string $db_host
     */
    private $db_host = DB_HOST;

    /**
     * @var string $db_user
     */
    private $db_user = DB_USER;

    /**
     * @var string $db_pass
     */
    private $db_pass = DB_PASS;

    /**
     * @var string $db_name
     */
    private $db_name = DB_NAME;

    /**
     * @var PDO|null $dbh
     */
    private $dbh;

    /**
     * @var PDOStatement|bool
     */
    private $stmt;

    /**
     * set dbh to pdo instance
     */
    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_pass, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * set stmt properties with prepared $query
     * @param string $query
     * @return self
     */
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
        return $this;
    }

    /**
     * bind the prepared query in $stmt
     * @param string $param
     * @param mixed $value
     * @return self
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case (is_int($value)):
                    $type = PDO::PARAM_INT;
                    break;
                case (is_bool($value)):
                    $type = PDO::PARAM_BOOL;
                    break;
                case (is_null($value)):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
        return $this;
    }

    /**
     * bind properties with array
     * @param array $array
     * @return self
     */
    public function binds($array)
    {
        foreach ($array as $k => $v) {
            $this->bind($k, $v);
        }
        return $this;
    }

    /**
     * begin sql transaction
     */
    public function beginTransaction()
    {
        $this->dbh->beginTransaction();
    }

    /**
     * commit the transaction
     */
    public function commit()
    {
        $this->dbh->commit();
    }

    /**
     * rollback the transaction
     */
    public function rollBack()
    {
        $this->dbh->rollBack();
    }

    /**
     * execute the statement
     */
    public function execute()
    {
        $this->stmt->execute();
    }

    /**
     * fetch the result then return 2d array
     * @return array
     */
    public function resultAll()
    {
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * fetch the result then return 1d array
     * @return array
     */
    public function resultSingle()
    {
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * return row count result
     * @return int
     */
    public function rowCount()
    {
        $this->execute();
        return $this->stmt->rowCount();
    }

    /**
     * return array indexes
     * @return array
     */
    public function flat()
    {
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
