<?php

importModel('pengguna','siswa','kelas','pembayaran');
/**
 * handle request with prefix /admin_siswa
 */
class Admin_Siswa extends AdminController
{
    /**
     * @var SiswaHelper
     */
    protected $siswaHelper;

    /**
     * only admin have access to run all method
     */
    public function __construct()
    {
        parent::__construct();
        admin_only();
        $this->siswaHelper = $this->helper('SiswaHelper');
    }

    // private function validateTahunMulai($tahun_ajaran)
    // {
    //     $count = count(Pembayaran::select('tahun_ajaran')
    //         ->whereFor('tahun_ajaran','>', $tahun_ajaran)
    //         ->get());

    //     $error = [$tahun_ajaran + 1, $tahun_ajaran + 2];

    //     if ($count >= 2) {
    //         return ;
    //     }

    //     if ($count == 1) {
    //         array_pop($error);
    //     }

    //     $years = implode(' dan ',$error);

    //     Flasher::set('danger', "Buat data referensi pembayaran dengan angka tahun {$years} terlebih dahulu");
    //     return redirect('admin_pembayaran');
    // }

    /**
     * display siswa tables
     */
    public function index()
    {
        $data = ['all_siswa' => Siswa::all()];
        return $this->render('siswa/index',$data);
    }

    /**
     * display create siswa form
     */
    public function create()
    {
        $data = [
            'all_kelas' => Kelas::all(),
            'all_pembayaran' => Pembayaran::all(),
        ];
        return $this->render('siswa/create', $data);
    }
    
     /**
     * display edit siswa form
     */
    public function edit($pengguna_id)
    {
        Siswa::setView('pengguna_siswa_view');
        
        $data = [
            'siswa' => Siswa::find($pengguna_id),
            'all_kelas' => Kelas::all(),
            'all_pembayaran' => Pembayaran::all(),
        ];
        return $this->render('siswa/edit',$data);
    }

     /**
     * create new pengguna and new siswa
     */
    public function store()
    {
        $request = new Request();

        $nis = $request->input('nis') ?? Siswa::generateNIS();
        $username = $nis;
        $password = bcrypt($request->input('password'));

        $siswa_form = $request->only(
            'nisn', 'nama_siswa','alamat','telepon','kelas_id','tahun_mulai'
        );

        $siswa_form['nis'] = $nis;

        $this->siswaHelper
            ->validateTahunMulai($siswa_form['tahun_mulai'])
            ->validateNisAndNisn($siswa_form['nis'], $siswa_form['nisn']);

        // need pembayaran_id for creating new siswa
        $pembayaran = Pembayaran::select('id')->where(['tahun_ajaran' => $siswa_form['tahun_mulai']])->first();

        $db = new Database;
        $db->beginTransaction();

        try {
            Pengguna::create([
                'username' => $username,
                'password' => $password,
                'role' => Role::SISWA
            ]);

            $pengguna = Pengguna::findByUsername($username);

            $siswa_form['pengguna_id'] = $pengguna['id'];
            $siswa_form['pembayaran_id'] = $pembayaran['id'];
            Siswa::create($siswa_form);
            $db->commit();
        } catch (Exception $err) {
            $db->rollback();
            ErrorHandler::log($err, 'create siswa');
            Flasher::set('danger','Gagal membuat siswa');
            return redirect('admin_siswa');
        }

        Flasher::set('success','Berhasil membuat siswa');
        return redirect('admin_siswa');
    }

    /**
     * update siswa and pengguna
     * Error will occured if the transaction gone fail and ON_DEVELOPMENT is true
     * @param int $pengguna_id
     */
    public function update($pengguna_id)
    {
        $request = new Request();

        $username = $request->input('nis');
        $siswa_form = $request->only('nisn','nis','nama_siswa','alamat','telepon','kelas_id');

        $this->siswaHelper->validateNisAndNisn($siswa_form['nis'], $siswa_form['nisn']);
        
        $db = new Database;
        
        try {
            $db->beginTransaction();
            Pengguna::update($pengguna_id, ['username' => $username]);
            Siswa::update($pengguna_id, $siswa_form);
            $db->commit();
        } catch (Exception $err) {
            $db->rollback();
            ErrorHandler::log($err,'update siswa',['id_pengguna' => $pengguna_id]);
            Flasher::set('danger','Gagal mengubah data siswa');
            return redirect('admin_siswa');
        }

        Flasher::set('success','Berhasil mengubah data siswa');
        return redirect('admin_siswa');
    }

    /**
     * delete siswa and pengguna from id_pengguna
     * Error will occured, when restricted foreign key and ON_DEVELOPMENT is true
     * @param int $pengguna_id
     * @throws Exception
     */
    public function destroy($pengguna_id)
    {
        try {
            Pengguna::delete($pengguna_id);
        } catch (Exception $err) {
            Flasher::set('danger', 'Gagal menghapus siswa, siswa ini memiliki relasi dengan data lainnya');
            ErrorHandler::log($err, 'delete siswa', ['id_pengguna' => $pengguna_id]);
            return redirect('admin_siswa');
        }
        Flasher::set('success','Berhasil menghapus siswa');
        return redirect('admin_siswa');
    }
}