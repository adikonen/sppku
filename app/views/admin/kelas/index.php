<div>
    <div class="d-flex p-3 justify-content-between">
        <h4>Daftar Kelas</h4>
        <a href="<?= BASE_URL?>/admin_kelas/create" class="btn btn-success text-capitalize">Tambah Kelas</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-capitalize">Data Kelas</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-primary">
                Berikut merupakan daftar kelas dalam sistem
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['all_kelas'] as $kelas):?>
                            <tr>
                                <td><?= $kelas['nama_kelas']?></td>
                                <td><?= $kelas['kompetensi_keahlian']?></td>
                                <td>
                                    <a class="btn btn-warning" href="<?= BASE_URL?>/admin_kelas/edit/<?= $kelas['id']?>">Edit</a>
                                    <form class="d-inline" action="<?= BASE_URL?>/admin_kelas/destroy/<?= $kelas['id']?>" method="post">
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