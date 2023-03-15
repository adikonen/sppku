<?php

importModel('pengguna', 'petugas');

/**
 * handle request with prefix /admin_siswa
 */
class Admin_Petugas extends AdminController
{
    /**
     * only admin have access to run all method
     */
    public function __construct()
    {
        parent::__construct();
        admin_only();
    }

    /**
     * display all petugas
     */
    public function index()
    {
        Petugas::setView('pengguna_petugas_view');
        $data = ['all_petugas' => Petugas::all()];
        return $this->render('petugas/index',$data);
    }

    /**
     * display create petugas form
     */
    public function create()
    {
        return $this->render('petugas/create');
    }
    
    /**
     * display edit petugas form
     */
    public function edit($pengguna_id)
    {
        Petugas::setView('pengguna_petugas_view');
        $data = ['petugas' => Petugas::find($pengguna_id)];
        return $this->render('petugas/edit',$data);
    }

    /**
     * create new pengguna and petugas
     * Error will occured if transaction gone fail and ON_DEVELOPMENT is true
     * @throws Exception
     */
    public function store()
    {
        $request = new Request();

        $username = $request->input('username');
        $password = bcrypt($request->input('password'));
        $nama_petugas = $request->input('nama_petugas');

        $db = new Database;
        
        try {
            $db->beginTransaction();
            Pengguna::create([
                'username' => $username,
                'password' => $password,
                'role' => Role::PETUGAS
            ]);

            $pengguna = Pengguna::findByUsername($username);
            Petugas::create([
                'nama_petugas' => $nama_petugas,
                'pengguna_id' => $pengguna['id']
            ]);
            $db->commit();
        } catch (Exception $err) {
            $db->rollback();
            Flasher::set('danger','Gagal membuat petugas');
            ErrorHandler::log($err, 'create petugas');
            return redirect('admin_petugas');
        }

        Flasher::set('success','Berhasil membuat petugas');
        return redirect('admin_petugas');
    }

    /**
     * update pengguna and petugas
     * Error will ocured if transaction gone fail and ON_DEVELOPMENT is true
     * @param int $pengguna_id
     * @throws Exception
     */
    public function update($pengguna_id)
    {
        $request = new Request();

        $username = $request->input('username');
        $nama_petugas = $request->input('nama_petugas');

        $db = new Database;
        $db->beginTransaction();

        try {
            Pengguna::update($pengguna_id, ['username' => $username]);
            Petugas::update($pengguna_id, ['nama_petugas' => $nama_petugas]);
            $db->commit();
        } catch (Exception $err) {
            $db->rollback();
            Flasher::set('danger','Gagal mengubah petugas');
            ErrorHandler::log($err, 'update petugas', ['id_pengguna' => $pengguna_id]);
            return redirect('admin_petugas');
        }

        Flasher::set('success','Berhasil mengubah petugas');
        return redirect('admin_petugas');
    }

    /**
     * delete petugas and pengguna from id_pengguna
     * Error will occured, when restricted foreign key and ON_DEVELOPMENT is true
     * @param int $pengguna_id
     * @throws Exception
     */
    public function destroy($pengguna_id)
    {
        $user = getLoginAccount();
        if ($pengguna_id == $user['pengguna_id']) {
            Flasher::set('danger', 'Anda tidak dapat menghapus diri anda sendiri.');
            return redirect('admin_petugas');
        }

        try {
            Pengguna::delete($pengguna_id);
        } catch (Exception $err) {
            Flasher::set('danger','Gagal menghapus petugas. petugas ini memiliki relasi dengan data lainnya');
            ErrorHandler::log($err, 'delete petugas',['id_pengguna' => $pengguna_id]);
            return redirect('admin_petugas');
        }

        Flasher::set('success','Berhasil menghapus petugas.');
        return redirect('admin_petugas');
    }
}