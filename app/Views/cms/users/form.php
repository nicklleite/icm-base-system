<div class="default-section gc_page_form">
    
    <header>
        <h1>Usuários</h1>
        <div class="gc_breadcrumb">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="<?= base_url(route_to('cms.dashboard')) ?>">Dashboard</a>
                </li>
                <li class="list-inline-item">
                    <a href="<?= base_url(route_to('cms.users.index')) ?>">Usuários</a>
                </li>
                <li class="list-inline-item"><?= $page_name ?></li>
            </ul>
        </div>
    </header>

    <div class="gc_form_wrapper mt-3">
        <div class="row">
            <div class="col-lg-8">
                <?= form_open($action, ['class' => 'gc_form', 'name' => 'form_users']) ?>
                    <h4 class="gc_form_title mb-3 pb-2">Dados do Usuário</h4>
                    <div class="form-group">
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Nome Completo" value="<?= $fullname ?>">
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Login" value="<?= $username ?>">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?= $email ?>">
                        </div>
                    </div>
                    <h4 class="gc_form_title mt-4 mb-2 pb-2">Permissões de Acesso</h4>
                    <div class="form-row">
                        <?php foreach ($pages_for_permission as $row) : ?>
                            <div class="col-lg-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?= $row->id ?>" id="checkboxPermissions_<?= $row->id ?>" name="checkboxPermissions[]">
                                    <label class="form-check-label" for="checkboxPermissions_<?= $row->id ?>">
                                        <?= $row->title ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?= form_close() ?>
            </div>
            <div class="col-lg-4">Informações</div>
        </div>
    </div>

</div>