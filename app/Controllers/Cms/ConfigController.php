<?php

namespace App\Controllers\Cms;

use App\Controllers\BaseController as Controller;

class ConfigController extends Controller {

    public function index() {
       // Informações da página
       $page = $this->page->getPage('config');

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

       $data = array(
           'base_url' => base_url(),
           "title" => $page->title,
           'control_bar' => view('cms/layout/controlbar.template.php', [
               'session_info' => $this->user_session_info()
           ]),
           'content' => "",
           'current_year' => date('Y'),
           'nocache' => time()
       );
       
       echo $this->parser->setData($data)->render('cms/layout/main.template');
    }

}