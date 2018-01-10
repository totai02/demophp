<?php

global $loader, $user;

if (isset($_GET['action']) && $_GET['extension']) {
    $getAct = $_GET['action'];

    if ($getAct == 'install') {
        $error = _validateForm();

        if (!$error) {
            $loader->model('setting/extension');

            install('module', $_GET['extension']);

            $loader->model('user/user_group');

            addPermission($user->getGroupId(), 'access', 'module/' . $_GET['extension']);
            addPermission($user->getGroupId(), 'modify', 'module/' . $_GET['extension']);

            $document->setFlash('Bạn đã cài đặt thành công !');

            redirect('extension/module');
        }
    } elseif ($getAct == 'uninstall') {
        $error = _validateForm();

        if (!$error) {
            $loader->model('setting/extension');

            uninstall('module', $_GET['extension']);

            $document->setFlash('Bạn đã gỡ cài đặt thành công !');

            redirect('extension/module');
        }
    } else {
        $document->setFlash('Action không đúng !', 'error');

        redirect('extension/module');
    }
} else {
    $document->setTitle('Mô-đun');

    $document->setBreadcrumb('Mô-đun', urlLink('extension/module'));

    $loader->model('setting/extension');

    $extensions = getInstalled('module');

    foreach ($extensions as $key => $value) {
        if (!file_exists(DIR_APP . 'controller/module/' . $value . '.php')) {
            uninstall('module', $value);

            unset($extensions[$key]);
        }
    }

    $data['extensions'] = array();

    $files = glob(DIR_APP . 'controller/module/*.php');

    if ($files) {
        foreach ($files as $file) {
            $extension = basename($file, '.php');

            $info = getInfo($extension, 'module');

            $data['extensions'][] = array(
                'name'      => !empty($info['name']) ? $info['name'] : $extension,
                'install'   => urlLink('extension/module', 'action=install&extension=' . $extension),
                'uninstall' => urlLink('extension/module', 'action=uninstall&extension=' . $extension),
                'installed' => in_array($extension, $extensions),
                'info'      => $info,
                'edit'      => urlLink('module/' . $extension)
            );
        }
    }

    $data['header'] = $loader->controller('layout/header');
    $data['footer'] = $loader->controller('layout/footer');

    echo $loader->view('extension/module', $data);
}

function _validateForm()
{
    global $user;

    $error = [];

    if (!$user->hasPermission('modify', 'extension/module')) {
        $error['warning'] = 'Bạn không có quyền chỉnh sửa trang này';
    }

    return $error;
}