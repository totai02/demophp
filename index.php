<?php
session_start();

error_reporting(E_ALL);

include_once('home/config/define.php');

include_once(DIR_SYSTEM . 'config/database.php');
include_once(DIR_SYSTEM . 'bootstrap.php');

// init loader
$loader = new Loader();

// init db
$db = new DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// init user
$user = new User();

// init config
$config = new Config();

$query = $db->query("SELECT * FROM " . DB_PREFIX . "setting");

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

    if (file_exists(DIR_APP . 'controller/' . $route . '.php')) {
        $page = $route;
    } else {
        $page = 'error/not_found';
    }
} else {
    $page = 'common/home';
}

include_once(DIR_APP . 'controller/' . $page . '.php');

