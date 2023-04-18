<?php

$value = $data['value'] ?? null;
$type = $data['type'] ?? 'text';
$placeholder = $data['placeholder'] ?? null;
$id = $data['id'];
$label = $data['label'];
$disabled = $data['disabled'] ?? false;
$slot = $data['slot'] ?? null;
$class = $data['class'] ?? null;
$isHide = $data['is-hide'] ?? false;
$max = $data['max'] ?? null;
$min = $data['min'] ?? null;
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
        max="<?= $max?>"
        min="<?= $min?>"
        placeholder="<?= $placeholder?>"
        class="form-control"
        <?php if($disabled):?>
            disabled
        <?php else:?>
        required
        <?php endif;?>
    />
    <small><?= $slot?></small>
</div>