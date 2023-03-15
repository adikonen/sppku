<?php

class AdminController extends Controller implements RenderContent
{
    /**
     *  only admin or petugas can access admin pages
     */
    public function __construct()
    {
        staff_only();
    }

    /**
     * @inheritDoc
     */
    public function render(string $view, array $data = [])
    {
        parent::view('templates/admin/header');
        parent::view("admin/$view", $data);
        parent::view('templates/admin/footer');
    }
}