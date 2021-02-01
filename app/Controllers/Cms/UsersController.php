<?php

namespace App\Controllers\Cms;

use App\Controllers\BaseController;

use App\Models\UserModel as User;

class UsersController extends BaseController {

	public function index() {

        // Informações da página
        $page = $this->page->getPage('usuarios');

        // Verifica se está logado
        if ($this->is_logged_in() === false) {
            return redirect()->to(base_url('controle'));
        }

        $user_id = $this->session->get('user_id');

        // Verifica se tem permissão para acessar a página
        if ($this->have_permission($user_id, $page->id) === false) {
            $this->session->destroy();
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getMethod() == 'get') {
            $users = $this->user->getUsers([
                'status' => 1
            ]);
        } else if ($this->request->getMethod() == 'post') {
            $filter = $this->request->getVar('form_users__filters');

            $users = $this->user->getUsers([
                'fullname' => $filter,
                'email' => $filter,
                'username' => $filter,
            ]);
        }

        $data = array(
            'base_url' => base_url(),
            "title" => $page->title,
            'control_bar' => view('cms/layout/controlbar.template.php', [
                'session_info' => $this->user_session_info(),
                'base_url' => base_url(),
            ]),
            'content' => view('cms/users/index', [
                "action_filter" => base_url(route_to('cms.users.index')),
                "action_mass_update" => base_url(route_to('cms.users.update')),
                "users" => $users,
            ]),
            'current_year' => date('Y'),
            'nocache' => time(),
        );
        
        return $this->parser->setData($data)->render('cms/layout/main.template');
    }

    public function create() {
        // Informações da página
        $page = $this->page->getPage('usuarios');

        // Verifica se está logado
        if ($this->is_logged_in() === false) {
            return redirect()->to(base_url('controle'));
        }

        $user_id = $this->session->get('user_id');

        // Verifica se tem permissão para acessar a página
        if ($this->have_permission($user_id, $page->id) === false) {
            $this->session->destroy();
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getMethod() == 'get') {
            $data = array(
                'base_url' => base_url(),
                "title" => $page->title . ' - Novo',
                'control_bar' => view('cms/layout/controlbar.template.php', [
                    'session_info' => $this->user_session_info(),
                    'base_url' => base_url(),
                ]),
                'content' => view('cms/users/form', [
                    "page_name" => "Criar Usuário",
                    "action" => base_url(route_to('cms.users.create')),
                    "fullname" => "",
                    "username" => "",
                    "email" => "",
                    "pages_for_permission" => $this->page->getPages(['id', 'title', 'slug'], ['status' => 1])
                ]),
                'current_year' => date('Y'),
                'nocache' => time(),
            );
            
            return $this->parser->setData($data)->render('cms/layout/main.template');
        } else if ($this->request->getMethod() == 'post') {

            // Recupera os dados enviados
			$fullname = $this->request->getVar('fullname');
			$username = $this->request->getVar('username');
            $email = $this->request->getVar('email');
            $checkboxPermissions = $this->request->getVar('checkboxPermissions');
            
            // Validação: Se o email informado já foi cadastrado
            $users_found = $this->user->getUser([
                'email' => $email,
                'status' => 1
            ], "AND", true);

            if ($users_found > 0) {
                return json_encode([
                    'status' => 409,
                    'message' => ""
                ]);
            }
        }
    }

    public function store() {
        return "CMS: Usuários > Criar > Salvar";
    }

    public function edit() {
        return "CMS: Usuários > Editar";
    }

    public function mass_update() {

        $action = $this->request->getVar('action');
        $ids = explode(',', $this->request->getVar('ids'));

        $this->user->updateUsers($ids, $action);

        return json_encode([
            'status' => 201,
            'title' => 'Usuários atualizados com sucesso!',
            'message' => 'Usuários atualizados com sucesso!'
        ]);
    }

    public function destroy() {
        return "CMS: Usuários > Excluir";
    }

}
