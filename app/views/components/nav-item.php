<?php
$link = $data['link'];
$slot = $data['slot'];
$activeWhen = $data['active-when'];
?>
<li class="nav-item">
    <a class="nav-link <?php if($activeWhen):?>active<?php endif;?>"href="<?= $data['link']?>">
        <?= $data['slot']?>
    </a>
</li>