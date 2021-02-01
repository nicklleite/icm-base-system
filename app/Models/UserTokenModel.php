<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTokenModel extends Model {

    protected $DBGroup = 'default';

    protected $table = "user_token";

    public function getToken(string $token) {
        $builder = $this->connect();

        $builder->where('token', $token);
        $builder->where('expires_at >', date('Y-m-d H:i:s'));
        $result = $builder->get();

        return $result->getRow();
    }

    public function getTokenByUser(int $user_id) {
        $builder = $this->connect();

        $builder->where('user_id', $user_id);
        $result = $builder->get();

        return $result->getRow();
    }

    public function store_token($user_id, $token, $token_type) {
        $builder = $this->connect();

        $builder->where('user_id', $user_id);
        $builder->limit(1);

        $data = [
            'user_id' => $user_id,
            'token' => $token,
            'type' => $token_type,
            'expires_at' => date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime(date('Y-m-d H:i:s')))),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($builder->countAllResults() > 0) {
            $builder->update($data);
        } else {
            $builder->insert($data);
        }
        
        return $this->db->affectedRows();
    }

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    protected function connect() {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        return $builder;
    }
}