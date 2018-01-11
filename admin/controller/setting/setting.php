<?php

global $loader, $user, $config, $document;

$loader->model('setting/setting');
$loader->model('tool/image');

$document->setTitle('Setting');

$document->setBreadcrumb('Setting', urlLink('setting/setting'));

$data['dashboard_url'] = urlLink('common/dashboard');

$setting_info = getSetting('config');

if (isMethod('post')) {
    editSetting($_POST, 'config');

    $document->setFlash('Bạn đã cập nhật thành công !');

    redirect('setting/setting');
}

$data['no_image'] = noImage();

if (isset($_POST['config_name'])) {
    $data['config_name'] = $_POST['config_name'];
} elseif (isset($setting_info['config_name'])) {
    $data['config_name'] = $setting_info['config_name'];
} else {
    $data['config_name'] = '';
}

if (isset($_POST['config_owner'])) {
    $data['config_owner'] = $_POST['config_owner'];
} elseif (isset($setting_info['config_owner'])) {
    $data['config_owner'] = $setting_info['config_owner'];
} else {
    $data['config_owner'] = '';
}

if (isset($_POST['config_email'])) {
    $data['config_email'] = $_POST['config_email'];
} elseif (isset($setting_info['config_email'])) {
    $data['config_email'] = $setting_info['config_email'];
} else {
    $data['config_email'] = '';
}

if (isset($_POST['config_phone'])) {
    $data['config_phone'] = $_POST['config_phone'];
} elseif (isset($setting_info['config_phone'])) {
    $data['config_phone'] = $setting_info['config_phone'];
} else {
    $data['config_phone'] = '';
}

if (isset($_POST['config_logo'])) {
    $data['config_logo'] = $_POST['config_logo'];
} elseif (isset($setting_info['config_logo'])) {
    $data['config_logo'] = $setting_info['config_logo'];
} else {
    $data['config_logo'] = '';
}

if (isFile($data['config_logo'])) {
    $data['thumb_logo'] = resize($data['config_logo']);
} else {
    $data['thumb_logo'] = noImage();
}

if (isset($_POST['config_icon'])) {
    $data['config_icon'] = $_POST['config_icon'];
} elseif (isset($setting_info['config_icon'])) {
    $data['config_icon'] = $setting_info['config_icon'];
} else {
    $data['config_icon'] = '';
}

if (isFile($data['config_icon'])) {
    $data['thumb_icon'] = resize($data['config_icon']);
} else {
    $data['thumb_icon'] = noImage();
}

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

// config_name
// config_owner
// config_title
// config_description
// config_phone
// config_email
// config_address


echo $loader->view('setting/setting', $data);