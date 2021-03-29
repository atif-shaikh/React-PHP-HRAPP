<?php

namespace App\Repository;

use App\Config\Db;
use App\Utils\Date;
use App\Utils\Sanitize;

class Department
{
    // Connection
    private $conn;

    // Table
    private $tableName = "departments";

    public function __construct(
        public ?int $deptNo = null,
        public ?string $deptName = null,
        public ?string $created = null,
    ) {
        $this->conn = (new Db())->connect();
    }

    // GET ALL
    public function getDepartments()
    {
        $sqlQuery = "SELECT * FROM " . $this->tableName . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    // READ single
    public function getSingleDepartment()
    {
        $sqlQuery = "
                SELECT * FROM " . $this->tableName . "
                    WHERE 
                        deptNo = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->deptNo);

        $stmt->execute();

        $dataRow = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $dataRow;
    }

    // CREATE
    public function create()
    {
        $sqlQuery = "INSERT INTO " . $this->tableName . "
            SET deptName = :deptName";

        $stmt = $this->conn->prepare($sqlQuery);
        // bind data
        $stmt->bindParam(":deptName", $this->deptName);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // UPDATE
    public function update()
    {
        $sqlQuery = " UPDATE " . $this->tableName . "
            SET deptName = :deptName
            WHERE 
                deptNo = :deptNo";

        $stmt = $this->conn->prepare($sqlQuery);

        // bind data
        $stmt->bindParam(":deptNo", $this->deptNo);
        $stmt->bindParam(":deptName", $this->deptName);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function delete()
    {
        $sqlQuery = "DELETE FROM " . $this->tableName . " WHERE deptNo = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->deptNo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
