<?php

importModel('petugas','siswa', 'transaksi');

/**
 * handle request with prefix /admin
 */
class Admin extends AdminController
{
    /**
     * display admin dashboard
     */
    public function index()
    {
        $petugas_count = Petugas::count();
        $siswa_count = Siswa::count();

        $data = [
            'petugas_count' => $petugas_count,
            'siswa_count' => $siswa_count,
            'pengguna_count' => $petugas_count + $siswa_count,
        ];

        TemplateView::addScriptsSource(
            'vendor/chart.js/Chart.js',
        );

        TemplateView::addComponent('footer', 'charts/dashboard', [
            'chart_json' => json_encode(Transaksi::getChartData())
        ]);

        return $this->render('dashboard/index', $data);
    }

    /**
     * display annual earning report spp
     */
    public function laporan($tahun)
    {
        admin_only();
        Transaksi::setView('transaksi_pembayaran_view');

        $all_month = Month::allNum();
        $db = new Database;
        $result = array_map(function($item) use($tahun) {
            $total = Transaksi::select('SUM(nominal) AS total')->where([
                'tahun_dibayar' => $tahun,
                'bulan_dibayar' => $item
            ])->first()['total'];

            return [
                'name' => Month::getName($item),
                'num' => $item,
                'income' => $total 
            ];
        },$all_month);

        $year_income = 0;
        foreach ($result as $r) {
            $year_income += $r['income'];
        }
        
        $transaksi_count = Transaksi::countData($tahun);
        
        $data = [
            'all_month' => $result,
            'transaksi_count' => $transaksi_count,
            'year_income' => $year_income,
            'tahun_ajaran' => $tahun
        ];
        
        return $this->view('admin/laporan/index', $data);
    }

    // public function api_chart()
    // {
    //     echo json_encode(Transaksi::getChartData());
    // }
}