<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';

$app = AppFactory::create();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/CertificazioniController.php';

$app = AppFactory::create();

$app->get('/alunni', "AlunniController:index");
$app->get('/alunni/{id}', "AlunniController:view");
$app->post('/alunni', "AlunniController:create");
$app->put('/alunni/{id}', "AlunniController:update");
$app->delete('/alunni/{id}', "AlunniController:delete");

$app->get('/certificazioni', "CertificazioniController:index");
$app->get('/certificazioni/{id}', "CertificazioniController:view");
$app->post('/certificazioni', "CertificazioniController:create");
$app->put('/certificazioni/{id}', "CertificazioniController:update");
$app->delete('/certificazioni/{id}', "CertificazioniController:delete");

$app->run();
