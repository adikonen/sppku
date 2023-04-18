<div>
    <div class="d-flex p-3 justify-content-between">
        <h4>Daftar siswa</h4>
        <a href="<?= BASE_URL?>/admin_siswa/create" class="btn btn-success text-capitalize">Tambah siswa</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-capitalize">Data siswa</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-primary">
                Berikut merupakan daftar siswa dalam sistem
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nis</th>
                            <th>Nama siswa</th>
                            <th>Angkatan</th>
                            <th>Status</th>
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
                                    <a class="btn btn-warning" href="<?= BASE_URL?>/admin_siswa/edit/<?= $siswa['pengguna_id']?>">Edit</a>
                                    <form class="d-inline" action="<?= BASE_URL?>/admin_siswa/destroy/<?= $siswa['pengguna_id']?>" method="post">
                                        <button type="button" class="btn btn-danger" onclick="handleClick(this)">Hapus</a>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>