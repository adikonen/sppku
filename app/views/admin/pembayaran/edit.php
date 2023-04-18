<?php $pembayaran = $data['pembayaran'];?>

<div>
    <h4 class="text-capitalize">Edit pembayaran</h4>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_pembayaran/update/<?= $pembayaran['id']?>" method="post">
            <?php
                component('input', [
                    'id' => 'nominal',
                    'label' => 'Nominal',
                    'type' => 'number',
                    'value' => $pembayaran['nominal'],
                    'placeholder' => 250000
                ]);
                component('input', [
                    'id' => 'tahun_ajaran',
                    'label' => 'Tahun Ajaran',
                    'type' => 'number',
                    'value' => $pembayaran['tahun_ajaran'],
                    'placeholder' => 2020
                ]);
            ?>

            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL?>/admin_pembayaran" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>