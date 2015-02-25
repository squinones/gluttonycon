<?php
require_once(__DIR__.'/vendor/autoload.php');

$app = new \Slim\Slim(array(
    'templates.path' => './views',
    'debug' => false
));

$loader = new Twig_Loader_Filesystem(__DIR__.'/views');
$twig = new Twig_Environment($loader);


$app->notFound(function () use($app)  {
    $app->redirect('/error');
});


//MISC PAGESx
$app->get('/', function () use ($twig) {
    echo $twig->render('index.php');
});

$app->run();