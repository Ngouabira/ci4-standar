<label class="form-label"> <?=$data['label']?> </label>
<div class="input-group">
    <select name="<?=$data['name']?>" id="<?=$data['name']?>" disabled class="form-control select-perso" style=" appearance: none;-webkit-appearance: none;-moz-appearance: none;background-image: none;">
        <?php if (count($data['options']) > 0): ?>
            <option value="<?=$data['options'][0]?>"><?=$data['options'][1]?><?php if (isset($data['options'][2]) && $data['options'][2]!=null && $data['options'][2]!=''): ?> | <?=$data['options'][2]?><?php endif;?></option>
        <?php endif;?>
    </select>
    <?php if (!isset($data['class'])): ?>
        <input type="hidden" name="<?=$data['name']?>" id="<?=$data['name']?>_val" value="<?=$data['options'][0] ?? null?>" />
        <span class="btn btn bg-gray"   <?=$data['class'] ?? ''?>  id="<?=$data['name']?>" onclick="showModal('<?=$data['modalId']?>')"><i class='fas fa-search'></i></span>
    <?php endif;?>
</div>