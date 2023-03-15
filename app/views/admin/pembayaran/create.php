<div>
    <h4 class="text-capitalize">Tambah pembayaran</h4>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_pembayaran/store" method="post">
            <?php
                component('input', [
                    'id' => 'nominal',
                    'label' => 'Nominal',
                    'type' => 'number',
                ]);
                component('input', [
                    'id' => 'tahun_ajaran',
                    'label' => 'Tahun Ajaran',
                    'type' => 'number',
                ]);
            ?>

            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL?>/admin_pembayaran" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>