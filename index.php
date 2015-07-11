<?php
require_once(__DIR__ . '/vendor/autoload.php');

$app = new \Slim\Slim(array(
    'templates.path' => './views',
    'debug' => false
));

session_start();

$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
$twig = new Twig_Environment($loader);

$json = file_get_contents(__DIR__ . "/rsvp.json");
$rsvps = json_decode($json);


$app->notFound(function () use ($app) {
    $app->redirect('/error');
});

$app->get('/', function () use ($twig, $rsvps) {

    $message = null;
    if (isset($_SESSION['slim.flash']) && isset($_SESSION['slim.flash']['message'])) {
        $message = $_SESSION['slim.flash']['message'];
    }

    echo $twig->loadTemplate('index.php')->render(['rsvp' => $rsvps->rsvp, 'message' => $message]);
});

$app->get('/rsvp', function () use ($twig) {
    echo $twig->render('rsvp.php');
});

$app->post('/rsvp', function () use ($twig, $rsvps, $app) {
    $gravatar = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($_POST['email']))) . "?s=300";

    $person = new stdClass();
    $person->name = $_POST['name'];
    $person->avatar = $gravatar;
    $person->twitter = isset($_POST['twitter']) ? $_POST['twitter'] : null;

    $rsvps->rsvp[] = $person;

    file_put_contents(__DIR__ . "/rsvp.json", json_encode($rsvps));

    $app->flash('message', 'Well done! See you in Boston! Bring your stretchy pants');

    $app->redirect('/#congrats');
});

$app->run();