<div>
    <h4 class="text-capitalize">Tambah siswa</h4>
    <button class="btn btn-primary mb-3" id="btn-nis">Input NIS <span id="nis-text">Manual</span></button>
    <div class="card p-3">
        <div class="alert alert-primary">
            Mohon input nis dan nisn yang unik
        </div>
        <form action="<?= BASE_URL?>/admin_siswa/store" method="post">
            <?php
                component('input', [
                    'id' => 'nis',
                    'label' => 'Nis',
                    'type' => 'number',
                    'is-hide' => true,
                    'disabled' => true,
                ]);
                component('input',[
                    'id' => 'nama_siswa',
                    'label' => 'Nama Siswa',
                ]);
                component('input', [
                    'id' => 'password',
                    'label' => 'Password',
                    'type' => 'password'
                ]);
                component('input',[
                    'id' => 'nisn',
                    'label' => 'Nisn',
                    'type' => 'number',
                ]);
                component('input',[
                    'id' => 'telepon',
                    'label' => 'Telepon',
                    'type' => 'number',
                ]);
                component('input',[
                    'id' => 'alamat',
                    'label' => 'Alamat',
                ]);
                component('input',[
                    'id' => 'tahun_mulai',
                    'label' => 'Tahun Mulai (angkatan)',
                    'type' => 'number',
                    'slot' => 'Pastikan tahun mulai yang anda masukan, Tahun Ajaran SPP sudah ada'
                ]);
            ?>
            <div class="mb-3">
                <label for="kelas_id" class="form-label">
                    Kelas
                </label>
                <select name="kelas_id" id="kelas_id" class="form-control select2" style="width: 100%;">
                    <?php foreach($data['all_kelas'] as $kelas):?>
                        <option value="<?= $kelas['id']?>">
                            <?= $kelas['nama_kelas']?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            <!-- <div class="mb-3">
                <label for="pembayaran_id" class="form-label">
                    Pembayaran
                </label>
                <select name="pembayaran_id" id="pembayaran_id" class="form-control">
                    <?php foreach($data['all_pembayaran'] as $pembayaran):?>
                        <option value="<?= $pembayaran['id']?>">
                            <?= $pembayaran['tahun_ajaran']?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div> -->
            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL?>/admin_siswa" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

<script>
const nisBtn = document.getElementById('btn-nis');
const nisWrapper = document.getElementById('nis-wrapper');
const nisInput = document.getElementById('nis');
const nisText = document.getElementById('nis-text');

let isDisabled = true;
nisBtn.addEventListener('click', function() {
    isDisabled = !isDisabled;
    console.log('jalan');
    if (isDisabled) {
        nisInput.setAttribute('disabled',true);
        nisWrapper.classList.add('fade');
        nisText.innerText = 'Manual'
        setTimeout(() => {
            nisWrapper.classList.add('d-none');
        }, 300);
    } else {
        nisWrapper.classList.remove('d-none');
        nisWrapper.classList.remove('fade');
        setTimeout(() => {
            nisInput.removeAttribute('disabled');
           nisText.innerText = 'Otomatis'
        }, 300);
    }
});
</script>