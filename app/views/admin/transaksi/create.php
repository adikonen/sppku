<?php
$tahun_mulai = $data['tahun_mulai'];
$tahun_tengah = $data['tahun_mulai'] +1;
$tahun_akhir = $data['tahun_akhir'];
$tahun_dipilih = $data['tahun_dipilih'];
$siswa = $data['siswa'];
$siswa_id = $data['siswa']['id'];
$pembayaran_id = $data['pembayaran_id'];
?>

<h4>Entry Transaksi</h4>
<div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-capitalize"><?= $siswa['nama_siswa']?></h6>
    </div>
    <div class="card-body">
        <div class="alert alert-primary">
            Nominal Pembayaran untuk tahun <?=printYearSpp($data['tahun_dipilih'])?> adalah <?= $data['nominal']?>
        </div>
        <ul class="nav nav-tabs">
            <?php 
                component('nav-item',[
                    'link' => BASE_URL . "/admin_transaksi/create/$siswa_id/$tahun_mulai",
                    'slot' => printYearSpp($tahun_mulai),
                    'active-when' => $tahun_mulai == $tahun_dipilih
                ]);  
                component('nav-item',[
                    'link' => BASE_URL . "/admin_transaksi/create/$siswa_id/$tahun_tengah",
                    'slot' => printYearSpp($tahun_tengah),
                    'active-when' => $tahun_tengah == $tahun_dipilih
                ]);  
                component('nav-item',[
                    'link' => BASE_URL . "/admin_transaksi/create/$siswa_id/$tahun_akhir",
                    'slot' => printYearSpp($tahun_akhir),
                    'active-when' => $tahun_akhir == $tahun_dipilih
                ]);  
            ?>
        </ul>
        <div class="p-3">
            <?php foreach($data['has_paided'] as $month_num => $month_name):?>
            <div class="badge bg-info text-white p-2">
                <?= $month_name?>
            </div>
            <?php endforeach;?>
        </div>
        <?php if($data['unpaided']):?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['unpaided'] as $month_num => $month_name):?>
                        <tr>
                            <td><?= $month_name?></td>
                            <td>
                                <form action="<?= BASE_URL?>/admin_transaksi/store" method="post">
                                    <input type="hidden" name="bulan_dibayar" value="<?= $month_num?>">
                                    <input type="hidden" name="tahun_dibayar" value="<?= $tahun_dipilih?>">
                                    <input type="hidden" name="siswa_id" value="<?= $siswa_id?>">
                                    <input type="hidden" name="pembayaran_id" value="<?= $pembayaran_id?>">
                                    <button 
                                        type="button" 
                                        onclick="handleClick(this, 'Apakah anda ingin melunaskan Bulan <?= $month_name?>?')" 
                                        class="btn btn-primary"
                                    >
                                        Lunaskan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php else:?>
        <div class="p-3 text-center">
    
            <i class="fa fa-fw fa-check fa-4x text-center text-success"></i> 
            <h4 class="text-center">Siswa ini telah melunaskan semua transaksi tahun <?= printYearSPP($tahun_dipilih)?></h4>
        </div>
        <?php endif;?>
    </div>
</div>