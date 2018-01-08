<?php

use Intervention\Image\ImageManager;

function resize($filename, $width = 100, $height = 100)
{
    if (!isFile($filename)) {
        return;
    }

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $old_image = $filename;
    $new_image = 'cache/' . substr($filename, 0, strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

    if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
        list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

        if ($width_orig != $width || $height_orig != $height) {
            $path = '';

            $directories = explode('/', dirname(str_replace('../', '', $new_image)));

            foreach ($directories as $directory) {
                $path = $path . '/' . $directory;

                if (!is_dir(DIR_IMAGE . $path)) {
                    @mkdir(DIR_IMAGE . $path);
                }
            }

            $manager = new ImageManager(array('driver' => 'gd'));
            $manager->make(DIR_IMAGE . $old_image)->resize($width, $height)->save(DIR_IMAGE . $new_image);
        } else {
            @copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
        }

        $path = '';

        $directories = explode('/', dirname(str_replace('../', '', $new_image)));

        foreach ($directories as $directory) {
            $path = $path . '/' . $directory;

            if (!is_dir(DIR_IMAGE . $path)) {
                @mkdir(DIR_IMAGE . $path, 0777);
            }
        }

        $manager = new ImageManager(array('driver' => 'gd'));
        $manager->make(DIR_IMAGE . $old_image)->resize($width, $height)->save(DIR_IMAGE . $new_image);
    }

    return HTTP_ROOT . 'resources/upload/image/' . $new_image;
}

function getOrig($filename)
{
    return HTTP_ROOT . 'resources/upload/image/' . $filename;
}

function noImage($width = 100, $height = 100)
{
    global $config;

    return resize($config->get('local.config.no_image', 'no_image.png'), $width, $height);
}

function noAvatar($width = 100, $height = 100)
{
    global $config;

    return resize($config->get('local.config.no_avatar', 'no_avatar.jpg'), $width, $height);
}

function isFile($filename)
{
    return is_file(DIR_IMAGE . $filename);
}