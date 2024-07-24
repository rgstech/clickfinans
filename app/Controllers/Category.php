<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;


class Category extends BaseController
{

    private $categoryModel;

    public function index(){ }

    function __construct()
    {
        helper('form');
        helper("mutil");

        $this->categoryModel = new CategoryModel();
    }



    public function show() 
    {

        return view("category/cat_control",  [
            "vcategories"  =>  $this->categoryModel->where('cat_usuario_fk', session()->get('id'))
                                                   ->paginate(6), 
            "pager"        =>  $this->categoryModel->pager
        ]);
    }



    public function new()
    {
        
         return view("category/cat_add_edit");

    }



    public function edit(int $cid)
    {
       
      
        $category = $this->categoryModel->where('id', $cid)
                                        ->first();
                
        if(session()->get('id') == $category['cat_usuario_fk']) {
                    
                return view("category/cat_add_edit", [ "vcategory" => $category ]);
                    
        } else {
                    
                    return redirect()->to('/');
                    
        }
        

    }


    
     public function delete(int $cid) 
     {
        
            if (!$cid) {
                
                throw new \CodeIgniter\Exceptions\PageNotFoundException("Link inexistente");
                
            }
        
            if ($this->categoryModel->delete($cid)) {

                return redirect()->to('/category/all');
            
            } else {
            
                return redirect()->to('/category/all');
            
            }

   
    }



    public function save()// category id save or update
    {

        $data   = $this->request->getPost();
            
        if ( !isset($data) || empty($data) ) { 
            
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Erro, dados de formulario vazio");
            
        } 

        if ( isset($data["uid"]) && session()->get('id') != $data["uid"] ) {
                
        return redirect()->to('/category/all');
    
        }

   
        if (isset($data["cid"])) { //update categoria

            $dataToSave = [ "id"               => $data["cid"],
                            "descricao"        => $data["descricao"],
                            "cat_usuario_fk"   => (int)session()->get("id")
                          ]; 
           
        } else {

            $dataToSave = [ "descricao"        => $data["descricao"],
                            "cat_usuario_fk"   => (int)session()->get("id")
                          ]; 
        }
      
               
        $request = $this->categoryModel->save($dataToSave);
       
        if ($request) {
        
              return redirect()->to('/category/all');

        } else {

           echo view('erro');
        } 

    }

}
