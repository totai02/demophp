<?php

global $loader, $user, $document, $config;

$document->setTitle('Tài khoản');
$document->setBreadcrumb('DS Tài khoản');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$loader->model('user/user');

$data['users'] = array();

$filter_data = array(
    'start' => ($page - 1) * $config->get('local.config.limit_admin'),
    'limit' => $config->get('local.config.limit_admin')
);

$user_group_total = getTotalUser();

$results = getUsers($filter_data);

$loader->model('user/user_group');

foreach ($results as $result) {
    $data['users'][] = array(
        'user_id'       => $result['user_id'],
        'username'      => $result['username'],
        'user_group_id' => $result['user_group_id'],
        'user_group'    => getUserGroup($result['user_group_id'])['name'],
        'status'        => $result['status'],
        'edit'          => urlLink('user/user_form', 'user_id=' . $result['user_id'] . $url)
    );
}

$data['add'] = urlLink('user/user_form' . $url);
$data['delete'] = urlLink('user/user_delete' . $url);


$pagination = new Pagination();
$pagination->total = $user_group_total;
$pagination->page = $page;
$pagination->limit = $config->get('local.config.limit_admin');
$pagination->url = urlLink('user/user_list', '&page={page}');
$data['pagination'] = $pagination->render();

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('user/user_list', $data);