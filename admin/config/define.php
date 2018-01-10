<?php

define('DIR_SUB', '/sv-demophp/');

define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'] . DIR_SUB);
define('DIR_APP', DIR_ROOT . 'admin/');
define('DIR_SYSTEM', DIR_ROOT . 'system/');
define('DIR_TEMPLATE', DIR_APP . 'view/');
define('DIR_RESOURCES', DIR_ROOT . 'resources/');
define('DIR_IMAGE', DIR_RESOURCES . 'upload/image/');

define('HTTP_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . DIR_SUB);
define('HTTP_APP', HTTP_ROOT . 'admin.php');