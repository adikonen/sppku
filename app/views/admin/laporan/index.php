<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="<?= BASE_URL?>/css/sb-admin-2.min.css">
</head>
<body>
    <div class="text-center">
        <h4>Laporan Keuangan tahun <?= $data['tahun_ajaran']?></h4>
        <h5>Jumlah transaksi dilakukan: <?= $data['transaksi_count']?></h5>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Pemasukan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['all_month'] as $month):?>
                <tr>
                    <td><?= $month['name']?></td>
                    <td><?= $month['income']?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <hr>
    <div class="text-right">
        <h4>Total Pemasukan tahunan : <?= $data['year_income']?></h4>
    </div>
    <script>
        document.onload(window.print());
    </script>
</body>
</html>