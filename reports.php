<?php

class Reports {

    private $id;
    private $host;
    private $code;
    private $message;
    private $created;

    public function connectDB() {
        $servername = "localhost";
        $db = "rest";
        $username = "root";
        $password = "";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function newEmptyInstance() {
        return new self();
    }

//    private function __construct() {
//    }
    public function setId($setId) {
        $this->id = $setId;
    }
    public function getId() {
        return $this->id;
    }

    public function setHost($setHost) {
        $this->host = $setHost;
    }

    public function getHost() {
        return $this->host;
    }

    public function setCode($setCode) {
        $this->code = $setCode;
    }

    public function getCode() {
        return $this->code;
    }

    public function setMessage($setMessage) {
        $this->message = $setMessage;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getCreated() {
        return $this->created;
    }

    public function save() {
        if (isset($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    private function update() {

        $sql = "UPDATE reports SET `host`='{$this->host}', "
            . "`code`='{$this->code}', `message`='{$this->message}'"
            . " WHERE `id`='{$this->id}'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    private function insert() {

        $sql = "INSERT INTO `reports` ( `host`, `code`, `message`)
        VALUES ('{$this->host}', '{$this->code}', '{$this->message}')";

        $result = $this->conn->exec($sql);
        $id = $this->conn->lastInsertId();
        $this->id = $id;
        echo "New record created successfully";
        return $result;
    }

    public function delete($id) {
        if ($id < 0 || $id > PHP_INT_MAX) {
            return false;
        }
        $result = $this->conn->exec("DELETE FROM `reports` WHERE `id`=" . $id );
        echo "This reports delete";
        return $result;
    }

    public function findList($countFind, $OptFrom = null) {
        $From = is_null($OptFrom) ? '' : (int) $OptFrom . ', ';
        $query = "SELECT * FROM `reports` LIMIT {$From}{$countFind}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->FetchALL(PDO::FETCH_ASSOC);
        if ($result !== false) {
            $ReturnReports = array();
            foreach ($result as $arrResult)
                {
                    $reports = new self();
                    $reports->id = $arrResult['id'];
                    $reports->host = $arrResult['host'];
                    $reports->code = $arrResult['code'];
                    $reports->message = $arrResult['message'];
                    $reports->created = $arrResult['created'];
                    $ReturnReports[] = $reports;
                }
            return $ReturnReports;
        } else {
            return false;
        }
    }

    public function findIndex($id) {
        $query = "SELECT * FROM `reports` WHERE `id`= $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->FetchALL(PDO::FETCH_ASSOC);
        if ($result !== false) {
            $ReturnReports = array();
            foreach ($result as $arrResult)
            {
                $reports = new self();
                $reports->id = $arrResult['id'];
                $reports->host = $arrResult['host'];
                $reports->code = $arrResult['code'];
                $reports->message = $arrResult['message'];
                $reports->created = $arrResult['created'];
                $ReturnReports[] = $reports;
            }
            return $ReturnReports;
        } else {
            return false;
        }
    }

    public function count() {
        $query = "SELECT COUNT(`id`) as `count` FROM `reports`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->FetchALL(PDO::FETCH_ASSOC);
        $count = (int) $row[0]['count'];
        return $count;
    }

    public function toArray()
    {
        return [
            "id" => $this->id,
            "host" => $this->host,
            "code" => $this->code,
            "message" => $this->message,
        ];
    }
}






