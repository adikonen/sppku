<div>
    <h4 class="text-capitalize">Reset Password</h4>
    <div class="card p-3">
        <form action="<?= BASE_URL?>/admin_reset_password/store" method="post">
            <?php
                component('input', [
                    'id' => 'password',
                    'label' => 'Password Saat Ini',
                    'type' => 'password'
                ]);
                component('input', [
                    'id' => 'new_password',
                    'label' => 'Password Baru',
                    'type' => 'password'
                ]);
                component('input',[
                    'id' => 'password_confirmation',
                    'label' => 'Konfirmasi Password',
                    'type' => 'password'
                ]);
            ?>

            <div class="mb-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL?>/admin_petugas" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>