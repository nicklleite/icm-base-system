<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model {

    protected $DBGroup = 'default';

    protected $table = "pages";

    public function getPage($slug) {
        $builder = $this->connect();

        $builder->where('slug', $slug);
        $result = $builder->get();

        return $result->getRow();
    }

    public function getPages($columns = array(), $filters = array()) {
        $builder = $this->connect();

        if (is_array($columns) && !empty($columns)) {
            $builder->select(implode(",", $columns));
        }

        if (is_array($filters) && !empty($filters)) {
            foreach ($filters as $k => $v) {
                $builder->where($k, $v);
            }
        }

        if ($builder->countAllResults() > 0) {
            $result = $builder->get();

            return $result->getResult();
        } else {
            return false;
        }

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