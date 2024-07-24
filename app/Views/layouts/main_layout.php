<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"    content="width=device-width, initial-scale=1.0" />
    <meta name="author"      content="Rodrigo Guimaraes" />
    <meta name="description" content="ClickFinans" />
    <meta name="keywords"    content="controle financeiro, financeiro, clickfinans" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
          crossorigin="anonymous">
    



  
 
          <link rel="stylesheet" href="<?= base_url('public/css/main.css') ?>" /> 
    <script src="<?= base_url('public/js/main.js') ?>"></script>
    <title> ClickFinans </title> 

</head>

<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><img src="<?= base_url('public/images/icons/dollar1.png') ?>" style="width:38px;height:38px;" alt="dollar"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item <?php  if( get_controller_name() == "Home" && get_method_name() == "index") echo "active"; else echo ""; ?> ">
                        <a class="nav-link" href="<?= base_url('/') ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown <?php  if( get_controller_name() == "Expense" && get_method_name() == "showExpenses") echo "active"; else echo ""; ?> ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Despesas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">     
                            <a class="dropdown-item" href="<?= base_url('/expense/all') ?>">Controle</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('/category/all') ?>">Categorias</a>
                        </div> 
                    </li>
                    <li class="nav-item dropdown <?php  if( get_controller_name() == "Profile" && get_method_name() == "show") echo "active"; else echo ""; ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Meu Perfil
                            </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= base_url('profile/show') ?>">Gerenciar Perfil</a> 
                                <!-- <div class="dropdown-divider"></div> -->
                            </div>             
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/login/signOut') ?>">Sair</a>
                    </li> 
                    <!-- <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li> -->
                    </ul>
                 <!--   <div class="collapse navbar-collapse justify-content-end" style="margin-right: 7%;" id="navbar-list-4"> start profile img 
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle">
                                </a>
                              
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="margin-right:15%;">
                            
                                <a class="dropdown-item" href="#">Editar Perfil</a>
                                <a class="dropdown-item" href="#">Sair</a>
                                </div>
                            </li>
                        </ul> 
                        </div>  end profile img-->

                <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Digite um termo aqui...">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form> -->
            </div>  
        </nav>
    </header>

      
    <div class="container-fluid">
        <!---------------------------------------------- SEÇÃO PRINCIPAL -------------------------------------------------->

        <?= $this->renderSection('content') ?>

        <!-------------------------------------------- FIM SEÇÃO PRINCIPAL ---------------------------------------------->
        <hr>
        <div id="rodape">
            <footer>
                ClickFinans Copyright 2022
            </footer>
        </div>
    </div>


    <!-- <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" 
            crossorigin="anonymous"></script>
    <script src="<?= base_url('public/js/jquery.maskMoney.js') ?>"></script>

    <script>
    
        $(".vcurrency").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
    
    </script>
            
</body>

</html>