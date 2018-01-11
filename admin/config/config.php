<?php

return array(
    'default_controller' => DIR_ROOT . 'admin.php',

    'ignore' => array(
        'auth/forgot',
        'auth/login',
        'auth/logout',
        'auth/reset',
        'layout/footer',
        'layout/header',
        'error/not_found',
        'error/permission'
    ),

    'limit_admin' => 10,
    'no_image'    => 'no_image.png'
);