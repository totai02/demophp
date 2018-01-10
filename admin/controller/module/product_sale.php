<?php

global $loader, $user;

$document->setTitle('Sản phẩm khuyến mại');

$document->setBreadcrumb('Sản phẩm khuyến mại', urlLink('module/product_sale'));

$loader->model('setting/setting');

if (isMethod('post')) {
    $error = _validateForm();

    if (!$error) {
        editSetting($_POST, 'product_sale');

        $document->setFlash('Bạn đã cập nhật thành công !');

        redirect('module/product_sale');
    }
}

if (isset($error['warning'])) {
    $data['error_warning'] = $error['warning'];
} else {
    $data['error_warning'] = '';
}

if (isset($error['width'])) {
    $data['error_width'] = $error['width'];
} else {
    $data['error_width'] = '';
}

if (isset($error['height'])) {
    $data['error_height'] = $error['height'];
} else {
    $data['error_height'] = '';
}

$data['module'] = array();

if (isset($_POST['product_sale_module'])) {
    $data['module'] = $_POST['product_sale_module'];
} elseif ($config->get('product_sale_module')) {
    $data['module'] = $config->get('product_sale_module');
}

//var_dump($data['module']);

$data['layouts'] = $config->get('default.layout');
$data['positions'] = $config->get('default.position');

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('module/product_sale', $data);

// ------------------

function _validateForm()
{
    global $user;

    $error = [];

    if (!$user->hasPermission('modify', 'module/product_sale')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    if (isset($_POST['product_sale_module'])) {
        if (!$_POST['product_sale_module']['width']) {
            $error['width'] = 'Vui lòng nhập chiều rộng';
        }
        if (!$_POST['product_sale_module']['height']) {
            $error['height'] = 'Vui lòng nhập chiều cao';
        }
    }

    return $error;
}