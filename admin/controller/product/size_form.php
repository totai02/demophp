<?php

global $loader, $user, $document, $config;

$document->setTitle('Nhóm tài khoản');
$document->setBreadcrumb('Nhóm tài khoản');
$document->setBreadcrumb('Thêm tài khoản');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

$loader->model('product/size');
$loader->model('tool/image');

$error = array();

if (isset($_GET['size_id'])) {
    $size_id = $_GET['size_id'];

    $size_info = _getSizeOrError($_GET['size_id']);

    if (!is_array($size_info)) {
        exit($size_info);
    }

    $data['is_edit'] = true;
    $data['action'] = urlLink('product/size_form', 'size_id=' . $_GET['size_id'] . $url);
} else {
    $size_id = 0;
    $data['is_edit'] = false;
    $data['action'] = urlLink('product/size_form' . $url);
}

$data['cancel'] = urlLink('product/size_list' . $url);

if (isMethod('post')) {
    $error = _validateForm();

    if (!$error) {
        if (!empty($size_info)) {
            editSize($_GET['size_id'], $_POST);
        } else {
            addSize($_POST);
        }

        $document->setFlash('Bạn đã cập nhật thành công !');

        redirect('product/size_list' . $url);
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
} elseif (!empty($size_info)) {
    $data['name'] = $size_info['name'];
} else {
    $data['name'] = '';
}

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

function _validateForm()
{
    global $user;

    $error = [];

    if (!$user->hasPermission('modify', 'product/size_form')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    if (strlen($_POST['name']) < 1 || strlen($_POST['name']) > 255) {
        $error['name'] = 'Tên phải từ 1 cho đến 255 ký tự';
    }

    return $error;
}

function _getSizeOrError($size_id)
{
    $size_info = getSize($size_id);

    if ($size_info) {
        return $size_info;
    } else {
        global $loader;

        $data['header'] = $loader->controller('layout/header');
        $data['footer'] = $loader->controller('layout/footer');

        return $loader->view('error/not_found', $data);
    }
}

echo $loader->view('product/size_form', $data);