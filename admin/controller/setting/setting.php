<?php

global $loader, $user, $config, $document;

$loader->model('setting/setting');

$document->setTitle('Setting');

$document->setBreadcrumb('Setting', urlLink('setting/setting'));
$document->setBreadcrumb('Setting 2');

$data['dashboard_url'] = urlLink('common/dashboard');

$setting_info = getSetting('config');

if(isMethod('post')){
    editSetting($_POST, 'config');

    $document->setFlash('Bạn đã cập nhật thành công !');

    redirect('setting/setting');
}

$list_key = array(
    'config_name', 'config_owner', 'config_demo'
);

foreach ($list_key as $key){
    if(isset($setting_info[$key])){
        $data[$key] = $setting_info[$key];
    } else {
        $data[$key] = '';
    }
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