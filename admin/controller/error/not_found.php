<?php

global $loader, $document;

$document->setTitle('404 Not Found');

$document->setBreadcrumb('404 Not Found', urlLink('error/not_found'));

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('error/not_found', $data);