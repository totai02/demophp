<?php

final class DB
{
    private $link;

    public function __construct($hostname, $username, $password, $database) {
        $this->link = new \mysqli($hostname, $username, $password, $database);

        if($this->link->connect_error) {
            trigger_error('Error: Could not make a database link (' . $this->link->connect_errno . ') ' . $this->link->connect_error);
        }

        $this->link->set_charset("utf8");
        $this->link->query("SET SQL_MODE = ''");
    }

    function tableName($table){
        return DB_PREFIX . $table;
    }

    public function query($sql) {
        $query = $this->link->query($sql);

        if(!$this->link->errno) {
            if($query instanceof \mysqli_result) {
                $data = array();

                while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->num_rows = $query->num_rows;
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;

                $query->close();

                return $result;
            } else {
                return true;
            }
        } else {
            trigger_error('Error: ' . $this->link->error . '<br />Error No: ' . $this->link->errno . '<br />' . $sql);
        }
    }

    public function insert($table, $data){
        $sql = "INSERT INTO " . DB_PREFIX . "$table SET ";

        $list = array();

        foreach ($data as $key => $item){
            if(is_int($item)){
                $item = (int)$item;
            } elseif (is_float($item)) {
                $item = (float)$item;
            } else {
                $item = $this->escape($item);
            }

            $list[] = "`$key` = '$item'";
        }

        $sql .= implode(', ', $list);

        $this->query($sql);
    }

    public function update($table, $data, $orRaw = ''){
        $sql = "UPDATE " . DB_PREFIX . "$table SET ";

        $list = array();

        foreach ($data as $key => $item){
            if(is_int($item)){
                $item = (int)$item;
            } elseif (is_float($item)) {
                $item = (float)$item;
            } else {
                $item = $this->escape($item);
            }

            $list[] = "`$key` = '$item'";
        }

        $sql .= implode(', ', $list);

        if($orRaw){
            $sql .= $orRaw;
        }

        $this->query($sql);
    }

    public function delete($table, $where){
        $sql = "DELETE FROM " . $table . " WHERE ";
        if (is_string($where)){
            $sql .= $where;
        } elseif  (is_array($where)) {
            $list = array();
            foreach ($where as $key => $value){
                $list[] = "`$key` = `$value`";
            }
            $sql .= implode(', ', $list);
        }
        $this->query($sql);
    }

    public function escape($value) {
        return $this->link->real_escape_string($value);
    }

    public function countAffected() {
        return $this->link->affected_rows;
    }

    public function getLastId() {
        return $this->link->insert_id;
    }

    public function __destruct() {
        $this->link->close();
    }
}