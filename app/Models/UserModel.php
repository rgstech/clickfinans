<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table         = 'usuario';
    protected $primaryKey    = 'id';
    
    protected $allowedFields = [ 'nome',
                                 'email',
                                 'password',
                                 'img_path',
                                 'dt_cadastro' ];

                                 
    protected $db;                       


    public function getByEmail(string $email): array
    {

        $rq = $this->where('email', $email)->first();

        return !is_null($rq) ? $rq : [];
    }


    public function getById(int $uid): array
    {

        $rq = $this->where('id', $uid)->first();

        return !is_null($rq) ? $rq : [];
    }


    public function getByNome(string $nome): array
    {

        $rq = $this->where('nome', $nome)->findAll();  

        return !is_null($rq) ? $rq : [];
    }


    public function getExpense(int $uid): array //  retornar todos os posts desse usuario
    {

      // $user = $this->getById($uid);

        $builder = $this->builder('expense e');

        $res =  $builder->select('e.*, u.nome')
                        ->join('usuario u', 'u.id = e.usuario_fk') // a tabela com a qual vai cruzar vem como argumento do join
                        ->where("e.usuario_fk", $uid)
                        ->get()
                        ->getResult();

        return $res; 

       
    }


    // public function getAllByKeyword(string $keyword) : array
    // {

    //     $builder = $this->builder('tbusuario');

    //     $res     =  $builder->select('usu_pk_id as uid,usu_nome as nome, usu_email as email, 
    //                                   usu_tel as tel, usu_img as img, 
    //                                   usu_dt_cad as cad, usu_sexo as sexo, usu_bio as bio  ')
    //                         ->like('usu_nome', $keyword)
    //                         ->get()
    //                         ->getResult();

       
    //     return $res;
      
    // }

    
}