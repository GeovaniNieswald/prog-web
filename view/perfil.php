<?php 
    \Classes\ClassLayout::setHeadRestrito();
    \Classes\ClassLayout::setHead('Geovani (@dallas) - Poligno News', 'Página de perfil', TRUE, FALSE); 
?>

<div class="container-fluid">
    <navbar class="row fixed-top justify-content-center barra-top">
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
    </div>

    <div class="row justify-content-center mb-4 container-publi">
        <div class="col bg-white p-4">
            <div class="row text-center m-0">
                <h3 class="font-weight-bold m-auto">Minhas Publicações</h3>
            </div>

            <div class="row ml-0 mr-0 mt-4">
                <table class="w-100 text-center borda-left-right" rules="all" frame="hsides">
                    <tr>
                        <th>Id</th>
                        <th>Resumo</th>
                        <th>Data</th>
                        <th>Ver</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Lorem Ipsum is simply dummy text of...</td>
                        <td>05/04/2019</td>
                        <td><a href="" class="link-azul"><i class="fas fa-external-link-alt"></i></a></td>
                    </tr>
                </table>            
            </div>
        </div>
    </div>
</div>

<?php \Classes\ClassLayout::setFooter(); ?>