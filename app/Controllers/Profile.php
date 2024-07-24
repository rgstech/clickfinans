<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Account;

use App\Models\UserModel;


class Profile extends BaseController
{
    private $userModel;
    private $accountController;


    function __construct()
    {

        helper("mutil");
        helper("form");

        $this->userModel         = new UserModel();
        $this->accountController = new Account();

    }



    public function index()
    {
    }



    public function show()
    {

        $userData = $this->userModel->getById(session()->get('id'));

        return view("profile/profile_main", ["userData" => $userData]);
    }

  

    public function edit() 
    {

        $userData = $this->userModel->getById(session()->get('id'));

        return view("profile/profile_edit", ["userData" => $userData]);
    }
    



    public function remove()
    {

        return view("profile/profile_remove");

        
    }
    
    

    public function delete() // chamar ao confirmar delete
    {
        
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if ($this->accountController->exists($email , $password)) {
            
            if  ($this->userModel->delete(['id' => session()->get('id')])){
                session()->destroy();
                return view("account/sucessful_deleted");
            } else {
                return view("errors/error");
            }

        } else {
            echo "login errado, tente novamente";
        }
        
    }



    public function update() // chamar ao submter form da pagina de edição
    {
        
        $data = $this->request->getPost();
        
        $validationRule = [
            'nome'     => 'required|max_length[15]',
            'email'    => 'required|valid_email',
        ];
    
	
        if (count($data) == 0) { // array vazio significa que o usuario chamou o metodo fora do form ou com dados vazios 
            // entao volta para a tela de edião
            // empty array means the user call method outside form or with empty data so it return to edit page 
            return redirect()->to('profile/edit');
        } 
    
    
        if (!$this->validate($validationRule)) { // inicio if validação 
    
        
            return view('profile/profile_edit', ['errors' => $this->validator->getErrors()]);
    
        } else { 
        
    
            
                $dataToSave = [
                    'id'          => (int)session()->get('id'),
                    'nome'        => strtolower(str_replace(' ', '', $data['nome'])), 
                    'email'       => $data['email']	
                ];
    
    
                $result = $this->accountController->update($dataToSave);

             
    
                if($result) {
                    
                    return view('profile/profile_edit', ['msg' => 'Perfil atualizado com sucesso!',
                                                          'userData' => $dataToSave ]);
    
                } else {
    
                    return view('erros/error');
                }
    
    
            } // end  else validation


    

    }



    public function chpassword()
    {
        return view('profile/profile_chpass');
    }



    public function updatepassword() // update password/ atualiza senha/password
    {

          
        $data = $this->request->getPost();
        
        $validationRule = [
            'password' => 'required|min_length[4]',
			'passconf' => 'required|matches[password]',
        ];
    
	
        if (count($data) == 0) { // array vazio significa que o usuario chamou o metodo fora do form ou com dados vazios 
            // entao volta para a tela de onde estava
            // empty array means the user call method outside form or with empty data so it return to edit page 
            return redirect()->to('profile/chpassword');
        } 
    
    
        if (!$this->validate($validationRule)) { // inicio if validação 
    
        
            return view('profile/profile_chpass', ['errors' => $this->validator->getErrors()]);
    
        } else { 
        
    
            
                $dataToSave = [
                    'id'          => (int)session()->get('id'),
                    'password'    => password_hash((string)$data['password'], PASSWORD_DEFAULT),
                ];
    
    
                $result = $this->accountController->update($dataToSave);

             
    
                if($result) {
                    
                    return view('profile/profile_chpass', ['msg' => 'Senha atualizada com sucesso!']);
    
                } else {
    
                    return view('profile/profile_chpass', ['err_msg' => 'Erro ao atualizar sua senha, tente novamente ou contacte ao suporte']); //refatorar para chamar a mesma pagina com msg de error a ser mostrdado em uma div
                }
    
    
            } // end  else validation

            
    }
}
