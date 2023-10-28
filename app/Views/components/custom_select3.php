<label class="form-label"> <?=$data['label']?> </label>
<div class="input-group">
    <select name="<?=$data['name']?>" id="<?=$data['name']?>" disabled class="form-control select-perso" style=" appearance: none;-webkit-appearance: none;-moz-appearance: none;background-image: none;">
        <?php if (count($data['options']) > 0): ?>
            <option value="<?=$data['options'][0]?>"><?=$data['options'][0]?><?php if (isset($data['options'][0]) && $data['options'][1] != null && $data['options'][1] != ''): ?> | <?=$data['options'][1]?><?php endif;?></option>
        <?php endif;?>
    </select>
    <?php if (!isset($data['class'])): ?>
        <input type="hidden" name="<?=$data['name']?>" id="<?=$data['name']?>_val" value="<?=$data['options'][0] ?? ''?>" />
        <span class="btn bg-gray"   <?=$data['class'] ?? ''?>  id="b<?=$data['name']?>" onclick="showCustomModal({field:'<?=$data['name']?>', modalId:'<?=$data['modalId']?>', route:'<?=$data['route']??''?>',model:'<?=$data['model']??''?>', column1:'<?=$data['columns'][0]?>', column2:'<?=$data['columns'][1]?>'})"><i class='fas fa-search'></i></span>
    <?php endif;?>
</div>