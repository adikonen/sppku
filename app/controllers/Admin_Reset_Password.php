<?php

importModel('pengguna');

class Admin_Reset_Password extends AdminController
{
    protected PenggunaHelper $penggunaHelper;

    public function __construct()
    {
        parent::__construct();
        $this->penggunaHelper = $this->helper('PenggunaHelper');
    }

    public function index()
    {
        return $this->render('reset-password/index');
    }
    
    public function store()
    {
        $request = new Request();

        $form = $request->only('password','new_password','password_confirmation');
        
        $user = getLoginAccount();

        Flasher::set('success', 'Berhasil mengubah password');

        if (! $this->penggunaHelper->isPasswordMatch($form['new_password'], $form['password_confirmation']))
        {
            Flasher::set('danger','Password Baru dan Konfirmasi password harus sama');
            return redirect('admin_reset_password');
        }

        if(! $this->penggunaHelper->isEnterCorrectPassword($form['password'])) 
        {
            Flasher::set('danger','Password lama yang anda masukan tidak sama dengan password akun anda');
            return redirect('admin_reset_password');
        }
        
        Pengguna::update($user['pengguna_id'], ['password' => bcrypt($form['new_password'])]);
        return redirect('admin_reset_password');

    }
}