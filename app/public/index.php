<?php
define('ROOT_PATH', dirname(__DIR__));

require __DIR__ . '/../utils/router.php';

require __DIR__ . '/../models/user.php';
require __DIR__ . '/../models/session.php';
require __DIR__ . '/../models/post.php';

require __DIR__ . '/../controllers/FeedController.php';
require __DIR__ . '/../controllers/UserController.php';

require __DIR__ . '/../utils/migration.php';
require __DIR__ . '/../utils/mysql.php';


// require_once("/Users/keykibatyr/NewsFeedPHP/news-feed-proj/app/controllers/UserController.php");
// require_once("/Users/keykibatyr/NewsFeedPHP/news-feed-proj/app/controllers/FeedController.php");
// require_once("/Users/keykibatyr/NewsFeedPHP/news-feed-proj/app/models/user.php");
// require_once("/Users/keykibatyr/NewsFeedPHP/news-feed-proj/app/utils/migration.php");

$mySqlConf = new MySqlConfig('db', 'keykibatyr', 'alisher0505', 'newsfeed');
$db = OpenPDO($mySqlConf);
$userService = new UserService($db);
$postService = new PostService($db);
$sessionService = new sessionService($db);
$services = [
    UserService::class => $userService,
    PostService::class => $postService,
    SessionService::class => $sessionService
];
$router = new Router($services);


$router -> get('/signup', [UserController::class, 'signup']);
$router -> post('/signup', [UserController::class, 'processSignup']);


$router -> get('/signin', [UserController::class, 'signin']);
$router -> post('/signin', [UserController::class, 'processSignIn']);


$router -> get('/', [FeedController::class, 'feed']);
$router -> get('/health', [FeedController::class, 'health']);


$router -> dispatch($_SERVER['REQUEST_METHOD'], 
parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>