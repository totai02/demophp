<?php

global $loader, $user, $document, $config;

$document->setTitle('Màu sản phẩm');
$document->setBreadcrumb('Màu sản phẩm');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

$loader->model('product/color');
$loader->model('tool/image');

$error = array();

if (isset($_GET['color_id'])) {
    $color_id = $_GET['color_id'];

    $color_info = _getColorOrError($_GET['color_id']);

    if (!is_array($color_info)) {
        exit($color_info);
    }

    $data['is_edit'] = true;
    $data['action'] = urlLink('product/color_form', 'color_id=' . $_GET['color_id'] . $url);
} else {
    $color_id = 0;
    $data['is_edit'] = false;
    $data['action'] = urlLink('product/color_form' . $url);
}

$data['cancel'] = urlLink('product/color_list' . $url);

if (isMethod('post')) {
    $error = _validateForm();

    if (!$error) {
        if (!empty($color_info)) {
            editColor($_GET['color_id'], $_POST);
        } else {
            addColor($_POST);
        }

        $document->setFlash('Bạn đã cập nhật thành công !');

        redirect('product/color_list' . $url);
    }
}

if (isset($error['warning'])) {
    $data['error_warning'] = $error['warning'];
} else {
    $data['error_warning'] = '';
}

if (isset($error['name'])) {
    $data['error_name'] = $error['name'];
} else {
    $data['error_name'] = '';
}

if (isset($_POST['name'])) {
    $data['name'] = $_POST['name'];
} elseif (!empty($color_info)) {
    $data['name'] = $color_info['name'];
} else {
    $data['name'] = '';
}

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

function _validateForm()
{
    global $user;

    $error = [];

    if (!$user->hasPermission('modify', 'product/color_form')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    if (strlen($_POST['name']) < 1 || strlen($_POST['name']) > 255) {
        $error['name'] = 'Tên phải từ 1 cho đến 255 ký tự';
    }

    return $error;
}

function _getColorOrError($color_id)
{
    $color_info = getColor($color_id);

    if ($color_info) {
        return $color_info;
    } else {
        global $loader;

        $data['header'] = $loader->controller('layout/header');
        $data['footer'] = $loader->controller('layout/footer');

        return $loader->view('error/not_found', $data);
    }
}

echo $loader->view('product/color_form', $data);