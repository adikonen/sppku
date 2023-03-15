<div>
    <div class="d-flex p-3 justify-content-between">
        <h4>Daftar petugas</h4>
        <a href="<?= BASE_URL?>/admin_petugas/create" class="btn btn-success text-capitalize">Tambah petugas</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-capitalize">Data petugas</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-primary">
                Berikut merupakan daftar petugas dalam sistem
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama Petugas</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['all_petugas'] as $petugas):?>
                            <tr>
                                <td><?= $petugas['username']?></td>
                                <td><?= $petugas['nama_petugas']?></td>
                                <td><?= Role::get($petugas['role'])?></td>
                                <td>
                                    <a class="btn btn-warning" href="<?= BASE_URL?>/admin_petugas/edit/<?= $petugas['pengguna_id']?>">Edit</a>
                                    <form class="d-inline" action="<?= BASE_URL?>/admin_petugas/destroy/<?= $petugas['pengguna_id']?>" method="post">
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