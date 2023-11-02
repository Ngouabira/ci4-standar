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
        <div class="float-right">
            <div class="btn-group">

                <?php if ($user['status'] == 1): ?>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#accountStatusModal">
                        <?=translate('user.disableAccount')?>
                    </button>
                    <button type="button" class="btn btn-sm btn-success ml-1" data-toggle="modal" data-target="#resetPasswordModal">
                        <?=translate('user.resetPassword')?>
                    </button>
                <?php else: ?>
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#accountStatusModal">
                        <?=translate('user.enableAccount')?>
                    </button>
                <?php endif?>


            </div>
        </div>
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

<div class="modal fade" id="accountStatusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="modal-content" id="disable-frm" method="POST" action="/admin/user/change-status">
            <?=csrf_field()?>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?=$user['status'] == 1 ? translate('user.disableAccount') : translate('user.enableAccount')?></h4>
                <button type="button" style="background: none; border: none; font-size: 2.3em; color:red;" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="id" value="<?=$user['id']?>">
                <input type="hidden" name="status" value="<?=$user['status'] == 1 ? 0 : 1?>">
                <div class="form-group col-md-12">
                    <h6> <?=$user['status'] == 1 ? translate('user.disable_message') : translate('user.enable_message')?></h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><?=translate('base.no')?></button>
                <button class="btn btn-outline-success" type="submit" ><?=translate('base.yes')?></button>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="modal-content" id="reset-frm" method="POST" action="/admin/user/reset-password">
            <?=csrf_field()?>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?=translate('user.resetPassword')?></h4>
                <button type="button" style="background: none; border: none; font-size: 2.3em; color:red;" class="close" data-dismiss="modal" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="id" id="idValue" value="<?=$user['id']?>">
                <div class="form-group col-md-12">
                    <h6> <?=translate('user.reset_message')?></h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><?=translate('base.no')?></button>
                <button class="btn btn-outline-success" type="submit" ><?=translate('base.yes')?></button>
            </div>
        </form>
    </div>
</div>

<?=$this->endSection()?>