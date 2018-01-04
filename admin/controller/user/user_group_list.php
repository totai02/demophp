<?php

global $loader, $user, $document;

$document->setTitle('Nhóm tài khoản');
$document->setBreadcrumb('Nhóm tài khoản');

$loader->model('user/user_group');

$data['user_groups'] = array();

$results = getUserGroups();

foreach ($results as $result) {
    $data['user_groups'][] = array(
        'user_group_id' => $result['user_group_id'],
        'name'          => $result['name'],
        'edit'          => urlLink('user/user_group_form', 'user_group_id=' . $result['user_group_id'])
    );
}

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('user/user_group_list', $data);