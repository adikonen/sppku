<div>
    <h4 class="text-capitalize">Tambah Kelas</h4>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_kelas/store" method="post">
            <?php
                component('input', [
                    'id' => 'nama_kelas',
                    'label' => 'Nama Kelas'
                ]);
                component('input', [
                    'id' => 'kompetensi_keahlian',
                    'label' => 'Kompetensi Keahlian'
                ]);
            ?>

            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL?>/admin_kelas" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>