<?php $user = getLoginAccount();?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Welcome Back <?= $user['username']?>👋</h1>
    <?php if($user['role'] == Role::ADMIN):?>
    <a href="#" id="btn-report" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i>
             Generate Report
    </a>
    <?php endif;?>
</div>
<div class="row mt-3">
    <div class="col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Petugas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['petugas_count']?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Jumlah Siswa
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['siswa_count']?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Jumlah Pengguna
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['pengguna_count']?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header text-primary">
        Pemasukan Tahun ini
    </div>
    <div class="card-body">
        <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
        </div>
    </div>
</div>
<!-- <div class="fit-content mx-auto" style="width:fit-content;">
    <video  autoplay muted>
        <source src="<?= BASE_URL?>/video/bumi.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div> -->

<script>
// show prompt when btn report clicked
document.getElementById('btn-report').addEventListener('click', function() {
    const tahun = prompt('Masukan tahun');
    if (tahun != null) {
        window.location.href= `<?= BASE_URL?>/admin/laporan/${tahun}`;
    }
});
</script>