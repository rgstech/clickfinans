<?php
/* 

#Script desenvolvido por/Developed by Rodrigo Guimaraes
#Github: github.com/rgstech
#Clickfinans Controle de despesas minimalista / Minimalist Expense Control  
#Made and tested with codeigniter framework version: 4.2.10 
#License: GPL V2

*/
namespace App\Controllers;

use App\Models\ExpenseModel;
use CodeIgniter\I18n\Time;
use App\Models\UserModel;


class Home extends BaseController
{

    private $db;           
    private $expenseModel;  
    private $usuariosModel; 

    public function __construct()
    {

         helper("mutil");
         
         $this->db            = \Config\Database::connect();
         $this->expenseModel  = new ExpenseModel();
         $this->usuariosModel = new UserModel();

     }



    public function index()
    {

        $monthBalance = 0;
        $dayBalance   = 0;
        $weekBalance  = 0;

        $query = $this->db->query("SELECT * FROM despesa WHERE DATE_FORMAT(dt_despesa, '%Y-%m-%d') = CURDATE() AND 
                                                               usuario_fk = " . session()->get('id') ." ");

        foreach($query->getResult('array') as $row) {
            
             $dayBalance += (float)$row['valor'];
            
        }

        $query = $this->db->query("SELECT * FROM despesa WHERE  YEARWEEK(dt_despesa)=YEARWEEK(NOW()) AND 
                                                                usuario_fk = " . session()->get('id') ." ");

        foreach($query->getResult('array') as $row) {
            
             $weekBalance += (float)$row['valor'];
            
        }

        $query = $this->db->query("SELECT * FROM despesa WHERE YEAR(dt_despesa)  = YEAR(CURRENT_DATE()) AND 
                                                               MONTH(dt_despesa) = MONTH(CURRENT_DATE()) AND usuario_fk = " . session()->get('id') ." ");

        foreach($query->getResult('array') as $row) {
            
             $monthBalance += (float)$row['valor'];
            
        }
        // $builder = $this->db->table('tbpost p');
         
        return view("home", [ "daybalance"   => $dayBalance,
                              "weekbalance"  => $weekBalance,
                              "monthbalance" => $monthBalance]);


        // $myTime = Time::today('America/Chicago', 'en_US');
        // echo $myTime;
    
    }



    public function teste()
    {
        // $expenseModel = new ExpenseModel();

        // $rexpense = $expenseModel->getById(1);

        // var_dump($rexpense);
       // $vmsg = "Hello Rodrigo!";
         $vdata = ["nome" => "Rodrigo",
                    "email"=>"rod@email.com"];

        return $this->response->setJSON($vdata);
       // return $this->response->setXML($vdata);

       // return view('teste', ["mensagem" => $vmsg]); 

       // return view('errors\error');
          
        // $router = \CodeIgniter\Config\Services::router();
        // echo $router->controllerName() . PHP_EOL;  
        // echo $router->methodName();
        
        //  echo site_url();

    
        
    }



    public function addUser() // adicionar usuario apenas para teste, test purpose 
    { 

        $dataToSave = [
         
            'nome'        => "Teste",
            'email'       => "teste@email.com",
            'password'    => password_hash("1234" , PASSWORD_DEFAULT),
            'img_path'    => "",
            'dt_cadastro' => null,
           
        ];

        $result = false;
        $result = $this->usuariosModel->save($dataToSave);
        
        if ($result) {

            echo "teste adduser ok!";
            
        } else {
            echo "teste adduser FALHOU!";
        }

    }



    public function msg()
    {

        return "<h2>ERRO 404 personalizado!<h2>";
        
    }
    
    
    
}
