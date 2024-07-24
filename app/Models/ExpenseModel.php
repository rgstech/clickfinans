<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model // despesa
{

        
    protected $table         = 'despesa';
    protected $primaryKey    = 'id';
 // protected $returnType    = 'array';

    protected $allowedFields = [ 'descricao',
                                 'valor',
                                 'categoria_fk',
                                 'dt_despesa',
                                 'usuario_fk' ]; 


    protected $db;


    public function __construct() 
    {
        parent::__construct(); // não esquecer de chamar construtor pai
        $this->db = \Config\Database::connect();
     // $this->homeModel = new HomeModel();
    }
    


    public function getById(string $id) 
    {
   //retornando array de objects
        $builder = $this->builder();


        $builder->select('*');
      
        $builder->where("id", $id);
        $res = $builder->get()->getResult()[0];//->descricao; 

        return $res;

           
    }

 

    public function checkOwnership($eid, $uid) 
    {
    
            $vexpense = $this->where('id', $eid)
                             ->first();
                         
        if($vexpense) {
                 
          return ($vexpense['usuario_fk'] == $uid);
          
        } else {
            
            return false;
        }
        
    }

   
     public function getUserExpense($eid, $uid) 
     {
                  
         return;
         
     }

                            
}