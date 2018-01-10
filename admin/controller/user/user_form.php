<?php

global $loader, $user, $document, $config;

$document->setTitle('Tài khoản');
$document->setBreadcrumb('Tài khoản');
$document->setBreadcrumb('Thêm tài khoản');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

$loader->model('user/user');
$loader->model('user/user_group');

$error = array();

if (isset($_GET['user_id'])) {
    $data['users'] = array();

    $user_info = _getUserOrError($_GET['user_id']);

    if (!is_array($user_info)) {
        exit($user_info);
    }

    $data['is_edit'] = true;
    $data['action'] = urlLink('user/user_form', 'user_id=' . $_GET['user_id'] . $url);
} else {
    $data['is_edit'] = false;
    $data['action'] = urlLink('user/user_form' . $url);
}

$data['cancel'] = urlLink('user/user_list' . $url);

if (isMethod('post')) {
    $error = _validateForm();

    if (!$error) {
        if (!empty($user_info)) {
            //editUser($_GET['user_id'], $_POST);
        } else {
            addUser($_POST);
        }

        $document->setFlash('Bạn đã cập nhật thành công !');

        redirect('user/user_list' . $url);
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
} elseif (!empty($user_info)) {
    $data['name'] = $user_info['username'];
} else {
    $data['name'] = '';
}

if (isset($_POST['status'])) {
    $data['status'] = $_POST['status'];
} elseif (!empty($user_info)) {
    $data['status'] = $user_info['status'];
} else {
    $data['status'] = '';
}

if (isset($_POST['user_group_id'])) {
    $data['user_group_id'] = $_POST['user_group_id'];
} elseif (!empty($user_info)) {
    $data['user_group_id'] = $user_info['user_group_id'];
} else {
    $data['user_group_id'] = '';
}

$data['user_groups'] = array();
$results = getUserGroups();

foreach ($results as $result) {
    $data['user_groups'][] = array(
        'user_group_id' => $result['user_group_id'],
        'name'          => $result['name'],
    );
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

    if (!$user->hasPermission('modify', 'user/user_form')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    if (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 40) {
        $error['name'] = 'Tên phải từ 2 cho đến 40 ký tự';
    }

    return $error;
}

function _getUserOrError($user_id)
{
    $user_info = getUser($user_id);

    if ($user_info) {
        return $user_info;
    } else {
        global $loader;

        $data['header'] = $loader->controller('layout/header');
        $data['footer'] = $loader->controller('layout/footer');

        return $loader->view('error/not_found', $data);
    }
}

echo $loader->view('user/user_form', $data);