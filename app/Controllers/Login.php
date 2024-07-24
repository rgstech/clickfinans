<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


class Login extends BaseController
{


    function __construct()
    {
        helper('form');
    }

    public function index()
    {
        if (session()->logged == true) { //se ja tive logado vai para home / if user is already logged go to home page

            return redirect()->to(base_url("/"));

        } else {

            return view("access/login");
        }
        
         // return view("access/login");

    }



    public function signIn() //metodo singin para logar no sistema por sessão
    {
 
     
        $email    = $this->request->getPost('inputEmail');
        $password = $this->request->getPost('inputPassword');

        $usuarioModel = new UserModel();

        $dadosUsuario = $usuarioModel->getByEmail((string)$email);


        if (count($dadosUsuario) > 0) {

            $hashUsuario = $dadosUsuario['password'];

            if (password_verify((string)$password, $hashUsuario)) {

                session()->set('logged', true);
                session()->set('id',     $dadosUsuario['id']);
                session()->set('nome',   $dadosUsuario['nome']);
                session()->set('email',  $dadosUsuario['email']);
                session()->set('img',    $dadosUsuario['img_path']);
                session()->set('dt_cad', $dadosUsuario['dt_cadastro']);
               

                return redirect()->to(base_url("/"));

            } else {

                session()->setFlashData('msg', 'Usuario ou senha incorretos!');
                return redirect()->to('/login');
            }
        } else {

            session()->setFlashData('msg', 'Usuario ou senha incorretos!');

            return redirect()->to('/login');
        }
    }

    public function signOut()
    {

        session()->destroy();
        return redirect()->to(base_url("/"));

    }

}
