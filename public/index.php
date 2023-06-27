<?php

use App\Router;

require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router(dirname(__DIR__).'/views');

$router->get('/', 'post/index', 'home')//(url, view, url_name)
        ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
        ->get('/blog/category', 'category/show', 'category')
        ->run();


