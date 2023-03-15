<?php $siswa = $data['siswa'];?>
<div>
    <h4 class="text-capitalize">Edit siswa</h4>
    <div class="card p-3">
    <div class="alert alert-primary">
            Pastikan input nis dan nisn unik dari siswa lainnya
        </div>
        <form action="<?= BASE_URL?>/admin_siswa/update/<?= $siswa['pengguna_id']?>" method="post">
            <?php
                component('input', [
                    'id' => 'nis',
                    'label' => 'Nis',
                    'type' => 'number',
                    'value' => $siswa['nis'] 
                ]);
                component('input',[
                    'id' => 'nama_siswa',
                    'label' => 'Nama Siswa',
                    'value' => $siswa['nama_siswa'],
                ]);
                component('input',[
                    'id' => 'nisn',
                    'label' => 'Nisn',
                    'type' => 'number',
                    'value' => $siswa['nisn'],
                ]);
                component('input',[
                    'id' => 'telepon',
                    'label' => 'Telepon',
                    'type' => 'number',
                    'value' => $siswa['telepon'],
                ]);
                component('input',[
                    'id' => 'alamat',
                    'label' => 'Alamat',
                    'value' => $siswa['telepon']
                ]);
            ?>
            <div class="mb-3">
                <label for="kelas_id" class="form-label">
                    Kelas
                </label>
                <select name="kelas_id" id="kelas_id" class="form-control">
                    <?php foreach($data['all_kelas'] as $kelas):?>
                        <option 
                            value="<?= $kelas['id']?>"
                            <?php if($kelas['id'] == $siswa['kelas_id']):?> selected <?php endif;?> 
                        >
                            <?= $kelas['nama_kelas']?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="mb-3">
                <label for="pembayaran_id" class="form-label">
                    Pembayaran (otomatis bertambah jika transaksi sudah lunas)
                </label>
                <select name="pembayaran_id" id="pembayaran_id" class="form-control" disabled>
                    <?php foreach($data['all_pembayaran'] as $pembayaran):?>
                        <option 
                            value="<?= $pembayaran['id']?>" 
                            <?php if($pembayaran['id'] == $siswa['pembayaran_id']):?> selected <?php endif;?>
                        >
                            <?= printYearSPP($pembayaran['tahun_ajaran'])?> - <?= $pembayaran['nominal']?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL?>/admin_siswa" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>