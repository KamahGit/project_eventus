<?php
require_once __DIR__ . '/../dbconfig.php';
//require_once '../initialize.php';
class dataBase
{
    private $conn;
    private $querystring;
    private $result;//mysqli_result or bool(false);


    private $tableFields;


    public function __construct()
    {
        $this->connect();
    }

    public function setSql($querystring)
    {
        if (!empty($querystring))
            $this->querystring = $querystring;
        return $this;
    }

    public function connect()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            setMessage('Connection Aborted : [' . $this->conn->connect_errno . '] '
                . $this->conn->connect_error, 'error');
        }

    }


    public function getConn()
    {
        return $this->conn;
    }


    public function execQuery()
    {
        //alias = setResults
        $result = $this->conn->query($this->querystring);
        if (!$result) {
            die('Aborted : [' . $this->conn->errno . '] ' . $this->conn->error);
        }

        $this->result = $result;

        return $this;

    }
    public function getResult()
    {
        return $this->result;
    }

    //SELECT QUERIES
    public function getResults($class='')
    {
        $answer = array();
        $this->execQuery();
        if (!empty($class)) {
            while ($row = mysqli_fetch_object($this->getResult(), $class)) {
                $answer[] = $row;
            }
        } else {
            while ($row = mysqli_fetch_object($this->getResult())) {
                $answer[] = $row;
            }
        }
        return $answer;
    }

    //SETS $tableFields to ARRAY of field Names
    public function setTableFields()
    {
        $fieldsObj = $this->result->fetch_fields();
        $fields = array();
        foreach ($fieldsObj as $obj) {
            $fields[] = $obj->name;
        }
        $this->tableFields = $fields;
        return $this;
    }

    public function getTableFields()
    {
        return $this->tableFields;
    }

    public function disPlayFields()
    {
        $fields = $this->getTableFields();
        echo '<div class="table-wrapper">';
        echo '<table class="table table-hover table-striped table-responsive" id="myTable">
                    <thead>';

        foreach ($fields as $field) {
            echo '<th>' . $field . '</th>';
        }
        if (isAdmin()){
        echo '<th>Actions</th></thead>';}
        else{echo '</thead>';}
    }

    public function deleteRecord($id, $table)
    {
        $sql = "DELETE FROM " . $table . " WHERE `id`=" . $id;
        $this->setSql($sql);
        $result = $this->execQuery()->getResult();
        return $result;

    }


    public function freeRes()
    {
        mysqli_free_result($this->result);
    }

    public function close()
    {
        mysqli_close($this->conn);
    }
}


