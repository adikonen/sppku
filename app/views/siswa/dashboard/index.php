<?php $user = getLoginAccount();?>
<div>
    <h4>Halo Selamat datang <?= $user['nama_siswa']?> 👋</h4>
    <div class="card p-3">
        <h6>Berikut Pembayaran Yang Wajib Anda Bayar, (Tahun Pembayaran Anda sekarang adalah Tahun <?= printYearSPP($data['current_tahun_ajaran'])?>)</h4>
        <div class="row">
            <?php foreach($data['all_pembayaran'] as $pembayaran):?>
            <div class="p-3 col-md-4">
                <div class="bg-info text-white p-3 rounded-lg">
                    <div>Nominal : <?= $pembayaran['nominal']?></div>
                    <div>Tahun Ajaran : <?= printYearSPP($pembayaran['tahun_ajaran'])?></div>
                    <div>Sudah Lunas : <?= $pembayaran['description']?></div>
                </div>  
                <div class="text-center mt-2">
                    <?php if($pembayaran['is_done']):?>
                        <i class="fa fa-fw fa-check text-success fa-2x"></i>
                    <?php endif;?>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="alert alert-primary my-3">
        Mohon bayar tepat waktu
    </div>
    <div class="fit-content mx-auto my-3" style="width:fit-content;">
        <video  autoplay muted>
            <source src="<?= BASE_URL?>/video/bumi.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
</div>