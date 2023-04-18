<div>
    <div class="d-flex p-3 justify-content-between">
        <h4>Daftar Transaksi</h4>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-capitalize">Data siswa</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-primary">
                Klik tombol entry untuk melakukan entry pembayaran pada siswa yang dipilih
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nis</th>
                            <th>Nama siswa</th>
                            <td>Angkatan</td>
                            <th>Lunas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['all_siswa'] as $siswa):?>
                            <tr>
                                <td><?= $siswa['nis']?></td>
                                <td><?= $siswa['nama_siswa']?></td>
                                <td><?= $siswa['tahun_mulai']?></td>
                                <td>
                                    <?= $siswa['sudah_lunas'] 
                                        ? component('icon/done', ['size' => 2]) 
                                        : component('icon/flag', ['size' => 2]);
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="<?= BASE_URL?>/admin_transaksi/create/<?= $siswa['id']?>/<?= $siswa['tahun_mulai']?>">Entry</a>
                                    <a class="btn btn-success" href="<?= BASE_URL?>/admin_transaksi/history/<?= $siswa['id']?>">History</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>