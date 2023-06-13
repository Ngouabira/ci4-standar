<label class="form-label"> <?=$data['label']?> </label>
<div class="input-group">
    <select name="<?=$data['name']?>" id="<?=$data['name']?>" disabled class="form-control select-perso">
        <?php if (count($data['options']) > 0): ?>
            <option value="<?=$data['options'][0]?>"><?=$data['options'][1]?><?php if (isset($data['options'][2])): ?> | <?=$data['options'][2]?><?php endif;?></option>
        <?php endif;?>
    </select>
    <input type="hidden" name="<?=$data['name']?>" id="<?=$data['name']?>_val" value="<?=$data['options'][0] ?? ''?>" />
    <span class="btn btn-primary" id="b<?=$data['name']?>" onclick="showModal('<?=$data['route']?>', '<?=$data['method']?>')"><i class='bx bxs-search'></i></span>
</div>