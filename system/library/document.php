<?php

class Document
{
    protected $title = '';
    protected $breadcrumb = array();

    /**
     * Set tiêu đề trang
     *
     * @param $title string
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get tiêu đề trang
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function setBreadcrumb($name, $url = '')
    {
        $this->breadcrumb[] = [
            'name' => $name,
            'url' => $url
        ];
    }

    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    public function setFlash($msg, $level = 'success')
    {
        $_SESSION['flash'] = [
            'message' => $msg,
            'level' => $level
        ];
    }

    public function getFlash()
    {
        if (isset($_SESSION['flash'])) {
            return $_SESSION['flash'];
        } else {
            return false;
        }
    }

    public function destroyFlash()
    {
        if (isset($_SESSION['flash'])) {
            unset($_SESSION['flash']);
        }
    }
}