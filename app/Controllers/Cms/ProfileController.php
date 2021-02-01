<?php

namespace App\Controllers\Cms;

use App\Controllers\BaseController;

class ProfileController extends BaseController {

	public function index() {
		return "CMS: Perfil";
    }

    public function create() {
        return "CMS: Perfil > Criar";
    }

    public function store() {
        return "CMS: Perfil > Criar > Salvar";
    }

    public function edit() {
        return "CMS: Perfil > Editar";
    }

    public function update() {
        return "CMS: Perfil > Editar > Salvar";
    }

    public function destroy() {
        return "CMS: Perfil > Excluir";
    }

}
