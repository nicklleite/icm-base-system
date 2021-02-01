<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $DBGroup = 'default';

    protected $table = "users";

    public function getUsers($filter = array()) {
        $builder = $this->connect();

        if (!empty($filter)) {
            foreach ($filter as $k => $v) {
                $builder->orLike($k, $v);
            }
        }

        $result = $builder->get();
        return $result->getResult();
    }

    public function getUser($filter = array(), $query_where_cond = "AND", $return_num_rows = false) {
        $builder = $this->connect();

        if (is_array($filter) && !empty($filter)) {
            foreach ($filter as $k => $v) {
                if ($query_where_cond == "AND") {
                    $builder->where($k, $v);
                } else if ($query_where_cond == "OR") {
                    $builder->orWhere($k, $v);
                }
            }
        } else {
            $builder->where('id', $filter);
        }

        if ($return_num_rows) {
            return $builder->countAllResults();
        } else {
            $result = $builder->get();
            return $result->getRow();
        }
    }

    public function updateUser(int $id, array $data) {
        $builder = $this->connect();

        $builder->where('id', $id);
        $builder->update($data);

        return $this->db->affectedRows();
    }

    public function createUser() {
        
    }

    public function updateUsers(array $ids, string $column) {
        $builder = $this->connect();

        foreach ($ids as $id) {
            $user = $this->getUser(['id' => $id]);
            
            $new_value = $user->status == 1 ? 0 : 1;
            $builder->where('id', $id);
            $builder->set($column, $new_value);

            if (!$builder->update()) {
                echo __FILE__ . ":" . __LINE__ . "<pre>";print_r("Erro ao atualizar o usuário: " . $user->fullname);echo "</pre>";die;
            }
        }
    }

    public function login(string $username) {
        $builder = $this->connect();

        $builder->select(['id', 'password', 'fullname', 'email', 'username', 'permissions']);
        $builder->where('email', $username)->orWhere('username', $username);
        $builder->limit(1);
        $result = $builder->get();
        
        return $result->getRow();
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