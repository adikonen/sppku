<?php

class SiswaController extends Controller implements RenderContent
{
    /**
     *  only siswa can access siswa pages
     */
    public function __construct()
    {
        siswa_only();
    }
    
    /**
     * @inheritDoc
     */
    public function render(string $view, array $data = [])
    {
        parent::view('templates/siswa/header');
        parent::view("siswa/$view",$data);
        parent::view('templates/siswa/footer');
    }
}