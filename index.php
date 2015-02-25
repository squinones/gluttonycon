<?php


require_once(__DIR__.'/vendor/autoload.php');
Dotenv::load(__DIR__);

session_start();
$app = new \Slim\Slim(array(
    'templates.path' => './views',
    'debug' => false
));

$loader = new Twig_Loader_Filesystem(__DIR__.'/views');
$twig = new Twig_Environment($loader);


$app->notFound(function () use($app)  {
    $app->redirect('/error');
});


$name = (isset($_SESSION['name'])) ? $_SESSION['name'] : '';
$image = (isset($_SESSION['image'])) ? $_SESSION['image'] : '';

$twig->addGlobal('name', $name);
$twig->addGlobal('image', $image);
$twig->addGlobal('basedomain', $_ENV['BASEDOMAIN']);


//MISC PAGESx
$app->get('/', function () use ($twig) {
    echo $twig->render('index.php');
});
$app->get('/lolwut', function() use($twig){
    echo $twig->render('lolwut.php');
});

// SIGN UP RELATED STUFFS
$app->get('/signup', function() use($twig){
    echo $twig->render('signup.php');
});

$app->get('/logout', function() use($twig){
    $_SESSION = [];
    header("Location: /");
    exit;
});

$app->get('/error', function() use($twig){
    echo $twig->render('404.php');
});

$app->post('/completeSignup', function () use ($twig){

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $avatar = isset($_POST['avatar']) ? $_POST['avatar'] : '';
    $gh_id = isset($_POST['gh_id']) ? $_POST['gh_id'] : '';
    $gh_url = isset($_POST['gh_url']) ? $_POST['gh_url'] : '';
    $gh_un = isset($_POST['gh_un']) ? $_POST['gh_un'] : '';


    if ($email == '')
    {
        echo $twig->render('signup-form.php', ['email' => $email, 'name' => $name, 'avatar' => $avatar, 'gh_id' => $gh_id, 'gh_url' => $gh_url, 'gh_un' => $gh_un, 'error' => true]);
    }
    else
    {
        $conn = new PDO('mysql:dbname=doyoucomputer;host=localhost', $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);

        $query = 'SELECT * FROM users where email = "'.$email.'"';

        $find = $conn->prepare($query);
        $find->execute();
        if ($find->rowCount() == 0)
        {
            // query
            $sql = "INSERT INTO users (github_username, email, fullname, github_id, profile_image, profile_url)
                VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $gh_un,
                $email,
                $name,
                $gh_id,
                $avatar,
                $gh_url
            ]);
        }

        $_SESSION['name'] = $name;
        $_SESSION['image']   = $avatar;

        header("Location: /");
        exit;
    }
});


$app->get('/auth', function() use($twig)
{
    $client_id = $_ENV['GH_CLIENT_ID'];
    $client_secret = $_ENV['GH_CLIENT_SECRET'];
    $redirect_url = $_ENV['GH_REDIRECT_URI'];

    if(isset($_GET['code']))
    {
        $code = $_GET['code'];

        $client = new \GuzzleHttp\Client();
        $r = $client->post('https://github.com/login/oauth/access_token',
            [
                'body' => [
                    'client_id' => $client_id,
                    'client_secret' => $client_secret,
                    'code' => $code
                ],
                "headers" => [
                    "Accept" => "application/json"]
            ])->json();

        $access_token = $r['access_token'];

        $user_data = $client->get("https://api.github.com/user?access_token=".$access_token)->json();
        $email = isset($user_data['email']) ? $user_data['email'] : '';
        $name = isset($user_data['name']) ? $user_data['name'] : '';
        $avatar = isset($user_data['avatar_url']) ? $user_data['avatar_url'] : '';
        $gh_id = isset($user_data['id']) ? $user_data['id'] : '';
        $gh_url = isset($user_data['url']) ? $user_data['url'] : '';
        $gh_username = isset($user_data['url']) ? $user_data['url'] : '';


        $conn = new PDO('mysql:dbname=doyoucomputer;host=localhost', $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);

        $query = 'SELECT * FROM users where github_id = "'.$gh_id.'"';

        $find = $conn->prepare($query);
        $find->execute();

        if ($find->rowCount() > 0)
        {
            $_SESSION['name'] = $name;
            $_SESSION['image']   = $avatar;

            header("Location: /");
            exit;
        }

        echo $twig->render('signup-form.php', ['email' => $email, 'name' => $name, 'avatar' => $avatar, 'gh_id' => $gh_id, 'gh_url' => $gh_url, 'gh_un' => $gh_username]);
    }
    else
    {
        $url = "https://github.com/login/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_url";
        header("Location: $url");
        exit;
    }
});

//CONTACT FORM STUFFS
$app->get('/contact', function() use($twig){
    echo $twig->render('contact.php');
});

//USER RELATED STUFFS
$app->get('/challenges', function() use($twig){
    echo $twig->render('user/challenges.php');
});

$app->get('/notifications', function() use($twig){
    echo $twig->render('user/notifications.php');
});


//CHALLENGE RELATED STUFFS
$app->get('/current', function() use($twig){
    echo $twig->render('challenges/current.php');
});

$app->get('/submit', function() use($twig){
    echo $twig->render('challenges/submit.php');
});

$app->get('/past', function() use($twig){
    echo $twig->render('challenges/past_list.php');
});

$app->get('/past/:id', function($id) use($twig){
    echo $twig->render('challenges/past_single.php');
});

$app->run();