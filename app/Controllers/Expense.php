<?php

namespace App\Controllers; 

use App\Controllers\BaseController;

use App\Models\ExpenseViewModel;
use App\Models\ExpenseModel;
use App\Models\CategoryModel;


class Expense extends BaseController
{
     private $expenseViewModel;
     private $expenseModel;
     private $category;

    function __construct() 
    {
        helper("form");
        helper("mutil");
        
        $this->expenseViewModel = new ExpenseViewModel();
        $this->expenseModel     = new ExpenseModel();
        $this->category         = new CategoryModel();
       
    }



    public function index()
    {
       
        //   $vexpense = $this->expenseModel->getById(1);
          
          $vexpense = [];
          
          return view("home", ["expense" => $vexpense]);
    
    }


  
    public function show( )
    {  

        $qcategory = $this->category->getCategory(); 

        $data = $this->request->getGet() ?? [];
        
        $dt_start =  isset($data['dt_start']) ? $data['dt_start'] : false;
        $dt_end   =  isset($data['dt_end'])   ? $data['dt_end']   : false;
        $category =  isset($data['category']) ? $data['category'] : false;
        
       
        $vexpe =  $this->expenseViewModel->where('user_id', session()->get('id')); //importante: so mostra do usuario logado
              

        $is_search = ($dt_start ||  $dt_end  || $category );
                  
        $arsearch = [];

            if ($is_search) {
                
                if (isset($dt_start) && $dt_start ) {
                    $vexpe->where('dt_despesa >= ', $dt_start);
                    $arsearch['dt_start'] = $dt_start;
                } 

                if ( isset($dt_end) &&  $dt_end ) {
                    
                    $vexpe->where('dt_despesa <= ',  $dt_end );
                    $arsearch['dt_end'] = $dt_end;
                    
                } 
                                                        
                if (isset($category) && $category) {
                    
                    $vexpe->where('cat_id', $category);
                    $arsearch['category'] = $category;
                }     
                
                $vexpe->orderBy('dt_despesa', 'desc');
                   
               

                return view("expense/exp_control",  [  "vexpenses" => $vexpe->paginate(5),
                                                       "pager"     => $this->expenseViewModel->pager,
                                                       "vcategory" => $qcategory,
                                                       "arsearch"  => $arsearch ] );


                } else {

                 $vexpe->orderBy('dt_despesa', 'desc');
                 return view("expense/exp_control",  [ "vexpenses"  =>  $vexpe->paginate(5), // so aparece os registros do usuario logado(dono)
                                                       "pager"      =>  $this->expenseViewModel->pager,
                                                       "vcategory"  =>  $qcategory ]);
                }

                                                
    }



     public function new()
     {
          
          $category = $this->category->getCategory();


          return view("expense/exp_add_edit", ["vcategory" => $category]);
     }



     public function edit(int $eid)
     {
        
      
        $category = $this->category->getCategory();
        
        $expense  = $this->expenseModel->where('id', (int)$eid)
                                        ->first();
                
        if(session()->get('id') == $expense['usuario_fk']) {
            
            return view("expense/exp_add_edit", [ "vcategory" => $category,
                                                        "vexpense"  => $expense]);
         
        } else {

            return redirect()->to('/');
                    
        }
        
     }


     
      public function delete(int $eid) // expense id
      {
        
         if (!$eid) {
               
               throw new \CodeIgniter\Exceptions\PageNotFoundException("Link inexistente");
             
           }
        
         if ($this->expenseModel->delete($eid)) {

                 return redirect()->to('/expense/all');
          
         } else {
            
                 return redirect()->to('/expense/all');
            
         }
   
       } 



     public function save(int $eid = null) // expense id save or update
     {

        $data   = $this->request->getPost();
         
        if ( !isset($data) || empty($data) ) { 
         
         throw new \CodeIgniter\Exceptions\PageNotFoundException("Erro, dados de formulario vazio");
         
        } 

        if ( isset($data["uid"]) && session()->get('id') != $data["uid"] ) {
              
         return redirect()->to('/expense/all');
     
    }


    if (isset($data["eid"])) { //update despesa
         //a data do post nao se altera para edição/atualização
            $dataToSave = [ "id"           => $data["eid"],
                            "descricao"    => $data["descricao"],
                            "valor"        => formatMoneyToDb($data["valor"]), // formata real para mysql, format brl to mysql decimal
                            "categoria_fk" => $data["category"],
                            "dt_despesa"   => $data["data"],
                            "usuario_fk"   => (int)session()->get("id")
                          ]; 
            
            } else {

            $dataToSave = [ "descricao"    => $data["descricao"],
                            "valor"        => formatMoneyToDb($data["valor"]),
                            "categoria_fk" => $data["category"],
                            "dt_despesa"   => $data["data"],
                            "usuario_fk"   => (int)session()->get("id")
                          ]; 
                }
       
                
        $request = $this->expenseModel->save($dataToSave);
        
          if ($request) {
         
               return redirect()->to('/expense/all');
 
        } else {

            echo view('erro');
        } 


        

     }


}
