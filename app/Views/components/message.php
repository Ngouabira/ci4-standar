<?php if (session()->has('info')): ?>
    <?php $info = session('info');?>
    <?php

if ($info['type'] == 'danger') {
    $textColor = '#FF0000'; // White text color for danger
    $backgroundColor = '#f8d7da'; // Red background color for danger
    $borderColor = '#FFFFFF'; // Red border color for danger
}

if ($info['type'] == 'success') {
    $textColor = '#155724'; // Green text color for success
    $backgroundColor = '#d4edda'; // Light green background color for success
    $borderColor = '#c3e6cb'; // Light green border color for success
}

// Now you can use $textColor, $backgroundColor, and $borderColor in your HTML or CSS
?>

    <div class="alert alert-<?=$info['type'] ?? 'danger'?> alert-dismissible fade show" role="alert"  style="color: <?php echo $textColor; ?>; background-color: <?php echo $backgroundColor; ?>; border-color: <?php echo $borderColor; ?>;">
        <?php foreach ($info['messages'] ?? ['Something wrong happened'] as $message): ?>
            <strong><?=$message?></strong><br>
        <?php endforeach?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif?>