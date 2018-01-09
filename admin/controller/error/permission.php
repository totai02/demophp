<?php

global $loader, $document;

$document->setTitle('Không có quyền truy cập');

$document->setBreadcrumb('Không có quyền truy cập', urlLink('error/permission'));

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('error/permission', $data);