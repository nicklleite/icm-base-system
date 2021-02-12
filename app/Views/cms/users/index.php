<div class="default-section users-wrapper">
    
    <header>
        <h1>Usuários</h1>
        <div class="icm_breadcrumb">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="list-inline-item">Usuários</li>
            </ul>
        </div>
    </header>

    <div class="icm_filters_wrapper">
        <div class="row">
            <div class="col-lg-12">
                <?= form_open($action_filter, ['class' => 'icm_filters__user_search']) ?>
                    <div class="form-row justify-content-end">
                        <div class="form-group col-lg-3">
                            <input type="text" class="form-control form-control-sm" name="form_users__filters" id="form_users__filters" placeholder="Pesquisar usuário...">
                        </div>
                        <div class="form-group col-lg-1">
                            <button class="btn btn-sm btn-outline-primary btn-block" id="form_users__filters__btn_submit" name="form_users__filters__btn_submit">Pesquisar</button>
                        </div>
                    </div>
                <?= form_close() ?>
            </div>
            <div class="col-lg-12"><hr></div>
        </div>
        <?= form_open(route_to('cms.users.massupdate'), ['class' => 'icm_filters__mass_update mt-3 d-none']) ?>
            <div class="form-row justify-content-end">
                <div class="form-group mb-0 col-lg-12">
                    <small><em>Edição em massa: <i class="far fa-question-circle fa-fw" data-toggle="tooltip" data-placement="bottom" title="A ação selecionada será aplicada para todos os registros selecionados."></i></em></small>
                    <button class="btn btn-primary btn-sm ml-2 multi-selected-update" name="icm_filters__mass_update__status" data-action="status">Inativar</button>
                    <button class="btn btn-danger btn-sm ml-2 multi-selected-update" name="icm_filters__mass_update__delete" data-action="delete">Excluir</button>
                </div>
            </div>
        <?= form_close() ?>
    </div>

    <div class="icm_data_table table-responsive mt-3">
        <table class="table table-sm table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col"><input class="form-control" type="checkbox" name="icm_data_table__select_all" id="icm_data_table__select_all" onchange="selectAll(this);return false;"></th>
                    <th scope="col">Nome Completo</th>
                    <th scope="col">Login</th>
                    <th scope="col">Email</th>
                    <th scope="col">Criado em</th>
                    <!-- <th scope="col">Ações</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $row) : ?>
                        <tr>
                            <td><input class="form-control" type="checkbox" name="icm_data_table__select" id="icm_data_table__select_<?= $row->id ?>" data-userid="<?= $row->id ?>"></td>
                            <td><?= $row->fullname ?></td>
                            <td class="text-center"><?= $row->username ?></td>
                            <td class="text-center"><?= $row->email ?></td>
                            <td class="text-center"><?= date("d/m/Y H:i:s", strtotime($row->created_at)) ?></td>
                            <!-- <td class="text-center">
                                <a href=""><i class="fas fa-edit fa-fw"></i></a>
                                <a href=""><i class="far fa-eye fa-fw"></i></a>
                                <a href=""><i class="fas fa-trash-alt fa-fw"></i></a>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            <strong class="color-error">Nenhum usuário cadastrado</strong>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>