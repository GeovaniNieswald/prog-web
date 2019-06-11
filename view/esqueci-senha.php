<?php \Classes\ClassLayout::setHead('Esqueci Minha Senha - Poligno News', 'Recuperar senha'); ?>

<div class="wrapper">
	<div class="container-fluid"> 
		<navbar class="row fixed-top justify-content-center barra-top">
			<div class="col text-center">
				<img class="icone-32" src="<?php echo DIRICONE.'logo.svg'; ?>" alt="Logo">
			</div>
		</navbar>

		<div class="row align-self justify-content-center">
			<div class="d-none d-xl-block col-xl-3 text-center">
				<img src="<?php echo DIRIMG.'img-decorativa.png'; ?>" alt="Imagem decorativa">
			</div>	

			<div class="d-none d-xl-block col-xl-1 text-center"></div>	

			<div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 text-center d-flex align-content-center flex-wrap bg-white p-4">
				<div class="w-100">
					<div class="text-left pb-3">
						<div class="login-titulo">Solicite uma Nova Senha</div>
						<div class="login-link">ou volte para a tela de <a class="link-azul" href="<?php echo DIRPAGE.'index'; ?>">login</a></div>
					</div>
					<div>
						<form id="formSenha" class="login-form mt-4" method="POST" action="<?php echo DIRPAGE.'controller/controllerSenha'; ?>">
							<input class="login-dados mb-5" type="email" name="email" placeholder="E-mail">
							
							<button class="login-botao" type="submit">Solicitar</button>								
						</form>												
					</div>
				</div>
			</div>
		</div>

		<footer class="row fixed-bottom justify-content-center barra-bottom">
			<div class="col text-center">
				<p class="p-0 m-0 texto-secundario">Copyright &copy; 2019 Poligno News - Todos os direitos reservados</p>
			</div>
		</footer>
	</div>
</div>

<?php \Classes\ClassLayout::setFooter(); ?>