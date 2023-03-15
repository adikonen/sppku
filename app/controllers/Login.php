<?php

importModel('pengguna','siswa','petugas');

/**
 * handle request with prefix /login
 */
class Login extends Controller
{
    /**
     * display login view
     */
    public function index()
    {
        $this->view('login/index');
    }

    /**
     * authenticate user with their input
     * this will set $_SESSION['user'] with pengguna table
     */
    public function store()
    {
        $request = new Request();
        $username = $request->input('username');        
        $password = $request->input('password'); 

        $pengguna = Pengguna::findByUsername($username);
        if (! $pengguna) {
            Flasher::set('danger','username atau password tidak cocok. ');
            return redirect('login');
        }

        $isPasswordValid = password_verify($password, $pengguna['password']);
        if (!$isPasswordValid) {
            Flasher::set('danger','username atau password tidak cocok. ');
            return redirect('login');            
        }
        
        if ($pengguna['role'] == Role::SISWA) {
            $siswa = Siswa::find($pengguna['id']);            
            $pengguna = array_merge($pengguna, $siswa);
        } else {
            $petugas = Petugas::find($pengguna['id']);
            $pengguna = array_merge($pengguna, $petugas);
        }

        login($pengguna);
        return redirect('redirector');
    }
}
