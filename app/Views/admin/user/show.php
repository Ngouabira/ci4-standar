<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>
<div class="card">
<div class="card-header bg-white">
        <div class="float-left">
            <div class="btn-group">
                <a href="<?=base_url('/admin/user')?>" class="btn btn-sm btn-block btn-primary"><i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <span class="card-title pl-2"><?=translate('user.title')?> <?=$user['id']?> <?=translate('base.detail')?></span>
    </div>
    <!-- Account -->
    <div class="card-body">

        <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="/uploads/<?=$user['image']?>" class="d-block rounded user-icon" height="100" width="100" id="userAvatar">
        </div>

        <div class="col-10 offset-1"> <?=$this->include('components/message.php')?></div>
        <form id="formAccountSettings" method="POST" action="/profile">
            <?=csrf_field()?>
            <div class="row">
                <div class="col-12 pt-1">
                    <label class="form-label" for="name"><?=translate('user.name')?></label>
                    <input disabled type="text" name="name" required id="name" class="form-control" value="<?=$user['name']?>">
                </div>
                <div class="col-12 pt-1">
                    <label class="form-label" for="name"><?=translate('user.email')?></label>
                    <input disabled type="email" required name="email" id="email" class="form-control" value="<?=$user['email']?>">
                </div>
            </div>
        </form>

        <br>
        <h5><?=translate('role.title')?></h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?=translate('role.name')?></th>
                    <th scope="col"><?=translate('role.description')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user['roles'] as $value) {?>
                    <tr>
                        <td><?=$value['name']?></td>
                        <td><?=$value['description']?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>


        <br>
        <h5><?=translate('permission.title')?></h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?=translate('permission.name')?></th>
                    <th scope="col"><?=translate('permission.description')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user['permissions'] as $value) {?>
                    <tr>
                        <td><?=$value['name']?></td>
                        <td><?=$value['description']?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>


    </div>
    <!-- /Account -->
</div>
<?=$this->endSection()?>