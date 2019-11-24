<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 16/07/2015
 * @Time    : 10:16
 * @File    : index.php
 * @Version : 1.0
 */
session_start();

    ini_set('display_errors',1);
    error_reporting(E_ALL);

    define('ROOT', dirname(__DIR__));
    define('USE_CLI', "N");

require ROOT . '/app/App.php';
require ROOT . '/app/AppFunctions.php';

    App::load();

isset($_GET['page']) ? $page = $_GET['page'] : $page = 'news.index';

$page = explode('.', $page);


if(empty($page[0]) OR empty($page[1])) :
    $page[0] = "news";
    $page[1] = "index";
endif;



if($page[0] == 'admin'){
    $controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
    $action = $page[2];
} else {
    $controller = '\App\Controller\\NewsController';
    $action = $page[1];
}

$controller = new $controller();

$controller->$action();

?>