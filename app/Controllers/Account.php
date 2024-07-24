<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;


class Account extends BaseController
{
	private $usuariosModel;
    
	public function index(){ }



	function __construct()
	{
	    helper('form');

		$this->usuariosModel = new UserModel(); 
	}



	public function signup()
	{

		if (session()->isLoggedIn == true) { //se ja tive logado vai para home / if user is already logged got to home page

			return redirect()->to('/');
		}

		return view('account/signup');
	}



	public function createAccount()
	{

		$validationRule = [
			'userfile'  => [
				'label' => 'Image File',
				'rules' => 'uploaded[arquivo]'
					    . '|is_image[arquivo]'
					    . '|mime_in[arquivo,image/jpg,image/jpeg]'
					    . '|max_size[arquivo,30]'
					    . '|max_dims[arquivo,200,200]',
			],
			'nome'     => 'required|max_length[15]',
			'password' => 'required|min_length[4]',
			'passconf' => 'required|matches[password]',
			'email'    => 'required|valid_email',
		
		];



		$data = $this->request->getPost(); //pega todos os campos
        
		
		if (count($data) == 0) { // array vazio significa que o usuario chamou o metodo fora do form ou com dados vazios 
			// entao volta para a home 
			// empty array means the user call method outside form or with empty data so it return to home 
			return redirect()->to('/');
		}

		$arquivo  = ($this->request->getFile('arquivo')) ? $this->request->getFile('arquivo') : null; //verficar se o arquivo valido/ verify if file is valid
		$filePath = '';


		$myTime = new Time('now', 'America/Recife', 'pt_BR');

		
		if (!$this->validate($validationRule)) { // inicio if validação 

			$data = ['errors' => $this->validator->getErrors()];
			return view('account/signup', $data);

		} else {


			if ($arquivo && !$arquivo->isValid()) {

				return view('account/signup');

			} elseif ($arquivo && $arquivo->isValid() && !$arquivo->hasMoved()) {

				$arquivo->move(ROOTPATH . 'public/images/profile', (string)$data['nome'] . '.' . $arquivo->getClientExtension());

				$filePath = 'images/profile/' . (string)$data['nome'] . '.' . $arquivo->getClientExtension();

			}


			
			$dataToSave = [

				'nome'        => strtolower(str_replace(' ', '', $data['nome'])), //str_replace(' ', '', $string);
				'email'       => $data['email'],
				'password'    => password_hash((string)$data['password'], PASSWORD_DEFAULT),
				'img_path'    => (string)$filePath,
				'dt_cadastro' => ((array)$myTime)['date']
				
			];


			$result = $this->usuariosModel->save($dataToSave);

			if($result) {
				
				return view('account/sucessful_created');

			} else {

	            return view('erros/error');
				
			}


		} // end  else validation 

	} //end createAccount



   public function delete(int $uid){ }



   public function exists($email , $password) : bool 
   {

       $usuarioModel = new UserModel();

	   $dadosUsuario = $usuarioModel->getByEmail((string)$email);


	   if (count($dadosUsuario) > 0) {

	       $hashUsuario = $dadosUsuario['password'];

		    if (password_verify($password, $hashUsuario)) {

	
		        return true;


		} else {

		    return false;
		}
	  } else {

		return false;
	}

   }



   public function update(array $data)
   {
       return $this->usuariosModel->save($data);

   }





   }




    

