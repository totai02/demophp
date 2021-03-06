<?php

global $loader, $document, $config;

$document->setTitle($config->get('config_name'));

$data['content_maintop'] = $loader->controller('layout/content_maintop');
$data['content_top'] = $loader->controller('layout/content_top');
$data['column_left'] = $loader->controller('layout/column_left');
$data['column_right'] = $loader->controller('layout/column_right');
$data['content_bottom'] = $loader->controller('layout/content_bottom');
$data['content_mainbottom'] = $loader->controller('layout/content_mainbottom');
$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('common/home', $data);
