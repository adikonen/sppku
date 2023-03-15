<?php $siswa = $data['siswa'];?>
<div>
    <div class="d-flex p-3 justify-content-between">
        <h4>Daftar Transaksi</h4>
        <a href="<?= BASE_URL?>/admin_transaksi/create/<?= $siswa['id']?>" class="btn btn-info text-capitalize">Entry Transaksi</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-capitalize"><?= $siswa['nama_siswa']?></h6>
        </div>
        <div class="card-body">
            <div class="alert alert-primary">
                Berikut merupakan history transaksi siswa dalam sistem
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Bulan Dibayar</th>
                            <th>Tahun Dibayar</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['all_transaksi'] as $transaksi):?>
                            <tr>
                                <td><?= Month::getName($transaksi['bulan_dibayar'])?></td>
                                <td><?= printYearSPP($transaksi['tahun_dibayar'])?></td>
                                <td><?= $transaksi['tanggal_bayar']?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>