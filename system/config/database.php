<?php

define('DB_HOST', getenv("DB_HOST") ? getenv("DB_HOST") : 'localhost');
define('DB_PORT', getenv("DB_PORT") ? getenv("DB_PORT") : '3306');
define('DB_USER', getenv("DB_USER") ? getenv("DB_USER") : 'root');
define('DB_PASSWORD', getenv("DB_PASSWORD") ? getenv("DB_PASSWORD") : '');
define('DB_NAME', getenv("DB_NAME") ? getenv("DB_NAME") : 'demo_shop');
define('DB_PREFIX', 'tt_');
