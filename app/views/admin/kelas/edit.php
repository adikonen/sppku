<?php $kelas = $data['kelas'];?>

<div>
    <h4 class="text-capitalize">Edit Kelas</h4>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_kelas/update/<?= $kelas['id']?>" method="post">
            <?php
                component('input', [
                    'id' => 'nama_kelas',
                    'label' => 'Nama Kelas',
                    'value' => $kelas['nama_kelas']
                ]);
                component('input', [
                    'id' => 'kompetensi_keahlian',
                    'label' => 'Kompetensi Keahlian',
                    'value' => $kelas['kompetensi_keahlian']
                ]);
            ?>

            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL?>/admin_kelas" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>