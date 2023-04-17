<?php

class Controller
{
    /**
     * render view in app/views directory
     * @param string $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
 
    /**
     * get helper
     * @param string $helper
     * @return mixed
     */
    public function helper($helper)
    {
        require_once "../app/helpers/$helper.php";
        return new $helper;
    }
}
