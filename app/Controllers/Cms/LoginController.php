<?php

namespace App\Controllers\Cms;

use App\Controllers\BaseController;

use App\Models\UserModel as User;
use App\Models\UserTokenModel as UserToken;

class LoginController extends BaseController {
	public function index() {
		// Verifica se está logado
        if ($this->is_logged_in() === true) {
            return redirect()->to(base_url('controle/dashboard'));
		}
		
		$data = array(
			'base_url' => base_url(),
			'action_login' => base_url(),
			'form' => view('cms/login/index', [
				'action_login' => base_url() . '/controle/auth',
				'session' => $this->session,
			]),
			'current_year' => date('Y')
		);
		
		echo $this->parser->setData($data)->render('cms/layout/login.template');
	}
	
	public function auth() {
		if ($this->request->getMethod() == 'post') {

			// Recupera os dados enviados
			$username = $this->request->getVar('username');
			$password = $this->request->getVar('password');

			// Busca pelo usuário
			$user = new User();
			$row = $user->login($username);
			
			if (!empty($row)) {
				if (password_verify($password, $row->password)) {
					// Registrando a session
					$session = \Config\Services::session();
					$session->set([
						'user_id' => $row->id,
						'fullname' => $row->fullname,
						'email' => $row->email,
						'username' => $row->username
					]);
		
					// Registrando log de acesso
					$this->log->register($row->id, "LOGIN", "Login realizado com sucesso!");
		
					return json_encode([
						'status' => 200,
						'message' => 'Login realizado com sucesso!'
					]);
				} else {
					return json_encode([
						'status' => 405,
						'message' => 'Login/Senha incorretos! Tente novamente mais tarde ou entre em contato com o administrador.'
					]);
				}
			} else {
				return json_encode([
					'status' => 404,
					'message' => 'Usuário não encontrado ou Login/Senha incorretos! Tente novamente mais tarde ou entre em contato com o administrador.'
				]);
			}

		} else {
			return json_encode([
				'status' => 405,
				'message' => 'Método não permitido!'
			]);
		}
	}

	public function forgot_password() {
		$data = array(
			'base_url' => base_url(),
			'action_login' => base_url(),
			'form' => view('cms/login/forgot_password', [
				'action_login' => base_url(route_to('cms.login.send_notification_mail'))
			]),
			'current_year' => date('Y')
		);
		
		echo $this->parser->setData($data)->render('cms/layout/login.template');
	}

	public function send_notification_mail() {
		if ($this->request->getMethod() == 'get') {
			return view('cms/mail/reset-password');
		} else if ($this->request->getMethod() == 'post') {

			// Recupera os dados enviados
			$username = $this->request->getVar('username');

			// Busca pelo usuário
			$user = new User();
			$row = $user->getUser(["email" => $username, "username" => $username], "OR");

			// Gerar token para o usuário
			if (!empty($row)) {
				$token = md5($row->id . '_' . $row->email) . time();
				
				$user_token = new UserToken();
				if ($user_token->store_token($row->id, $token, 'NEW_PASSWORD')) {

					// Envia o email com instruções para o usuário
					$this->email->initialize($this->config_email());
					$this->email->setTo($row->email);
					$this->email->setFrom('no-reply@nepuga.edu.br');
					$this->email->setSubject('[GC - Gerenciador de Contratos] - Solicitação de nova senha.');
					$this->email->setMessage(view('cms/mail/reset-password', [
						'link_w_token' => base_url(route_to('cms.login.new_password')) . '?v=' . $token
					]));

					if ($this->email->send()) {
						// Registra Log da solicitação
						$this->log->register($row->id, "NEW_PASSWORD_REQUEST", "Solicitação de nova senha.");
	
						return json_encode([
							'status' => 201,
							'message' => 'Nova senha requisitada com sucesso!'
						]);
					} else {
						return json_encode([
							'status' => 500,
							'message' => 'Ocorreu um erro no processamento da requisição! Por favor tente novamente mais tarde ou entre em contato com o administrador.'
						]);
					}
				}
			} else {
				return json_encode([
					'status' => 404,
					'message' => 'Usuário não encontrado!'
				]);
			}
		}
	}

	public function refresh_token() {
		return json_encode([
			'token' => csrf_hash(),
		]);
	}

	public function generate_new_password() {
		$token = $this->request->getVar('v');
		
		$user_token = new UserToken();
		$row = $user_token->getToken($token);

		if (!empty($row)) {
			if ($this->request->getMethod() == 'get') {
				$data = array(
					'base_url' => base_url(),
					'action_login' => base_url(),
					'form' => view('cms/login/generate_new_password', [
						'action_login' => base_url(route_to('cms.login.new_password')),
						'token' => $token
					]),
					'current_year' => date('Y')
				);
				
				return $this->parser->setData($data)->render('cms/layout/login.template');
			} else if ($this->request->getMethod() == 'post') {				
				$new_password = $this->request->getVar('new_password');
				
				$data = [
					'password' => password_hash($new_password, PASSWORD_BCRYPT),
					'updated_at' => date('Y-m-d H:i:s'),
				];
				
				$user = new User();
				if ($user->updateUser($row->user_id, $data)) {
					$this->log->register($row->user_id, "PASSWORD_UPDATE", "Atualização de senha ocorreu");

					return json_encode([
						'status' => 200,
						'title' => 'Sucesso!',
						'message' => 'Senha atualizada com sucesso!'
					]);
				} else {
					return json_encode([
						'status' => 500,
						'title' => 'Erro interno!.',
						'message' => 'Ocorreu um erro ao atualizar a senha! Tente novamente mais tarde.',
					]);
				}
			}
		} else {
			return redirect()->to(base_url('controle'));
		}
	}

	public function logout() {
		$this->session->destroy();
		return redirect()->to(base_url('controle'));
	}
}