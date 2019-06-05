<?php 
    \Classes\ClassLayout::setHeadRestrito();
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

            <div class="col-lg-3 col-lx-2 d-none d-lg-block text-center">
                <a href="<?php echo DIRPAGE.'perfil'; ?>" class="navbar-user">
                    <img src="<?php echo DIRIMG.'dallas.jpg'; ?>" class="navbar-user-icon img-redonda-pequena" alt="Imagem de perfil">
                    Geovani
                </a>
            </div>
            <div class="col d-block d-lg-none text-center">
                <a href="<?php echo DIRPAGE.'perfil'; ?>" class="navbar-user">
                    <img src="<?php echo DIRIMG.'dallas.jpg'; ?>" class="navbar-user-icon img-redonda-pequena" alt="Imagem de perfil">
                </a>
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
                    <a href="<?php echo DIRPAGE.'perfil'; ?>" class="m-auto link"><img class="img-redonda" src="<?php echo DIRIMG.'dallas.jpg'; ?>" alt="Imagem de perfil"></a>
                </div>
                <div class="col-sm-10 d-none d-sm-inline p-0">
                    <div class="mt-3 mb-3 mr-3 pt-2 pb-2 pl-3 link input-r20" data-toggle="modal" data-target="#myModal">Qual a notícia?</div>
                </div>                        
            </div>

            <div class="row">
                <ul class="col-12 mb-0">
                    <li class="row border-b fundo-hover">
                        <div class="col-2 text-center p-0">
                            <a href="<?php echo DIRPAGE.'perfil/gustavo'; ?>" class="link"><img class="mt-3 img-redonda" src="<?php echo DIRIMG.'gustavo.jpg'; ?>" alt="Imagem de perfil"></a>
                        </div>

                        <div class="col-10 pl-0 pt-3 pb-3 pr-4">
                            <div class="row m-0 d-inline-block w-100">
                                <a class="float-left link" href="<?php echo DIRPAGE.'perfil/gustavo'; ?>"><p class="d-inline mr-2 font-weight-bold">Gustavo</p><p class="d-inline texto-secundario">@gustavo</p></a><p class="float-right mb-0">21/03/19 14:32</p>
                            </div>

                            <div class="row m-0 fr-view">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>

                            <div class="row mt-2 mb-0 ml-0 mr-0 justify-content-center">
                                <div class="col text-center">
                                    <div class="d-inline-block align-middle link" onmouseover="hover('share', 451)" onmouseout="hoverOut('share', 451)" onclick="compartilhar()">
                                        <img id="img-share-publi-451" class="icone-24" src="<?php echo DIRICONE.'compartilhar-off.svg'; ?>" alt="Compartilhar">
                                        <p id="p-share-publi-451" class="d-inline align-middle ml-2 cor-cinza">356</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-inline-block align-middle link" onmouseover="hover('like', 451)" onmouseout="hoverOut('like', 451)" onclick="curtir()">
                                        <img id="img-like-publi-451" class="icone-24" src="<?php echo DIRICONE.'curtir-off.svg'; ?>" alt="Curtir">
                                        <p id="p-like-publi-451" class="d-inline align-middle ml-2 cor-cinza">15</p>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
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
                            <li>
                                <a class="row border-b pt-2 pb-2 link fundo-hover" href="<?php echo DIRPAGE.'perfil/joao'; ?>">
                                    <div class="col-4 text-center m-auto">
                                        <img class="img-redonda-pequena" src="<?php echo DIRIMG.'joao.jpg'; ?>" alt="Imagem de perfil">
                                    </div>
                                    <div class="col-8 line-height-normal">
                                        <div class="row font-weight-bold">João</div>
                                        <div class="row texto-secundario">@joao</div>
                                    </div>
                                </a>                                            
                            </li>
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
                            <li>
                                <a class="row border-b pt-2 pb-2 link fundo-hover" href="<?php echo DIRPAGE.'perfil/julia'; ?>">
                                    <div class="col-4 text-center m-auto">
                                        <img class="img-redonda-pequena" src="<?php echo DIRIMG.'julia.jpg'; ?>" alt="Imagem de perfil">
                                    </div>
                                    <div class="col-8 line-height-normal">
                                        <div class="row font-weight-bold">Julia</div>
                                        <div class="row texto-secundario">@julia</div>
                                    </div>
                                </a>
                            </li>
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
                <textarea></textarea>
            </div>
                <div class="modal-footer">
                    <button type="button" class="login-botao">Publicar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php \Classes\ClassLayout::setFooter(TRUE); ?>