<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

use App\Models\UserModel as User;
use App\Models\PageModel as Page;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['url', 'form'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->db = \Config\Database::connect(); // Database
		$this->session = \Config\Services::session(); // Session
		$this->request = \Config\Services::request(); // Request
		$this->parser = \Config\Services::parser(); // View Parser
		$this->validation =  \Config\Services::validation(); // Form Validation
		$this->email = \Config\Services::email(); // Email
		$this->pager = \Config\Services::pager(); // Pagination

		//--------------------------------------------------------------------
		// Instance of models
		//--------------------------------------------------------------------
		$this->log = new \App\Models\LogModel(); // Log
		$this->page = new \App\Models\PageModel(); // Pages
		$this->user = new \App\Models\UserModel(); // Pages
	}

	// Recupera informações do usuário
	public function user_session_info() {
		return array(
			array(
				"user_id" => $this->session->get('user_id'),
				"user_fullname" => $this->session->get('first_name') . " " . $this->session->get('last_name'),
				"user_email" => $this->session->get('email'),
				"username" => $this->session->get('username')
			)
		);
	}

	// Verifica se o usuário está logado
	public function is_logged_in() {
		return isset($_SESSION['user_id']);
	}

	public function have_permission($user_id, $page_id) {
		$u = new User();
		$user = $u->getUser($user_id);
		$permissions = explode(',', $user->permissions);

		return in_array($user->id, $permissions);
	}

	public function config_email() {
		// sendmail
		// return [
		// 	'protocol' => 'sendmail',
		// 	'charset' => 'utf-8',
		// 	'crlf' => "\r\n",
		// 	'newline' => "\r\n",
		// 	'mailType' => "html"
		// ];

		// Mailtrap
		$config = array(
			'protocol' => 'smtp',
			'SMTPHost' => 'smtp.mailtrap.io',
			'SMTPPort' => 2525,
			'SMTPUser' => 'c2ed834d5483d8',
			'SMTPPass' => '3b7f850f1914b2',
			'CRLF' => "\r\n",
			'newline' => "\r\n",
			"mailType" => "html"
		);

		return $config;
	}
}
