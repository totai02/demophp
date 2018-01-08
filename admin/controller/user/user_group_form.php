<?php

global $loader, $user, $document, $config;

$document->setTitle('Nhóm tài khoản');
$document->setBreadcrumb('Nhóm tài khoản');
$document->setBreadcrumb('Thêm tài khoản');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

$loader->model('user/user_group');

$error = array();

if (isset($_GET['user_group_id'])) {
    $data['user_groups'] = array();

    $user_group_info = _getUserGroupOrError($_GET['user_group_id']);

    if (!is_array($user_group_info)) {
        exit($user_group_info);
    }

    $data['is_edit'] = true;
    $data['action'] = urlLink('user/user_group_form', 'user_group_id=' . $_GET['user_group_id'] . $url);
} else {
    $data['is_edit'] = false;
    $data['action'] = urlLink('user/user_group_form' . $url);
}

$data['cancel'] = urlLink('user/user_group_list' . $url);

if (isMethod('post')) {
    $error = _validateForm();

    if (!$error) {
        if (!empty($user_group_info)) {
            editUserGroup($_GET['user_group_id'], $_POST);
        } else {
            addUserGroup($_POST);
        }

        $document->setFlash('Bạn đã cập nhật thành công !');

        redirect('user/user_group_list' . $url);
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
} elseif (!empty($user_group_info)) {
    $data['name'] = $user_group_info['name'];
} else {
    $data['name'] = '';
}

if (isset($_POST['permission'])) {
    $data['permission'] = $_POST['permission'];
} elseif (!empty($user_group_info)) {
    $data['permission'] = json_decode($user_group_info['permission'], true);
} else {
    $data['permission'] = array();
}

$files = glob(DIR_APP . 'controller/*/*.php');

$data['routes'] = array();

foreach ($files as $file) {
    $path = explode('/', $file);

    $route = $path[count($path) - 2] . '/' . basename($file, '.php');

    if (!in_array($route, $config->get('local.config.ignore'))) {
        $data['routes'][] = $route;
    }
}

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

function _validateForm()
{
    global $user;

    $error = [];

    if (!$user->hasPermission('modify', 'user/user_group_form')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    if (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 40) {
        $error['name'] = 'Tên phải từ 2 cho đến 40 ký tự';
    }

    return $error;
}

function _getUserGroupOrError($user_group_id)
{
    $user_group_info = getUserGroup($user_group_id);

    if ($user_group_info) {
        return $user_group_info;
    } else {
        global $loader;

        $data['header'] = $loader->controller('layout/header');
        $data['footer'] = $loader->controller('layout/footer');

        return $loader->view('error/not_found', $data);
    }
}

echo $loader->view('user/user_group_form', $data);