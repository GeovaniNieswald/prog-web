<?php 
    \Classes\ClassLayout::setHeadInicial();
    \Classes\ClassLayout::setHead('Cadastro - Poligno News', 'Página de cadastro'); 
?>

<div class="wrapper">
    <div class="container-fluid m-auto"> 
        <nav class="row fixed-top justify-content-center barra-top">
            <div class="col text-center">
                <img class="icone-32" src="<?php echo DIRICONE.'logo.svg'; ?>" alt="Logo">
            </div>
        </nav>

        <div class="row justify-content-center pl-2 pr-2 container-cadastro">
            <div class="col-12 col-sm-11 col-md-9 col-lg-7 col-xl-4 bg-white p-4">		
                <div class="row text-left m-0">
                    <p class="login-titulo m-0">Crie sua Conta do Poligno News</p>
                </div>
                <div class="row text-left  ml-0 mr-0 mb-3">
                    <p class="login-link m-0">ou volte para a tela de <a class="link-azul" href="<?php echo DIRPAGE.'index'; ?>">login</a></p>
                </div>
                <div class="row m-0">
                    <form id="formCadastro" class="col p-0" method="POST" action="<?php echo DIRPAGE.'controller/controllerCadastro'; ?>">
                        <div class="row ml-0 mr-0 mb-3">
                            <input class="login-dados mr-1 cad-w-c-50" type="text" name="nome" placeholder="Nome" required autofocus>
                            <input class="login-dados cad-w-c-50" type="text" name="sobrenome" placeholder="Sobrenome" required>
                        </div>

                        <div class="row ml-0 mr-0 mb-3">
                            <input class="login-dados w-100" type="email" name="email" placeholder="E-mail" required>
                        </div>
                        
                        <div class="row ml-0 mr-0 mb-3 align-items-center">
                            <img src="recursos/icones/arroba.svg" class="icone-24 mr-2" alt="Arroba">
                            <input class="login-dados cad-w-c-100" type="text" name="usuario" placeholder="Usuário" required>
                        </div>

                        <div class="row ml-0 mr-0 mb-4">
                            <input class="login-dados mr-1 cad-w-c-50" type="password" name="senha" placeholder="Senha" required>
                            <input class="login-dados cad-w-c-50" type="password" name="senhaConf" placeholder="Confirmar Senha" required>
                        </div>

                        <div class="row m-0"><button class="login-botao w-100" type="submit">Cadastrar</button></div>                           								
                    </form>						
                </div>					
            </div>

            <div class="d-none d-xl-block col-xl-1 text-center"></div>	
            
            <div class="d-none d-xl-flex col-xl-3 text-center">
                <img class="m-auto" src="<?php echo DIRIMG.'img-decorativa.png'; ?>" alt="Imagem decorativa">
            </div>	
        </div>
        
        <footer class="row fixed-bottom justify-content-center barra-bottom">
            <div class="col text-center">
                <p class="p-0 m-0 texto-secundario">Copyright &copy; 2019 Poligno News</p>
            </div>
        </footer>
    </div>
</div>

<?php \Classes\ClassLayout::setFooter(); ?>