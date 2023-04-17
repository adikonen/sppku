<?php

importModel('siswa','transaksi','pembayaran');

/**
 * handle request with prefix /admin_transaksi
 */
class Admin_Transaksi extends AdminController
{
    /**
     * display all siswa 
     */
    public function index()
    {
        $data = [
            'all_siswa' => Siswa::all()
        ];

        return $this->render('transaksi/index',$data);
    }

    /**
     * display all history transaksi siswa
     * @param int $siswa_id
     */
    public function history($siswa_id)
    {
        Siswa::setPrimaryKey('id');
        $all_transaksi = Transaksi::select('*')
            ->where(['siswa_id' => $siswa_id])
            ->get();

        $data = [
            'all_transaksi' => $all_transaksi,
            'siswa' => Siswa::find($siswa_id)
        ];

        return $this->render('transaksi/history', $data);
    }

    /**
     * display view for create new transaksi
     */
    public function create($siswa_id, $tahun_ajaran = null)
    {
        Siswa::setPrimaryKey('id');
        $siswa = Siswa::find($siswa_id);

        if ($tahun_ajaran == null) {
            $tahun_ajaran = $siswa['tahun_mulai'];
        }

        Transaksi::setView('transaksi_pembayaran_view');

        $tahun_mulai = $siswa['tahun_mulai'];
        $tahun_akhir = $siswa['tahun_mulai'] + 2;

        if ($tahun_ajaran < $tahun_mulai) {
            Flasher::set('danger',"Siswa tersebut mulai pada tahun $tahun_mulai");
            return redirect('admin_transaksi');
        }

        if ($tahun_ajaran > $tahun_akhir) {
            Flasher::set('danger', "Siswa tersebut tamat pada tahun $tahun_akhir");
            return redirect('admin_transaksi');
        }
        
        $all_month = Month::allNum();
        $hasPaided = Transaksi::select('bulan_dibayar')->where([
            'siswa_id' => $siswa_id,
            'tahun_ajaran' => $tahun_ajaran
        ])
        ->flat();

        $select_month = [
            'has_paided' => [],
            'unpaided' => []
        ];
        
        foreach ($all_month as $month) {
            if (in_array($month, $hasPaided)) {
                $select_month['has_paided'][$month] = Month::getName($month);
            } else {
                $select_month['unpaided'][$month] = Month::getName($month);
            }
        }

        $nominal = Transaksi::getNominal($tahun_ajaran);

        $pembayaran = Pembayaran::select('id')->where(['tahun_ajaran' => $tahun_ajaran])->first();
        $data = [
            'has_paided' => $select_month['has_paided'],
            'unpaided' => $select_month['unpaided'],
            'siswa' => $siswa,
            'tahun_mulai' => $tahun_mulai,
            'tahun_akhir' => $tahun_akhir,
            'nominal' => $nominal,
            'tahun_dipilih' => $tahun_ajaran,
            'pembayaran_id' => $pembayaran['id']
        ];
        return $this->render('transaksi/create', $data);
    }

    /**
     * create new transaksi
     */
    public function store()
    {
        $user = getLoginAccount();
        $request = new Request();
        $form = $request->only('bulan_dibayar','tahun_dibayar','siswa_id','pembayaran_id');
        $form['tanggal_bayar'] = date('Y-m-d H:i:s');
        $form['petugas_id'] = $user['id'];

        Siswa::setPrimaryKey('id');
        $siswa = Siswa::find($form['siswa_id']);
        $tahun_ajaran = Siswa::getCurrentTahunAjaran($form['siswa_id']);

        if ($form['pembayaran_id'] > $siswa['pembayaran_id']) {
            $text = printYearSPP($tahun_ajaran);
            Flasher::set('danger', "Mohon lunaskan spp tahun {$text}");
            return redirect("admin_transaksi/create/{$form['siswa_id']}/$tahun_ajaran");
        }

        try {
            Transaksi::create($form);
                
            Transaksi::setView('transaksi_pembayaran_view');
            $count = Transaksi::select('bulan_dibayar')->where([
                'tahun_ajaran' => $tahun_ajaran,
                'siswa_id' => $form['siswa_id']
            ])
            ->rowCount();
    
            if ($count >= 12) {
                // count siswa transaction on all years
                $year_count = Transaksi::select('bulan_dibayar')->where(['siswa_id' => $form['siswa_id']])->rowCount();
                
                // next query will use siswa.id instead id_pengguna
                Siswa::setPrimaryKey('id');

                if ($year_count < 36) {
                    Siswa::update($form['siswa_id'], [
                        'pembayaran_id' => Pembayaran::nextId($tahun_ajaran)
                    ]);
                } else {
                    // set sudah lunas to true cause he has paid all month in 3 years
                    Siswa::update($form['siswa_id'], [
                        'sudah_lunas' => true
                    ]);
                }
            }
        } catch (Exception $err) {
            Flasher::set('danger', 'Gagal membuat transaksi');
            ErrorHandler::log($err, 'create transaksi', $form);
            return redirect('admin_transaksi/index');
        }

        Flasher::set('success','Berhasil membuat transaksi.');
        return redirect("admin_transaksi/create/{$form['siswa_id']}/$tahun_ajaran");
    }
}