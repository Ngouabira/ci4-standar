<script>
    <?php if (session()->has("message")) {?>
        Swal.fire({
            icon: 'success',
            title: 'Great!',
            text: `<?=session("message")?>`
        })
    <?php }?>
</script>