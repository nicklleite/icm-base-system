<div class="form-wrapper" name="icm_form_login">
    <div class="form-header">
        <h1></h1>
        <em><small></small></em>
    </div>

    <div class="divider"></div>

    <div class="icm_validation_messages error d-none mb-3" data-type="alert">
        <button type="button" class="icm_validation_messages__close close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="icm_validation_messages__title"><small class="icm_validation_messages__code"></small></h5>
        <span class="icm_validation_messages__message"></span>
    </div>

    <div class="form-body">
        <?= form_open($action_login, ['class' => 'form-login']) ?>
            <input type="hidden" name="redirect" value="<?= base_url('controle/dashboard') ?>">
            <input type="hidden" name="refresh" value="<?= base_url('controle/refresh') ?>">

            <div class="form-group">
                <label for="username" class="sr-only">Usuário ou Email</label>
                <input class="form-control" type="text" name="username" id="username" placeholder="Usuário/Email" value="" data-validate>
            </div>
            <div class="form-group show-password">
                <label for="password" class="sr-only">Senha</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Senha" value="" data-validate>
                <span class="show-password-btn" role="button" aria-controls="password" aria-expanded="false" onclick="fn_show_password(this);return;">
                    <p class="sr-only">Mostrar Senha</p>
                    <i class="far fa-eye fa-fw"></i>
                </span>
            </div>
    
            <div class="form-group">
                <a href="<?= base_url(route_to('cms.login.forgot_password')) ?>" class="float-left btn btn-link">Esqueci minha senha</a>
                <input type="submit" value="Acessar" class="btn btn-primary float-right" id="btn_login">

                <div class="clearfix"></div>

                <?php if ($_SERVER['REMOTE_ADDR'] == "::1") : ?>
                    <div class="divider"></div>
                    <a href="#" class="btn btn-primary btn-block" id="btn_login_admin">Administrador</a>
                <?php endif; ?>
            </div>
        <?= form_close() ?>
    </div>

    <div class="divider"></div>

    <div class="form-footer">
        <div class="alert alert-danger alert-dismissible fade show d-none text-left" role="alert">
            <div id="alert_messages"></div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <em class="copyright">suaempresa.com.br &copy; { current_year }</em>
    </div>
</div>