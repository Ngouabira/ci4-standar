<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="card">
    <h5 class="card-header bg-white"><?=translate('base.profile')?></h5>
    <!-- Account -->
    <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="/uploads/<?=authUser()['image']?>" class="d-block rounded user-icon" height="100" width="100" id="userAvatar">
            <div class="button-wrapper">
                <form id="formAccountSettings" method="POST" action="/profile/photo" enctype="multipart/form-data">
                    <label for="upload" class="btn btn-primary me-2 mb-4 ml-2" tabindex="0">
                        <span class="d-none d-sm-block"><?=translate('base.upload_file')?></span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" name="image" hidden="" accept="image/png, image/jpeg">
                    </label>
                    <button type="submit" class="btn btn-outline-success account-image-reset mb-4">
                        <span class="d-none d-sm-block"><?=translate('base.save')?></span>
                    </button>

                    <p class="text-muted mb-0 ml-2"><?=translate('base.image_size')?></p>
                </form>
            </div>
        </div>
        <br>
        <hr class="my-0">
    </div>

    <div class="card-body">
        <form id="formAccountSettings" method="POST" action="/profile">
            <div class="row">
            <div class="col-12 pt-1">
                <label class="form-label" for="name"><?=translate('user.name')?></label>
                <input type="text" name="name" required id="name" class="form-control <?=session('errors.name') ? 'is-invalid' : ''?>" value="<?=authUser()['name']?>">
            </div>
            <div class="col-12 pt-1">
                <label class="form-label" for="name"><?=translate('user.email')?></label>
                <input type="email" required name="email" id="email" class="form-control <?=session('errors.email') ? 'is-invalid' : ''?>" value="<?=authUser()['email']?>">
            </div>


            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success me-2"><?=translate('base.save')?></button>
            </div>
        </form>
    </div>
    <!-- /Account -->
</div>
<?=$this->endSection()?>
<script src="/assets/js/pages-account-settings-account.js"></script>

<?=$this->section('js')?>
<script>
    $("#upload").change(function(e) {
        console.log(e)
        for (file of e.target.files) {
            $("#userAvatar").attr('src', URL.createObjectURL(file))
        }
    })
</script>

<?=$this->endSection()?>