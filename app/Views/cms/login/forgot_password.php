<div class="form-wrapper" name="icm_form_forgot_password">
    <div class="form-header">
        <h1>GC</h1>
        <em><small>Gerenciamento de Contratos</small></em>
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

        <p>
            Para recuperar sua senha, utilize o <strong>Nome de Usuário</strong> ou o <strong>Email</strong> utilizados no cadastro.
        </p>

        <div class="divider"></div>

        <?= form_open($action_login, ['class' => 'form-forgotpassword']) ?>

            <input type="hidden" name="redirect" value="<?= base_url('controle') ?>">
            <input type="hidden" name="refresh" value="<?= base_url('controle/refresh') ?>">

            <div class="form-group">
                <label for="username" class="sr-only">Usuário ou Email</label>
                <input type="text"  class="form-control" name="username" id="username" placeholder="Usuário/Email" value="" data-validate>
            </div>

            <div class="form-group">
                <a href="<?= base_url(route_to('cms.login.index')) ?>" class="float-left btn btn-link">Voltar</a>
                <input type="submit" value="Enviar" class="btn btn-primary float-right" id="btn_forget_password" name="btn_forget_password">
                <div class="clearfix"></div>
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
        
        <em class="copyright">nepuga.edu.br &copy; { current_year }</em>
    </div>
</div>