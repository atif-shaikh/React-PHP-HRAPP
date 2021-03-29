<?php

namespace App\Routes;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteCollectorProxy;
use App\Config\Db;
use App\Repository\Report;
use App\Utils\Sanitize;
use App\Action\PreflightAction;
use Exception;

$group->get('/reports', function ($request, $response, array $args): Response {
    try {
        $report = new Report();
        $deptWithHighSal = $report->getDepartmentsWithHighestSalary();
        $deptWithEmpEarningMoreThan50 = $report->getDepartmentsWithEmpSalMoreThanFifty();
        $reports = [
            "deptWithHighSal" => $deptWithHighSal,
            "deptWithEmpEarningMoreThan50" => $deptWithEmpEarningMoreThan50
        ];
        $response->withStatus(200)
            ->getBody()->write(json_encode(["success" => true, "data" => $reports]));
    } catch (\PDOException $e) {
        // show error message as Json format
        $response->withStatus(400)
            ->getBody()
            ->write(json_encode(["errMsg" => $e->getMessage()]));
    }
    return $response;
});

$group->options('/reports', PreflightAction::class);
