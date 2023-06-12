<?php if (session()->has('info')): ?>
    <?php $info = session('info');?>
    <div class="alert alert-<?=$info['type']?> alert-dismissible fade show" role="alert">
        <?php foreach ($info['messages'] as $message): ?>
            <li class="ml-40"><?=$message?></li>
        <?php endforeach?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?>