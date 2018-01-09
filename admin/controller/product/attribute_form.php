<?php

global $loader, $user, $document, $config;

$document->setTitle('Thuộc tính sản phẩm');
$document->setBreadcrumb('Thuộc tính sản phẩm');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

$loader->model('product/attribute');
$loader->model('tool/image');

$error = array();

if (isset($_GET['attribute_id'])) {
    $attribute_id = $_GET['attribute_id'];

    $attribute_info = _getAttributeOrError($_GET['attribute_id']);

    if (!is_array($attribute_info)) {
        exit($attribute_info);
    }

    $data['is_edit'] = true;
    $data['action'] = urlLink('product/attribute_form', 'attribute_id=' . $_GET['attribute_id'] . $url);
} else {
    $attribute_id = 0;
    $data['is_edit'] = false;
    $data['action'] = urlLink('product/attribute_form' . $url);
}

$data['cancel'] = urlLink('product/attribute_list' . $url);

if (isMethod('post')) {
    $error = _validateForm();

    if (!$error) {
        if (!empty($attribute_info)) {
            editAttribute($_GET['attribute_id'], $_POST);
        } else {
            addAttribute($_POST);
        }

        $document->setFlash('Bạn đã cập nhật thành công !');

        redirect('product/attribute_list' . $url);
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
} elseif (!empty($attribute_info)) {
    $data['name'] = $attribute_info['name'];
} else {
    $data['name'] = '';
}

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

function _validateForm()
{
    global $user;

    $error = [];

    if (!$user->hasPermission('modify', 'product/attribute_form')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    if (strlen($_POST['name']) < 1 || strlen($_POST['name']) > 255) {
        $error['name'] = 'Tên phải từ 1 cho đến 255 ký tự';
    }

    return $error;
}

function _getAttributeOrError($attribute_id)
{
    $attribute_info = getAttribute($attribute_id);

    if ($attribute_info) {
        return $attribute_info;
    } else {
        global $loader;

        $data['header'] = $loader->controller('layout/header');
        $data['footer'] = $loader->controller('layout/footer');

        return $loader->view('error/not_found', $data);
    }
}

echo $loader->view('product/attribute_form', $data);