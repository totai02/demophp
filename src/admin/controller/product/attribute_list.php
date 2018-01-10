<?php

global $loader, $user, $document, $config;

$document->setTitle('Màu sản phẩm');
$document->setBreadcrumb('Màu sản phẩm');

$url = '';

if (isset($_GET['page'])) {
    $url .= '&page=' . (int)$_GET['page'];
}

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$loader->model('product/attribute');

$data['attributes'] = array();

$filter_data = array(
    'start' => ($page - 1) * $config->get('local.config.limit_admin'),
    'limit' => $config->get('local.config.limit_admin')
);

$attribute_total = getTotalAttribute();

$results = getAttributes($filter_data);

foreach ($results as $result) {
    $data['attributes'][] = array(
        'attribute_id' => $result['attribute_id'],
        'name'    => $result['name'],
        'edit'    => urlLink('product/attribute_form', 'attribute_id=' . $result['attribute_id'] . $url)
    );
}

$data['add'] = urlLink('product/attribute_form' . $url);
$data['delete'] = urlLink('product/attribute_delete' . $url);

$pagination = new Pagination();
$pagination->total = $attribute_total;
$pagination->page = $page;
$pagination->limit = $config->get('local.config.limit_admin');
$pagination->url = urlLink('product/attribute_list', '&page={page}');
$data['pagination'] = $pagination->render();

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('product/attribute_list', $data);