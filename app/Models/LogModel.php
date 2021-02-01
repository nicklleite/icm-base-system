<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model {

    protected $DBGroup = 'default';

    protected $table = "logs";

    public function register($user_id, $action, $message, $primary_key = null, $table = null, $old_record = null, $new_record = null) {

        $builder = $this->connect();

        return $builder->insert([
            'user_id' => $user_id,
            'action' => $action,
            'message' => $message,
            'primary_key' => $primary_key,
            'table' => $table,
            'old_record' => $old_record,
            'new_record' => $new_record,
            'http_user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'remote_addr' => $_SERVER['REMOTE_ADDR'],
        ]);
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