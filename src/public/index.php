<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../config/db.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->add(\App\Middleware\CorsMiddleware::class);
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);



$app->group('/api/v1', function (RouteCollectorProxy $group) {

    require __DIR__ . '/../routes/employee.php';
    require __DIR__ . '/../routes/department.php';
    require __DIR__ . '/../routes/report.php';
});




$app->run();
