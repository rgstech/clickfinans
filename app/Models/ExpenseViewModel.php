<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseViewModel extends Model
{
 
    protected $table      = 'expense_view'; //nessa caso e uma view e não uma tabela real / in this case its a view, not a real table
    protected $primaryKey = 'desp_id';
    protected $returnType = 'array';
 // protected $allowedFields = [ ];
    
    
    
    public function getExpenses() : array 
    {
        
        $rq = $this->findAll();  
        
        return !is_null($rq) ? $rq : [];
    }



    public function filterExpenses($dt_start, $dt_end, $pcat) : array {
        
          $fexp = [];



          return !is_null($fexp) ? $fexp : [];
    }
        

}
