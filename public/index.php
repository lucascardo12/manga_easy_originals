<?php
use Slim\Factory\AppFactory;
use DI\Container;
use app\modules\comic\controllers\ComicController;
use Slim\Routing\RouteCollectorProxy;
use app\modules\chapter\controllers\ChapterController;
use app\modules\content_chapter\controllers\ContentChapterController;

require __DIR__ . '/../vendor/autoload.php';
$di = new Container();

// Set container to create App with on AppFactory
AppFactory::setContainer($di);

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// $app->get('/manga', [QueueController::class , 'list']);
$app->group('/comic', function (RouteCollectorProxy $group) {
    $group->get('', [ComicController::class , 'list']);
    $group->get('/{id}', [ComicController::class , 'get']);
    $group->post('', [ComicController::class , 'create']);
});

$app->group('/chapter', function (RouteCollectorProxy $group) {
    $group->get('', [ChapterController::class , 'list']);
    $group->get('/{id}', [ChapterController::class , 'get']);
    $group->post('', [ChapterController::class , 'create']);
});

$app->group('/content_chapter', function (RouteCollectorProxy $group) {
    $group->get('', [ContentChapterController::class , 'list']);
    $group->get('/{id}', [ContentChapterController::class , 'get']);
    $group->post('', [ContentChapterController::class , 'create']);
});
// $app->get('/imagechapter', [QueueController::class , 'list']);

$app->run();