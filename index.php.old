<?php

session_start();

define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
define('DIR_APP', DIR_ROOT . 'home/');
define('DIR_SYSTEM', DIR_ROOT . 'system/');
define('DIR_TEMPLATE', DIR_APP . 'view/');

if (isset($_GET['route'])) {
    $route = $_GET['route'];

    if (file_exists(DIR_APP . 'controller/' . $route . '.php')) {
        $page = $route;
    } else {
        $page = 'error/not_found';
    }
} else {
    $page = 'common/home';
}

include_once (DIR_SYSTEM . 'config.php');
include_once (DIR_SYSTEM . 'bootstrap.php');

// init
//$db = new mysqli(DB_HOST, DB_PORT, DB_USER, DB_PASSWORD, DB_NAME);
$loader = new Loader();

include_once(DIR_APP . 'controller/' . $page . '.php');

//$_SESSION['user_id'] = 1;
//unset($_SESSION['user_id']);
?>
