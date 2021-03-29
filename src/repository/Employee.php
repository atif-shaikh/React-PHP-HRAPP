<?php

namespace App\Repository;

use App\Config\Db;
use App\Utils\Date;
use App\Utils\Sanitize;

class Employee
{
    // Connection
    private $conn;

    // Table
    private $tableName = "employees";

    public function __construct(
        public ?int $empNo = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $email = null,
        public ?int $phoneNumber = null,
        public ?string $hireDate = null,
        public ?string $birthDate = null,
        public ?string $designation = null,
        public ?float $salary = null,
        public ?int $deptNo = null,
        public ?string $created = null,
    ) {
        $this->conn = (new Db())->connect();
    }

    // GET ALL
    public function getEmployees()
    {
        $sqlQuery = "SELECT * FROM " . $this->tableName . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    // READ single
    public function getSingleEmployee()
    {
        $sqlQuery = "
                SELECT * FROM " . $this->tableName . "
                    WHERE 
                        empNo = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->empNo);

        $stmt->execute();

        $dataRow = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $dataRow;
    }

    // CREATE
    public function create()
    {
        $sqlQuery = "INSERT INTO " . $this->tableName . "
            SET
                firstName = :firstName, 
                lastName = :lastName, 
                email = :email, 
                phoneNumber = :phoneNumber,
                hireDate = :hireDate,
                birthDate = :birthDate,
                designation = :designation,
                salary = :salary,
                deptNo = :deptNo";


        $stmt = $this->conn->prepare($sqlQuery);

        $this->hireDate = Date::format($this->hireDate);
        $this->birthDate = Date::format($this->birthDate);

        // bind data
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phoneNumber", $this->phoneNumber);
        $stmt->bindParam(":hireDate", $this->hireDate);
        $stmt->bindParam(":birthDate", $this->birthDate);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":salary", $this->salary);
        $stmt->bindParam(":deptNo", $this->deptNo);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // UPDATE
    public function update()
    {
        $sqlQuery = "UPDATE
                        " . $this->tableName . "
                SET
                    firstName = :firstName, 
                    lastName = :lastName, 
                    email = :email, 
                    phoneNumber = :phoneNumber,
                    hireDate = :hireDate,
                    birthDate = :birthDate,
                    designation = :designation,
                    salary = :salary,
                    deptNo = :deptNo
                WHERE 
                    empNo = :empNo";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->hireDate = Date::format($this->hireDate);
        $this->birthDate = Date::format($this->birthDate);

        // bind data
        $stmt->bindParam(":empNo", $this->empNo);
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phoneNumber", $this->phoneNumber);
        $stmt->bindParam(":hireDate", $this->hireDate);
        $stmt->bindParam(":birthDate", $this->birthDate);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":salary", $this->salary);
        $stmt->bindParam(":deptNo", $this->deptNo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function delete()
    {
        $sqlQuery = "DELETE FROM " . $this->tableName . " WHERE empNo = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->empNo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
