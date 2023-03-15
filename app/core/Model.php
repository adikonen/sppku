<?php

class Model
{
    /**
     * @var string $primaryKey
     * the primary key of table, this properties mostly used in find method
     */
    protected static $primaryKey;

    /**
     * @var string $table
     * table name
     */
    protected static $table;

    /**
     * @var string $query
     */
    protected static $query;

    /**
     * @var array $unbindedColumn
     */
    protected static $unbindedColumn = [];

    /**
     * @param Database $db
     */
    protected static $db;

    /**
     * initialize the model, set the database
     */
    public static function init(Database $db)
    {
        static::$db = $db;       
    }

    /**
     * get all from table
     * @return array
     */
    public static function all()
    {
        $table = static::$table;
        return static::$db->query("SELECT * FROM {$table}")
            ->resultAll();    
    }

    /**
     * get single row from table by id
     * @return array
     */
    public static function find($id)
    {
        $table = static::$table;
        $pk = static::$primaryKey;
        return static::$db->query("SELECT * FROM {$table} WHERE {$pk} = :id")
            ->bind(':id', $id)
            ->resultSingle();
    }

    /**
     * insert new data to table
     * @param array<string,string> $arr
     * @return int
     */
    public static function create($arr)
    {
        $table = static::$table;
        $column = '';
        $values = '';

        $i = 1;
        $count = count($arr);
        foreach ($arr as $k => $v) {
            if ($i < $count) {
                $column .= "$k, ";
                $values .= ":$k, ";
            } else {
                $column .= "$k";
                $values .= ":$k";
            }
            $i++;
        }
        $insert_syntax = "INSERT INTO $table ($column) VALUES ($values)";
        return static::$db->query($insert_syntax)->binds($arr)->rowCount();
    }

    /**
     * update data by id
     * @param int $id
     * @param array<string,string>
     * @return int
     */
    public static function update($id, $arr)
    {
        $table = static::$table;
        $pk = static::$primaryKey;

        $set = '';

        $i = 1;
        $count = count($arr);
        foreach($arr as $k => $v) {
            if ($i < $count) {
                $set .= "$k = :$k, ";
            } else {
                $set .= "$k = :$k";
            }
            $i++;
        }
        $update_syntax = "UPDATE $table SET $set WHERE $pk = :id";
        return static::$db->query($update_syntax)
            ->binds($arr)
            ->bind(':id',$id)
            ->rowCount();
    }

    /**
     * delete data
     * @param int $id
     * @return int
     */
    public static function delete($id)
    {
        $table = static::$table;
        $pk = static::$primaryKey;

        return static::$db->query("DELETE FROM $table WHERE $pk = :id")
            ->bind(':id', $id)
            ->rowCount();
    }

    /** 
     * select id then get row count
    */
    public static function count()
    {
        $table = static::$table;
        $pk = static::$primaryKey;

        return static::$db->query("SELECT $pk FROM $table")->rowCount();
    }

    public static function setView($view)
    {
        static::$table = $view;
    }

    /**
     * set the primary key
     * @param int|string $id
     */
    public static function setPrimaryKey($id)
    {
        static::$primaryKey = $id;
    }

    /**
     * do select query
     * @param string[] $columns
     * @return self
     */
    public static function select(...$columns)
    {
        $table = static::$table;
        $column = implode(',',$columns);
        $query = "SELECT $column FROM $table";
        static::$query = $query;
        return new static;
    }

    /**
     * do where query after select
     * @param array<string,mixed> $arr
     * @return self
     * 
     */
    public function where($arr)
    {
        $query = static::$query;
        $i = 1;
        $count = count($arr);
        $where_syntax = ''; 
        foreach($arr as $k => $v) {
            if ($i < $count) {
                $where_syntax .= "$k = :$k AND ";
            } else {
                $where_syntax .= "$k = :$k";
            }
            static::$unbindedColumn[$k] = $v;
            $i++;
        }
        static::$query = "$query WHERE $where_syntax";
        return $this;
    }

    /**
     * execute query, then return 2d array
     * @return array
     */
    public function get()
    {
        $q = static::$query;
        $unbindedColumn = static::$unbindedColumn;
        return static::$db->query($q)->binds($unbindedColumn)->resultAll();
    }

    /**
     * execute query, then return 1d array
     * @return array
     */
    public function first()
    {
        $q = static::$query;
        $unbindedColumn = static::$unbindedColumn;
        $this->clear();
        return static::$db->query($q)->binds($unbindedColumn)->resultSingle();
    }

    /**
     * execute query, then return array indexes
     * @return array
     */
    public function flat()
    {
        $q = static::$query;
        $unbindedColumn = static::$unbindedColumn;
        $this->clear();
        return static::$db->query($q)->binds($unbindedColumn)->flat();
    }
 
    /**
     * execute query, then return row count
     * @return array
     */
    public function rowCount()
    {
        $q = static::$query;
        $unbindedColumn = static::$unbindedColumn;
        $this->clear();
        return static::$db->query($q)->binds($unbindedColumn)->rowCount();
    }

    protected function clear()
    {
        static::$query = '';
        static::$unbindedColumn = [];
    }
    
}