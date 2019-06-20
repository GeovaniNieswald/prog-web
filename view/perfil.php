<?php 
    \Classes\ClassLayout::setHeadRestrito('user');

    $usuarioParam = \Traits\TraitParseUrl::parseUrl(1);

    if ($usuarioParam == null) {
        echo "<script> (function() { window.location.href = '".DIRPAGE."404' }()); </script>";
    }

    use Model\UsuarioDAO;

    $usuarioDB = new UsuarioDAO();

    $usuario = $usuarioDB->consultarUsuarioPorUsuario($usuarioParam);

    if ($usuario == false) {
        echo "<script> (function() { window.location.href = '".DIRPAGE."404' }()); </script>";
    }

    $ehPerfilProprio = ($_SESSION['id'] == $usuario->getId());

    \Classes\ClassLayout::setHead($usuario->getNome()." (@".$usuario->getUsuario().") - Poligno News", 'Página de perfil', TRUE, 2); 
?>

<div class="container-fluid">
    <nav class="row fixed-top justify-content-center barra-top">
        <div class="row justify-content-center navbar-wrapper">
            <div class="col col-lg-1 text-center">
                <a href="<?php echo DIRPAGE.'home'; ?>"><img class="icone-32" src="<?php echo DIRICONE.'home-off.svg'; ?>" alt="Feed"></a>
            </div>

            <div class="col-lg-4 d-none d-lg-block"></div>

            <div class="col-lg-4 col-lx-5 d-none d-lg-block">
                <div class="form-group has-search">
                    <span class="form-control-feedback"></span>
                    <input type="text" class="form-control input-r20" placeholder="Buscar">
                </div>
            </div>
            <div class="col d-block d-lg-none text-center">
                <a href=""><img class="icone-32" src="<?php echo DIRICONE.'search-off.svg'; ?>" alt="Buscar"></a>
            </div>

            <div id="abrirSubMenu" class="col-lg-3 col-lx-2 d-none d-lg-block text-center">
                <nav class="menu">  
                    <ul>  
                        <li> 
                            <a href="#" class="navbar-user">
                                <img src="<?php echo ($_SESSION['imagem'] != null) ? DIRIMG.$_SESSION['imagem'].'.jpg' : DIRIMG.'user.svg'; ?>" class="navbar-user-icon img-redonda-pequena" alt="Imagem de perfil">
                                <?php echo $_SESSION['nome'] ?>
                            </a>
                            <ul id="subMenu">
                                <li onmouseover="hover('perfil', 0)" onmouseout="hoverOut('perfil', 0)">
                                    <a href="<?php echo DIRPAGE.'perfil/'.$_SESSION['usuario']; ?>" class="navbar-user">
                                        <img id="icon-perfil" class="icone-19 mr-3" src="<?php echo DIRICONE.'perfil-off.svg'; ?>" alt="Perfil">Perfil
                                    </a>
                                </li>
                                <li onmouseover="hover('sair', 0)" onmouseout="hoverOut('sair', 0)">
                                    <a href="<?php echo DIRPAGE.'controller/controllerLogout'; ?>" class="navbar-user">
                                        <img id="icon-sair" class="icone-19 mr-3" src="<?php echo DIRICONE.'sair-off.svg'; ?>" alt="Sair">Sair
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

            <div id="abrirSubMenuP" class="col d-block d-lg-none text-center">
                <nav class="menu">  
                    <ul>  
                        <li>
                            <a href="#" class="navbar-user"><img src="<?php echo ($_SESSION['imagem'] != null) ? DIRIMG.$_SESSION['imagem'].'.jpg' : DIRIMG.'user.svg'; ?>" class="navbar-user-icon img-redonda-pequena" alt="Imagem de perfil"></a>
                            <ul id="subMenuP">
                                <li onmouseover="hover('perfil', 0)" onmouseout="hoverOut('perfil', 0)">
                                    <a href="<?php echo DIRPAGE.'perfil/'.$_SESSION['usuario']; ?>" class="navbar-user">
                                        <img id="icon-p-perfil" class="icone-19 mr-3" src="<?php echo DIRICONE.'perfil-off.svg'; ?>" alt="Perfil">Perfil
                                    </a>
                                </li>
                                <li onmouseover="hover('sair', 0)" onmouseout="hoverOut('sair', 0)">
                                    <a href="<?php echo DIRPAGE.'controller/controllerLogout'; ?>" class="navbar-user">
                                        <img id="icon-p-sair" class="icone-19 mr-3" src="<?php echo DIRICONE.'sair-off.svg'; ?>" alt="Sair">Sair
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>				
    </nav>

    <div class="row justify-content-center container-feed">
        <div class="col-12 col-lg p-2 bg-white text-center">
            <div class="mx-auto d-block">
                <img src="<?php echo DIRIMG.'dallas400x400.jpg'; ?>" class="rounded-circle p-2 w-35" alt="Imagem de perfil">
                <h4 class="p-2 font-weight-bold">Geovani Alex Nieswald</h4>
            </div>

            <div class="d-inline-block p-2">
                <p><i class="fas fa-calendar-alt mr-1"></i>30/05/1996</p>
                <p><i class="fas fa-venus-mars mr-1"></i>Masculino</p>
                <p><i class="fas fa-mobile-alt mr-1"></i>55 99624-6352</p>
                <p><i class="fas fa-envelope mr-1"></i>geovaninieswald@gmail.com</p>
                <p><i class="fa fa-map mr-1"></i>Santa Rosa - RS</p>
                <p><i class="fa fa-address-book mr-1"></i>Estudante de Ciência da Computação</p>
            </div>
        </div>

        <div class="col-lg d-none d-lg-block espacamento"></div>

        <div class="col-lg d-none d-lg-block container-direita">
            <div class="row bg-white mb-2">
                <div class="col">
                    <div class="row border-b p-3 font-weight-bold">
                        Seguidores
                    </div>

                    <div class="row">
                        <ul class="col m-0">
                            <?php \Classes\ClassRelacionamento::setSeguidores($usuario->getId(), ($ehPerfilProprio) ? FALSE : TRUE); ?>
                        </ul>
                    </div>

                    <a href="" class="row pl-3 pt-2 pb-2 link-azul fundo-hover">
                        Mostrar mais
                    </a>
                </div>
            </div>

            <div class="row bg-white mb-3">
                <div class="col">
                    <div class="row border-b p-3 font-weight-bold">
                        Seguindo
                    </div>

                    <div class="row">
                        <ul class="col m-0">
                            <?php \Classes\ClassRelacionamento::setSeguindo($usuario->getId(), ($ehPerfilProprio) ? FALSE : TRUE); ?>
                        </ul>
                    </div>

                    <a href="" class="row pl-3 pt-2 pb-2 link-azul fundo-hover">
                        Mostrar mais
                    </a>
                </div>
            </div>             
        </div>
    </div>

    <div class="row justify-content-center mb-4 container-publi">
        <div class="col bg-white p-4">
            <div class="row text-center m-0">
                <h3 class="font-weight-bold m-auto">Publicações</h3>
            </div>

            <div class="row ml-0 mr-0 mt-4">
                <table class="w-100 text-center borda-left-right" rules="all" frame="hsides">
                    <tr>
                        <th>Data Hora</th>
                        <th>Resumo</th>
                        <?php echo ($ehPerfilProprio) ? "<th>Editar</th>" : ""; ?>                        
                        <?php echo ($ehPerfilProprio) ? "<th>Apagar</th>" : ""; ?>                        
                    </tr>
                    <?php \Classes\ClassFeed::setPubliComps($usuario->getId(), ($ehPerfilProprio) ? TRUE : FALSE); ?>
                </table>            
            </div>
        </div>
    </div>
</div>

<div class="modal fade pl-1 pr-1" id="myModal" role="dialog">
    <div class="modal-dialog container-feed">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close mt-auto mb-auto ml-0 mr-0 p-0" data-dismiss="modal">&times;</button>
                <h5 class="modal-title mt-auto mb-auto">Editar Publicação</h4>
            </div>
            <div class="modal-body">
                <div id="editor-p"></div>
            </div>
                <div class="modal-footer">
                    <button type="button" id="salvar" class="login-botao">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php \Classes\ClassLayout::setFooter(2); ?>