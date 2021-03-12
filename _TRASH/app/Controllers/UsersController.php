<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Entities\User;
use App\Models\UserModel;

class UsersController extends ResourceController {

    use ResponseTrait;

    /**
     * List all the users
     * 
     * @package icm-base-system
     * @method App\Controller\UsersController::index
     * @return \CodeIgniter\HTTP\ResponseInterface
     * 
     * @see https://codeigniter.com/user_guide/incoming/incomingrequest.html
     * @see https://codeigniter.com/user_guide/outgoing/response.html
     */
    public function index() {
        $userModel = new UserModel();
        $data = $userModel->select(['key', 'email', 'username', 'fullname', 'created_at as user_since'])->findAll();

        if (empty($data)) {
            $data = [
                'status' => 200,
                'error' => null,
                'message' => "There's no user registred on the system."
            ];
        }

        return $this->respond($data, 200);
    }
    
    /**
     * Creates a user that can access the API services. The method requires a
     * JSON as the body of request. With it, the user is registred in the DB,
     * an API key is generated and returnd on the response JSON.
     * 
     * @package icm-base-system
     * @method App\Controller\Api\UsersController::create
     * @return \CodeIgniter\HTTP\ResponseInterface
     * 
     * @see https://codeigniter.com/user_guide/incoming/incomingrequest.html
     * @see https://codeigniter.com/user_guide/outgoing/response.html
     */
    public function create($any = null) {

        // Lets create some users, shaw we?!
        if ($this->request->hasHeader('Content-Type') && $this->request->getHeaderLine('Content-Type') == "application/json") {

            // Retrieve the request body
            $body = $this->request->getJSON(true);

            // Generating the User Key and the Access Key
            $body['key'] = hash('md5', implode(",", $body) . time());
            $body['access_token'] = hash('sha256', implode(";", $body) . time());

            // Data validation before store it
            $userModel = new UserModel();

            if (!$userModel->save($body)) {
                /**
                 * TODO: Make the error messages more human friendly
                 */

                return $this->response->setStatusCode(400)->setJSON($userModel->errors());
            } else {
                $newUser = $userModel->select(['key', 'email', 'username', 'fullname', 'created_at as user_since'])->find($userModel->getInsertID());
                
                // Mission accomplished!
                return $this->response->setStatusCode(201)->setJSON($newUser);
            }
        } else {

            // Mission failed! Off with ye!
            return $this->response->setStatusCode(400)->setJSON([
                "message" => "Something is wrong with your request! Check the information sended and try again later."
            ]);
        }
    }

    /**
     * !! This method requires the API Key from a registred user !!
     * 
     * 
     * 
     * @package icm-base-system
     * @method App\Controller\Api\UsersController::create
     * @return \CodeIgniter\HTTP\ResponseInterface
     * 
     * @see https://codeigniter.com/user_guide/incoming/incomingrequest.html
     * @see https://codeigniter.com/user_guide/outgoing/response.html
     */
    public function update($key = null) {
        echo __FILE__ . ":" . __LINE__ . "<pre>";print_r($key);echo "</pre>";die;
    }

}