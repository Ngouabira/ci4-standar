<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="row">
    <div class="col-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <h5 class="card-header">Profile</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                        <div class="button-wrapper">
                            <form id="formAccountSettings" method="POST" onsubmit="return false">
                                <label for="upload" class="btn btn-success me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                </label>
                                <button type="button" class="btn btn-primary account-image-reset mb-4">
                                    <span class="d-none d-sm-block">Save</span>
                                </button>

                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </form>
                        </div>
                    </div>
                    <br>
                    <hr class="my-0">
                </div>

                <div class="card-body">
                    <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">



                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>
<script src="/assets/js/pages-account-settings-account.js"></script>
