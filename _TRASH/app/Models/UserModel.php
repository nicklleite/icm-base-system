<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType    = 'App\Entities\User';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'fullname', 'username', 'email', 'key', 'access_token'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'fullname' => 'required|min_length[5]',
        'username' => 'required|min_length[5]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.'
        ],
        'username' => [
            'is_unique' => 'Sorry. That username has already been taken. Please choose another.'
        ]
    ];
    protected $skipValidation = false;
}