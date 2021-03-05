<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

use App\Models\UserModel as User;

class UsersController extends BaseController {

    public function index() {
        echo __FILE__ . ":" . __LINE__ . "<pre>";print_r($this->request);echo "</pre>";die;
    }

    /**
     * Creates a user that can access the API services. The method requires a
     * JSON as the body of request. With it, the user is registred in the DB,
     * an API key is generated and returnd on the response JSON.
     * 
     * @package icm-base-system
     * @method App\Controller\Api\UsersController::create()
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function create() {

        // Lets create some users, shaw we?!
        if ($this->request->hasHeader('Content-Type') && $this->request->getHeaderLine('Content-Type') == "application/json") {
            // echo "Has the header I want!";

            // Mission accomplished!
            return $this->response->setStatusCode(201)->setJSON([
                "message" => "User created successfully"
            ]);
        } else {
            // echo "Off with ye!";

            // Mission failed!
            return $this->response->setStatusCode(400)->setJSON([
                "message" => "Something is wrong with your request! Check the information sended and try again later."
            ]);
        }
    }

}