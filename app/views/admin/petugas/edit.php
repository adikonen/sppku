<?php $petugas = $data['petugas'];?>

<div>
    <h4 class="text-capitalize">Edit petugas</h4>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_petugas/update/<?= $petugas['pengguna_id']?>" method="post">
            <?php
                component('input', [
                    'id' => 'username',
                    'label' => 'Username',
                    'value' => $petugas['username']
                ]);
                component('input',[
                    'id' => 'nama_petugas',
                    'label' => 'Nama Petugas',
                    'value' => $petugas['nama_petugas']
                ]);
            ?>

            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL?>/admin_petugas" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>