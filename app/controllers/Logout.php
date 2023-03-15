<?php

/**
 * handle request with prefix /logout
 */
class Logout extends Controller
{
    /**
     * remove $_SESSION['user']
     */
    public function index()
    {
        unset($_SESSION['user']);
        Flasher::set('success','Anda telah logout dari sistem.');
        return redirect('login');
    }
}