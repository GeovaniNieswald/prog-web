<?php 
	\Classes\ClassLayout::setHeadInicial();
	\Classes\ClassLayout::setHead('Login - Poligno News', 'Página de login'); 
?>

<div class="wrapper">
	<div class="container-fluid"> 
		<nav class="row fixed-top justify-content-center barra-top">
			<div class="col text-center">
				<img class="icone-32" src="<?php echo DIRICONE.'logo.svg'; ?>" alt="Logo">
			</div>
		</nav>

		<div class="row align-self justify-content-center">
			<div class="d-none d-xl-block col-xl-3 text-center">
				<img src="<?php echo DIRIMG.'img-decorativa.png'; ?>" alt="Imagem decorativa">
			</div>	

			<div class="d-none d-xl-block col-xl-1 text-center"></div>	

			<div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 text-center d-flex align-content-center flex-wrap bg-white p-4">
				<div class="w-100">
					<div class="text-left pb-3">
						<div class="login-titulo">Acesse</div>
						<div class="login-link">sua conta Poligno News ou <a class="link-azul" href="<?php echo DIRPAGE.'cadastro'; ?>">crie uma nova conta</a></div>
					</div>
					<div>
						<form id="formLogin" class="login-form" method="POST" action="<?php echo DIRPAGE.'controller/controllerLogin'; ?>">
							<input class="login-dados mb-3" type="email" autofocus name="email" placeholder="E-mail">
							<input class="login-dados mb-3" type="password" name="senha" placeholder="Senha">
							<label class="login-lembrar-texto">
								<input class="login-lembrar-check" type="checkbox" name="lembrar" checked value="true">Lembrar meus dados
							</label>
							<button class="login-botao" type="submit">Acessar conta</button>								
						</form>
						
						<div class="text-left"><a class="link-azul" href="<?php echo DIRPAGE.'esqueci-senha'; ?>">Esqueceu a senha?</a></div>							
					</div>
				</div>
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