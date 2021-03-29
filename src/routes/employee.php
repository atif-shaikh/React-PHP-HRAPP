<?php

namespace App\Routes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteCollectorProxy;
use App\Config\Db;
use App\Repository\Employee;
use App\Utils\Sanitize;
use App\Action\PreflightAction;
use Exception;

$group->get('/employees', function ($request, $response, array $args): Response {
    try {
        $employees = (new Employee())->getEmployees();
        $response->withStatus(200)
            ->getBody()->write(json_encode(["success" => true, "data" => $employees]));
    } catch (\PDOException $e) {
        // show error message as Json format
        $response->withStatus(400)
            ->getBody()
            ->write(json_encode(["errMsg" => $e->getMessage()]));
    }
    return $response;
});

$group->options('/employees', PreflightAction::class);

$group->get('/employee/{id:[0-9]+}', function ($request, $response, array $args): Response {
    try {
        $empNo = $request->getAttribute('id');
        $employee = (new Employee(...['empNo' => $empNo]))->getSingleEmployee();
        if ($employee) {
            $response->withStatus(200)
                ->getBody()->write(["success" => true, "data" => json_encode($employee)]);
        } else {
            throw new \PDOException("Error fetching employee with id " . $empNo);
        }
    } catch (\PDOException $e) {
        // show error message as Json format

        $response->withStatus(400)
            ->getBody()
            ->write(json_encode(["errMsg" => $e->getMessage()]));
    }
    return $response;
});

$group->options('/employee', PreflightAction::class);
$group->options('/employee/{id:[0-9]+}', PreflightAction::class);

$group->map(['POST', 'DELETE', 'PATCH', 'PUT'], '/employee', function (Request $request, Response $response, array $args): Response {
    $sanitizedData = [];
    $formData = $request->getParsedBody();
    $operationExecutionMsg = '';

    try {

        if (empty($formData))
            throw new \Exception("request data is null");
        //Sanitize Data
        foreach ($formData as $key => $val) {
            $sanitizedData[$key] = Sanitize::Data($val);
        }
        $employee = (new Employee(...$sanitizedData));
        $successMsg = "Employee %s successfully!.";;
        $errorMsg = "Error %s Employee";
        $operationCallHandler = match ($request->getMethod()) {
            'POST' => function () use ($employee, $operationExecutionMsg) {
                $resp = $employee->create();
                $operationExecutionMsg = $resp ? "Created" : "Creating";
                return [$resp, $operationExecutionMsg];
            },
            'PUT' => function () use ($employee, $operationExecutionMsg) {
                $resp = ($employee->empNo) ? $employee->update() : false;
                $operationExecutionMsg = $resp ? "Updated" : "Updating";
                return [$resp, $operationExecutionMsg];
            },
            'DELETE' => function () use ($employee, $operationExecutionMsg) {
                $resp = $employee->delete();
                $operationExecutionMsg = $resp ? "Deleted" : "Deleting";
                return [$resp, $operationExecutionMsg];
            },
            default => false,
        };
        list($result, $operationExecutionMsg) = $operationCallHandler();
        if (is_bool($result) && $result) {
            $response->withStatus(200)
                ->getBody()->write(json_encode(["success" => true, "msg" => sprintf($successMsg, $operationExecutionMsg)]));
        } else {
            throw new \Exception(sprintf($errorMsg, $operationExecutionMsg));
        }
    } catch (\Exception $e) {
        $response->withStatus(400)
            ->getBody()->write(json_encode(["errMsg" => $e->getMessage()]));
    }

    return $response;
})->setName('employee');
