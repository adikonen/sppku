<?php

$value = $data['value'] ?? null;
$type = $data['type'] ?? 'text';
$id = $data['id'];
$label = $data['label'];
$disabled = $data['disabled'] ?? false;
$slot = $data['slot'] ?? null;
$class = $data['class'] ?? null;
$isHide = $data['is-hide'] ?? false;
?>

<div class="mb-3 <?php if($isHide):?>d-none<?php endif;?>" id="<?= $id?>-wrapper">
    <label for="<?= $id?>" class="form-label">
        <?= $label?>
    </label>
    <input 
        type="<?= $type?>" 
        value="<?= $value?>" 
        id="<?= $id?>"
        name="<?= $id?>"
        class="form-control"
        <?php if($disabled):?>
            disabled
        <?php else:?>
        required
        <?php endif;?>
    />
    <small><?= $slot?></small>
</div>