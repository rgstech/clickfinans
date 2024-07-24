<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{



    protected $table      = 'categoria'; //nessa caso e uma view e não uma tabela real / in this case its a view, not a real table
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [ 'descricao',
                                 'cat_usuario_fk' ];



    public function getCategory(): array
    {

        $rq = $this->findAll();

        return !is_null($rq) ? $rq : [];
    }

}
