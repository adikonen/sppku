<div>
    <h4 class="text-capitalize">Tambah petugas</h4>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_petugas/store" method="post">
            <?php
                component('input', [
                    'id' => 'username',
                    'label' => 'Username'
                ]);
                component('input', [
                    'id' => 'password',
                    'label' => 'Password',
                    'type' => 'password'
                ]);
                component('input',[
                    'id' => 'nama_petugas',
                    'label' => 'Nama Petugas',
                ]);
            ?>

            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL?>/admin_petugas" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>