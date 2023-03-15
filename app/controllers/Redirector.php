<?php

importModel('Kelas');

/**
 * handle request with prefix / or /redirector
 */
class Redirector extends Controller
{
    /**
     * redirect user corresponding their own role
     */
    public function index()
    {
        $user = getLoginAccount();
        if ($user == null) {
            Flasher::set('danger','Mohon login terlebih dahulu.');
            return redirect('login');
        }

        if ($user['role'] == Role::SISWA) {
            return redirect('saya');
        }

        return redirect('admin');
    }
}