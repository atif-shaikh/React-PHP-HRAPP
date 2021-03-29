<?php

namespace App\Routes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteCollectorProxy;
use App\Config\Db;
use App\Repository\Department;
use App\Utils\Sanitize;
use App\Action\PreflightAction;


$group->get('/departments', function (Request $request, Response $response): Response {
    try {
        $departments = (new Department())->getDepartments();
        if ($departments) {
            $response->withStatus(200)
                ->getBody()->write(json_encode(["success" => true, "data" => $departments]));
        } else
            throw new \PDOException("Error fetching departmens");
    } catch (\PDOException $e) {
        // show error message as Json format
        $response->withStatus(400)
            ->getBody()
            ->write(json_encode(["errMsg" => $e->getMessage()]));
    }
    return $response;
});

$group->options('/departments', PreflightAction::class);

$group->get('/department/{id:[0-9]+}', function (Request $request, Response $response, array $args): Response {
    try {
        $deptNo = $request->getAttribute('id');
        $department = (new Department(...['deptNo' => $deptNo]))->getSingleDepartment();
        if ($department) {
            $response->withStatus(200)
                ->getBody()->write(json_encode(["success" => true, "data" => $department]));
        } else
            throw new \PDOException("Error fetching department for ID " . $deptNo);
    } catch (\PDOException $e) {
        // show error message as Json format

        $response->withStatus(400)
            ->getBody()
            ->write(json_encode(["errMsg" => $e->getMessage()]));
    }
    return $response;
});
$group->options('/department', PreflightAction::class);

$group->map(['POST', 'DELETE', 'PATCH', 'PUT'], '/department', function ($request, $response, array $args): Response {
    $sanitizedData = [];
    $formData = $request->getParsedBody();

    //Sanitize Data
    foreach ($formData as $key => $val) {
        $sanitizedData[$key] = Sanitize::Data($val);
    }

    $department = (new Department(...$sanitizedData));
    $successMsg = "Department %s successfully!.";;
    $errorMsg = "Error %s Department";
    $operationExecutionMsg = '';

    try {
        $operationCallHandler = match ($request->getMethod()) {
            'POST' => function () use ($department, $operationExecutionMsg) {
                $resp = $department->create();
                $operationExecutionMsg = $resp ? "Created" : "Creating";
                return [$resp, $operationExecutionMsg];
            },
            'PUT' => function () use ($department, $operationExecutionMsg) {
                $resp = ($department->deptNo) ? $department->update() : false;
                $operationExecutionMsg = $resp ? "Updated" : "Updating";
                return [$resp, $operationExecutionMsg];
            },
            'DELETE' => function () use ($department, $operationExecutionMsg) {
                $resp = $department->delete();
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
            throw new \PDOException(sprintf($errorMsg, $operationExecutionMsg));
        }
    } catch (\PDOException $e) {
        $response->withStatus(400)
            ->getBody()->write(json_encode(["errMsg" => $e->getMessage()]));
    }

    return $response;
})->setName('department');
