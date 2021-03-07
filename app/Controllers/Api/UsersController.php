<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

use App\Entities\Api\User;
use App\Models\Api\UserModel;

class UsersController extends BaseController {
    
    /**
     * Creates a user that can access the API services. The method requires a
     * JSON as the body of request. With it, the user is registred in the DB,
     * an API key is generated and returnd on the response JSON.
     * 
     * @package icm-base-system
     * @method App\Controller\Api\UsersController::create()
     * @return \CodeIgniter\HTTP\ResponseInterface
     * 
     * @see https://codeigniter.com/user_guide/incoming/incomingrequest.html
     * @see https://codeigniter.com/user_guide/outgoing/response.html
     */
    public function create() {

        // Lets create some users, shaw we?!
        if ($this->request->hasHeader('Content-Type') && $this->request->getHeaderLine('Content-Type') == "application/json") {

            // Retrieve the request body and generates the API key
            $body = $this->request->getJSON(true);
            $body['random_unique_key'] = sha1($body['email'] . time());
            $body['api_key'] = password_hash(implode(" ", $body), PASSWORD_BCRYPT);

            unset($body['random_unique_key']);

            // Data validation before store it
            $userModel = new UserModel();

            if (!$userModel->save($body)) {
                /**
                 * TODO: Make the error messages more human friendly
                 */

                return $this->response->setStatusCode(400)->setJSON($userModel->errors());
            } else {
                $newUser = $userModel->select(['fullname', 'username', 'email', 'api_key', 'created_at as user_since'])->find($userModel->getInsertID());
                
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

}