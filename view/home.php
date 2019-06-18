<?php 
    \Classes\ClassLayout::setHeadRestrito('user');
    \Classes\ClassLayout::setHead('Feed - Poligno News', 'Página de feed', FALSE, TRUE); 
?>

<div class="container-fluid p-0"> 
    <navbar class="row fixed-top justify-content-center barra-top">
        <div class="row justify-content-center navbar-wrapper">
            <div class="col col-lg-1 text-center">
                <a href="<?php echo DIRPAGE.'home'; ?>"><img class="icone-32" src="<?php echo DIRICONE.'home.svg'; ?>" alt="Feed"></a>
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
                                    <a href="<?php echo DIRPAGE.'perfil'; ?>" class="navbar-user">
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
                                    <a href="<?php echo DIRPAGE.'perfil'; ?>" class="navbar-user">
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
    </navbar>

    <div id="feed-container" class="row justify-content-center container-feed">
        <div class="col-12 col-lg bg-white">
            <div class="row border-b">
                <h2 class="m-3 h5 font-weight-bold">Feed</h2>
            </div>

            <div class="row border-b">
                <div class="col-sm-2 d-none d-sm-flex ">
                    <a href="<?php echo DIRPAGE.'perfil'; ?>" class="m-auto link"><img class="img-redonda" src="<?php echo ($_SESSION['imagem'] != null) ? DIRIMG.$_SESSION['imagem'].'.jpg' : DIRIMG.'user.svg'; ?>" alt="Imagem de perfil"></a>
                </div>
                <div class="col-sm-10 d-none d-sm-inline p-0">
                    <div class="mt-3 mb-3 mr-3 pt-2 pb-2 pl-3 link input-r20" data-toggle="modal" data-target="#myModal">Qual a notícia?</div>
                </div>                        
            </div>

            <div class="row">
                <ul class="col-12 mb-0">
                    <?php \Classes\ClassFeed::setFeed($_SESSION['id']); ?>
                </ul>                        
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
                            <?php \Classes\ClassRelacionamento::setSeguidores($_SESSION['id']); ?>
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
                            <?php \Classes\ClassRelacionamento::setSeguindo($_SESSION['id']); ?>
                        </ul>
                    </div>

                    <a href="" class="row pl-3 pt-2 pb-2 link-azul fundo-hover">
                        Mostrar mais
                    </a>
                </div>
            </div>             
        </div>

        <div id="botao-fixo" class="botao-fixo" data-toggle="modal" data-target="#myModal">
            <div class="row pt-2 pb-2 pl-4 pr-4">
                <div class="col d-flex p-0">
                    <img class="ml-3 mr-3 icone-32" src="<?php echo DIRICONE.'publicar.svg'; ?>">
                </div>
                <div class="d-none col-sm d-sm-flex p-0">
                    <p class="mt-auto mb-auto mr-3 font-weight-bold text-white">Publicar</p>
                </div>
            </div>
        </div>
    </div>        
</div>

<div class="modal fade pl-1 pr-1" id="myModal" role="dialog">
    <div class="modal-dialog container-feed">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close mt-auto mb-auto ml-0 mr-0 p-0" data-dismiss="modal">&times;</button>
                <h5 class="modal-title mt-auto mb-auto">Qual a notícia?</h4>
            </div>
            <div class="modal-body">
                <div id="editor"></div>
            </div>
                <div class="modal-footer">
                    <button  onclick="publicar(<?php echo $_SESSION['id']; ?>)" type="button" class="login-botao">Publicar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php \Classes\ClassLayout::setFooter(TRUE); ?>