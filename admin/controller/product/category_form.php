<?php

global $loader, $user, $document, $config;

$document->setTitle('Nhóm tài khoản');
$document->setBreadcrumb('Nhóm tài khoản');
$document->setBreadcrumb('Thêm tài khoản');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

$loader->model('product/category');
$loader->model('tool/image');

$error = array();

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $category_info = _getCategoryOrError($_GET['category_id']);

    if (!is_array($category_info)) {
        exit($category_info);
    }

    $data['is_edit'] = true;
    $data['action'] = urlLink('product/category_form', 'category_id=' . $_GET['category_id'] . $url);
} else {
    $category_id = 0;
    $data['is_edit'] = false;
    $data['action'] = urlLink('product/category_form' . $url);
}

$data['cancel'] = urlLink('product/category_list' . $url);

if (isMethod('post')) {
    $error = _validateForm();

    if (!$error) {
        if (!empty($category_info)) {
            editCategory($_GET['category_id'], $_POST);
        } else {
            addCategory($_POST);
        }

        $document->setFlash('Bạn đã cập nhật thành công !');

        redirect('product/category_list' . $url);
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

if (isset($_POST['parent_id'])) {
    $data['parent_id'] = $_POST['parent_id'];
} elseif (!empty($category_info)) {
    $data['parent_id'] = $category_info['parent_id'];
} else {
    $data['parent_id'] = '';
}

$results = getCategories();

$data['categories'] = array();

// loại bỏ chính id đang chỉnh sửa
foreach ($results as $result) {
    if (!$result['parent_id'] && $result['category_id'] != $category_id) {
        $data['categories'][] = $result;
    }
}

if (isset($_POST['name'])) {
    $data['name'] = $_POST['name'];
} elseif (!empty($category_info)) {
    $data['name'] = $category_info['name'];
} else {
    $data['name'] = '';
}

if (isset($_POST['description'])) {
    $data['description'] = $_POST['description'];
} elseif (!empty($category_info)) {
    $data['description'] = $category_info['description'];
} else {
    $data['description'] = '';
}

if (isset($_POST['image'])) {
    $data['image'] = $_POST['image'];
} elseif (!empty($category_info)) {
    $data['image'] = $category_info['image'];
} else {
    $data['image'] = '';
}

if (isFile($data['image'])) {
    $data['thumb'] = resize($data['image'], 100, 100);
} else {
    $data['thumb'] = noImage();
}

$data['no_image'] = noImage();

if (isset($_POST['status'])) {
    $data['status'] = $_POST['status'];
} elseif (!empty($category_info)) {
    $data['status'] = $category_info['status'];
} else {
    $data['status'] = '1';
}


$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

function _validateForm()
{
    global $user;

    $error = [];

    if (!$user->hasPermission('modify', 'product/category_form')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    if (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 255) {
        $error['name'] = 'Tên phải từ 2 cho đến 255 ký tự';
    }

    return $error;
}

function _getCategoryOrError($category_id)
{
    $category_info = getCategory($category_id);

    if ($category_info) {
        return $category_info;
    } else {
        global $loader;

        $data['header'] = $loader->controller('layout/header');
        $data['footer'] = $loader->controller('layout/footer');

        return $loader->view('error/not_found', $data);
    }
}

echo $loader->view('product/category_form', $data);