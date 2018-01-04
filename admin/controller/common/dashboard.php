<?php

global $loader, $user;

$data['dashboard_url'] = urlLink('common/dashboard');

$data['logout'] = urlLink('auth/logout');
$data['pagename'] = 'Dashboard';

$data['header'] = $loader->controller('layout/header');
$data['footer'] = $loader->controller('layout/footer');

echo $loader->view('common/dashboard', $data);