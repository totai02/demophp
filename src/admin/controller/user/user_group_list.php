<?php

global $loader, $user, $document, $config;

$document->setTitle('Nhóm tài khoản');
$document->setBreadcrumb('Nhóm tài khoản');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$loader->model('user/user_group');

$data['user_groups'] = array();

$filter_data = array(
    'start' => ($page - 1) * $config->get('local.config.limit_admin'),
    'limit' => $config->get('local.config.limit_admin')
);

$user_group_total = getTotalUserGroup();

$results = getUserGroups($filter_data);

foreach ($results as $result) {
    $data['user_groups'][] = array(
        'user_group_id' => $result['user_group_id'],
        'name'          => $result['name'],
        'edit'          => urlLink('user/user_group_form', 'user_group_id=' . $result['user_group_id'] . $url)
    );
}

$data['add'] = urlLink('user/user_group_form' . $url);
$data['delete'] = urlLink('user/user_group_delete' . $url);

$pagination = new Pagination();
$pagination->total = $user_group_total;
$pagination->page = $page;
$pagination->limit = $config->get('local.config.limit_admin');
$pagination->url = urlLink('user/user_group_list', '&page={page}');
$data['pagination'] = $pagination->render();

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('user/user_group_list', $data);