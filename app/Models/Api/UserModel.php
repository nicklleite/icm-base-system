<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType    = 'App\Entities\Api\User';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'fullname', 'email', 'username', 'api_key'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'fullname' => 'required|alpha_numeric_space|min_length[5]',
        'username' => 'required|alpha_numeric_space|min_length[5]',
        'email' => 'required|valid_email|is_unique[users.email]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.'
        ]
    ];
    protected $skipValidation     = false;
}