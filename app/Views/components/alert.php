<?php if (session()->has('info')): ?>
    <?php $info = session('info');?>
    <?php if (array_key_exists("message", $info)): ?>
    <script>
        Swal.fire({
            icon: '<?=$info['type']?>',
            position: 'top-end',
            title: "<?=$info['message']?>",
        })
    </script>
<?php endif?>
<?php endif?>