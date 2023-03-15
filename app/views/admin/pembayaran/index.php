<div>
    <div class="d-flex p-3 justify-content-between">
        <h4>Daftar pembayaran</h4>
        <a href="<?= BASE_URL?>/admin_pembayaran/create" class="btn btn-success text-capitalize">Tambah pembayaran</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-capitalize">Data pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-primary">
                Berikut merupakan daftar pembayaran dalam sistem
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nominal</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['all_pembayaran'] as $pembayaran):?>
                            <tr>
                                <td><?= $pembayaran['nominal']?></td>
                                <td><?= $pembayaran['tahun_ajaran']?></td>
                                <td>
                                    <a class="btn btn-warning" href="<?= BASE_URL?>/admin_pembayaran/edit/<?= $pembayaran['id']?>">Edit</a>
                                    <form class="d-inline" action="<?= BASE_URL?>/admin_pembayaran/destroy/<?= $pembayaran['id']?>" method="post">
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