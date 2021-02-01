<div class="form-wrapper" name="gc_form_new_password">
    <div class="form-header">
        <h1>GC</h1>
        <em><small>Gerenciamento de Contratos</small></em>
    </div>

    <div class="divider"></div>

    <div class="gc_validation_messages error d-none mb-3" data-type="alert">
        <button type="button" class="gc_validation_messages__close close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="gc_validation_messages__title"><small class="gc_validation_messages__code"></small></h5>
        <span class="gc_validation_messages__message"></span>
    </div>

    <div class="form-body">

        <p>
            <strong>Regras para uma senha segura:</strong>

            <ul class="password-test-list text-left">
                <li id="password_length"><small><i class="fas"></i> A senha deve ter no mínimo 8 caractéres</small></li>
                <li id="password_uppercase"><small><i class="fas"></i> A senha deve contar ao menos uma letra maiúscula</small></li>
                <li id="password_lowercase"><small><i class="fas"></i> A senha deve conter ao menos uma letra minúscula</small></li>
                <li id="password_number"><small><i class="fas"></i> A senha deve conter ao menos um número</small></li>
                <li id="password_special_chars"><small><i class="fas"></i> A senha deve conter ao menos um caractér especial</small></li>
            </ul>
        </p>

        <div class="divider"></div>

        <?= form_open($action_login, ['class' => 'form-newpassword']) ?>
            <input type="hidden" name="redirect" value="<?= base_url('controle/login') ?>">
            <input type="hidden" name="refresh" value="<?= base_url('controle/refresh') ?>">
            <input type="hidden" name="user_token" value="<?= $token ?>">

            <div class="form-group show-password">
                <label for="new_password" class="sr-only">Nova Senha</label>
                <input class="form-control" type="password" name="new_password" id="new_password" placeholder="Nova Senha" value="" oninput="oninput_check_password(this);return;" autocomplete="false" autofocus  data-validate>
                <span class="show-password-btn" role="button" aria-controls="new_password" aria-expanded="false" onclick="fn_show_password(this);return;">
                    <p class="sr-only">Mostrar Senha</p>
                    <i class="far fa-eye fa-fw"></i>
                </span>
            </div>

            <div class="form-group show-password">
                <label for="confirm_password" class="sr-only">Confirmar Senha</label>
                <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Confirmar Senha" autocomplete="false" value="" data-validate>
                <span class="show-password-btn" role="button" aria-controls="confirm_password" aria-expanded="false" onclick="fn_show_password(this);return;">
                    <p class="sr-only">Mostrar Senha</p>
                    <i class="far fa-eye fa-fw"></i>
                </span>
            </div>

            <div class="form-group">
                <a href="<?= base_url(route_to('cms.login.index')) ?>" class="float-left btn btn-link">Voltar</a>
                <input type="submit" value="Salvar" class="btn btn-primary float-right" id="btn_submit">
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