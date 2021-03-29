<?php

namespace App\Repository;

use App\Config\Db;

class Report
{
    // Connection
    private $conn;

    // Table
    private $tableName = "employees";

    public function __construct()
    {
        $this->conn = (new Db())->connect();
    }

    public function getDepartmentsWithHighestSalary()
    {
        $sqlQuery = "select d.deptName, Max(e.salary) as salary
            from departments d left join employees e
            on e.deptNo = d.deptNo
            group by d.deptName";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();

        $dataRow = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $dataRow;
    }

    public function getDepartmentsWithEmpSalMoreThanFifty()
    {
        $sqlQuery = "select deptNo, count(*) as empCount from employees 
            where salary > 50000  
            group by deptNo
            having empCount >= 2";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();

        $dataRow = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $dataRow;
    }
}
