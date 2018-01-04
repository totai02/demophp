<?php

global $loader, $config, $user, $document;

$data['heading_title'] = $document->getTitle();

$data['username'] = $user->getUsername();
$data['breadcrumbs'] = $document->getBreadcrumb();

$flash_info = $document->getFlash();

if ($flash_info) {
    $data['flash'] = $flash_info;

    $document->destroyFlash();
}

echo $loader->view('layout/header', $data);