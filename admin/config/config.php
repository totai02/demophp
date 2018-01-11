<?php

return array(
    'Default_Controller' => DIR_ROOT . 'admin.php',

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
    'no_image'    => 'no_image.png',
    'filters'     => array(
        'name'     => 'Tên sản phẩm',
        'tag'      => 'Tag',
        'category' => 'Danh mục'
    )
);