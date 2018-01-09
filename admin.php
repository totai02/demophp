<?php
session_start();

error_reporting(E_ALL);

$sub = '/';

define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'] . $sub);
define('DIR_APP', DIR_ROOT . 'admin/');
define('DIR_SYSTEM', DIR_ROOT . 'system/');
define('DIR_TEMPLATE', DIR_APP . 'view/');
define('DIR_RESOURCES', DIR_ROOT . 'resources/');
define('DIR_IMAGE', DIR_RESOURCES . 'upload/image/');

define('HTTP_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . $sub);
define('HTTP_APP', HTTP_ROOT . 'admin.php');

include_once(DIR_SYSTEM . 'config.php');
include_once(DIR_SYSTEM . 'bootstrap.php');

// init loader
$loader = new Loader();

// init db
$db = new DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// init user
$user = new User();

// init config
$config = new Config();

$query = $db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE code = 'config'");

foreach ($query->rows as $result) {
    if ($result['json']) {
        $config->set($result['key'], json_decode($result['value'], true));
    } else {
        $config->set($result['key'], $result['value']);
    }
}

// init document
$document = new Document();

if (isset($_GET['route'])) {
    $route = $_GET['route'];

    $page = 'error/not_found';

    if (in_array($route, $config->get('local.config.ignore'))) {
        $page = $route;
    } else {
        if ($user->isLogin()) {
            if (file_exists(DIR_APP . 'controller/' . $route . '.php')) {
                $page = $route;
            }
        } else {
            $page = 'auth/login';
        }
    }
} else {
    if (isset($_SESSION['user'])) {
        $page = 'common/dashboard';
    } else {
        $page = 'auth/login';
    }
}

if (!$user->hasPermission('access', $page) && !in_array($page, $config->get('local.config.ignore'))) {
    $page = 'error/permission';
}

include_once(DIR_APP . 'controller/' . $page . '.php');

