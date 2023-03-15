<?php

importModel('transaksi','siswa','pembayaran');

/**
 * handle request with prefix /saya
 */
class Saya extends SiswaController
{
    /**
     * display siswa dashboard
     */
    public function index()
    {
        $user = getLoginAccount();
        
        $siswa = Siswa::find($user['pengguna_id']);
        
        $tahun_mulai = $siswa['tahun_mulai'];

     
        // get all_pembayaran for loggedin siswa
        $all_pembayaran = Pembayaran::forSiswa($tahun_mulai);
        $result = [];

        // next select query will use transaksi_pembayaran_view
        Transaksi::setView('transaksi_pembayaran_view');
        
        foreach ($all_pembayaran as $pembayaran) {
            $count = Transaksi::select('bulan_dibayar')->where([
                'tahun_ajaran' => $pembayaran['tahun_ajaran'],
                'siswa_id' => $siswa['id']
            ])->rowCount();
            if ($count >= 12) {
                $pembayaran['is_done'] = true;  
                $pembayaran['description'] = 'Telah lunas';
            } else {
                $pembayaran['is_done'] = false;
                $pembayaran['description'] = 'Belum lunas';
            }
            $result[] = $pembayaran;
        }

        $currentTahunAjaran = Siswa::getCurrentTahunAjaran($siswa['id']);

        $data = ['all_pembayaran' => $result, 'current_tahun_ajaran' => $currentTahunAjaran];
        return $this->render('dashboard/index', $data);
    }

    /**
     * display history transaksi for loggedin siswa
     */
    public function history_transaksi()
    {
        $siswa_id = getLoginAccount()['id'];
        $all_transaksi = Transaksi::select('*')
            ->where(['siswa_id' => $siswa_id])
            ->get();

        Siswa::setPrimaryKey('id');
        $data = [
            'all_transaksi' => $all_transaksi,
            'siswa' => Siswa::find($siswa_id)
        ];

        return $this->render('history-transaksi/index', $data);
    }
}