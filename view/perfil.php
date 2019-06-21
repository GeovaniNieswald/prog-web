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

    use Model\RelacionamentoDAO;

    $relacionamentoDB = new RelacionamentoDAO();

    $voceSegue       = $relacionamentoDB->voceSegue($usuario->getId(), $_SESSION['id']);
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
                                <img src="<?php echo ($_SESSION['imagem'] != null) ? DIRIMG.$_SESSION['imagem'] : DIRIMG.'user.svg'; ?>" class="navbar-user-icon img-redonda-pequena" alt="Imagem de perfil">
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
                            <a href="#" class="navbar-user"><img src="<?php echo ($_SESSION['imagem'] != null) ? DIRIMG.$_SESSION['imagem'] : DIRIMG.'user.svg'; ?>" class="navbar-user-icon img-redonda-pequena" alt="Imagem de perfil"></a>
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
                <img src="<?php echo ($usuario->getImagem() != null) ? DIRIMG.$usuario->getImagem() : DIRIMG.'user.svg'; ?>" class="rounded-circle p-2 w-35" alt="Imagem de perfil">
                <h4 class="p-2 font-weight-bold"><?php echo $usuario->getNome()." ".$usuario->getSobrenome(); ?> </h4>
            </div>

            <div class="d-block p-2">
                <?php echo ($usuario->getNascimento() != null) ? "<p><i class='fas fa-calendar-alt mr-1'></i>".date_format(date_create($usuario->getNascimento()), 'd/m/Y')."</p>" : ""; ?>
                <?php echo ($usuario->getSexo() != null) ? "<p><i class='fas fa-venus-mars mr-1'></i>".(($usuario->getSexo() == "F") ? "Feminino" : "Masculino")."</p>" : ""; ?>
                <?php echo ($usuario->getCelular() != null) ? "<p><i class='fas fa-mobile-alt mr-1'></i>".$usuario->getCelular()."</p>" : ""; ?>
                <p><i class="fas fa-envelope mr-1"></i><?php echo $usuario->getEmail(); ?></p>
                <?php echo ($usuario->getCidade() != null) ? "<p><i class='fa fa-map mr-1'></i>".$usuario->getCidade()."</p>" : ""; ?>
                <?php echo ($usuario->getBio() != null) ? "<p class='mb-0' ><i class='fa fa-address-book mr-1'></i>".$usuario->getBio()."</p>" : ""; ?>
            </div>
            <?php 
                if (!$ehPerfilProprio) {
                    echo "<div class='d-block p-2 text-right'>\n";
                    echo "  <input type='hidden' id='idAlvo' value='".$usuario->getId()."'>\n";
                    echo "  <input type='hidden' id='idUsuario' value='".$_SESSION['id']."'>\n";
                    echo "  <button type='button' id='seguir' class='".(($voceSegue) ? 'seguindo-botao' : 'seguir-botao')."'>".(($voceSegue) ? 'Seguindo' : 'Seguir')."</button>\n";
                    echo "</div>\n";
                } else {
                    echo "<div class='d-block p-2 text-right'>\n";
                    echo "  <button type='button' data-toggle='modal' data-target='#myModalEditar' class='login-botao'>Editar</button>\n";
                    echo "</div>\n";
                }
            ?>
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

<div class="modal fade pl-1 pr-1" id="myModalEditar" role="dialog">
    <div class="modal-dialog container-feed">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close mt-auto mb-auto ml-0 mr-0 p-0" data-dismiss="modal">&times;</button>
                <h5 class="modal-title mt-auto mb-auto">Editar Perfil</h4>
            </div>

            <form id="formEditar" enctype="multipart/form-data" method="POST" action="<?php echo DIRPAGE.'controller/controllerPerfil'; ?>">
                <div class="modal-body">
                    <div class="row ml-0 mr-0 mb-4">
                        <div class="image-upload p-2 m-auto mw-25 align-center">
                            <label for="file-input" class="m-auto">
                                <img id="imgPerfil" src="<?php echo ($usuario->getImagem() != null) ? DIRIMG.$usuario->getImagem() : DIRIMG.'user.svg'; ?>" class="rounded-circle w-100" alt="Imagem de perfil">
                            </label>

                            <input id="file-input" name="imagem" type="file">
                        </div>
                    </div>

                    <div class="row ml-0 mr-0 mb-3">
                        <div class="col-6 p-1">
                            <p class="editar-campos m-0">Nome:</p> 
                             
                            <input class="login-dados w-100" type="text" name="nome" placeholder="Nome" value="<?php echo $usuario->getNome() ?>" required autofocus>
                        </div>

                        <div class="col-6 p-1">
                            <p class="editar-campos m-0">Sobrenome:</p> 

                            <input class="login-dados w-100" type="text" name="sobrenome" placeholder="Sobrenome" value="<?php echo $usuario->getSobrenome() ?>" required>
                        </div>
                    </div>

                    <div class="row ml-0 mr-0 mb-3">
                        <div class="col-6 p-1">
                            <p class="editar-campos m-0">Nascimento:</p> 
                             
                            <input class="login-dados w-100" type="text" id="nascimento" name="nascimento" value="<?php echo $usuario->getNascimento() != null ? date("d/m/Y", strtotime($usuario->getNascimento())) : "" ?>">
                        </div>

                        <div class="col-6 p-1">
                            <p class="editar-campos m-0">Sexo:</p> 
                            
                            <select class="login-dados w-100" name="sexo">
                                <option value="">Selecione</option>
                                <option value="M" <?php echo (($usuario->getSexo() == 'M') ? "selected" : "") ?>>Masculino</option>
                                <option value="F" <?php echo (($usuario->getSexo() == 'F') ? "selected" : "") ?>>Feminino</option>
                            </select>
                        </div>                
                    </div>

                    <div class="row ml-0 mr-0 mb-3">
                        <div class="col-6 p-1">
                            <p class="editar-campos m-0">Celular:</p> 

                            <input class="login-dados w-100" type="text" id="celular" name="celular" value="<?php echo $usuario->getCelular() ?>">
                        </div>

                        <div class="col-6 p-1">
                            <p class="editar-campos m-0">Cidade:</p> 
                            
                            <input class="login-dados w-100" type="text" id="cidade" name="cidade" value="<?php echo $usuario->getCidade() ?>">
                        </div>                
                    </div>
                    
                    <div class="row ml-0 mr-0 mb-0">
                        <textarea class="w-100" rows="5" name="bio" placeholder="Bio"><?php echo $usuario->getBio()?></textarea>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <input type="hidden" name="email" value="<?php echo $_SESSION['email']?>">
                    <button type="submit" class="login-botao">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php \Classes\ClassLayout::setFooter(2); ?>