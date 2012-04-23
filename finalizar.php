<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Css Sprite Helper</title>
    <meta name="description" content="Aplicacion generadora de css-sprites. Potenciado por jquery y bootstrap">
    <meta name="author" content="dediez.es">

    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Soporte para ie6-8 de elementos html5 -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="container">
  		<!-- Barra de navegacion -->
  		<div class="navbar">
		  	<div class="navbar-inner">
		    	<div class="container">
		      		<a class="brand" href="#">
					  css-sprite @ dediez.es
					</a>
		    	</div>
		  	</div>
		</div>
		<!-- Breadcrump -->
		<ul class="breadcrumb">
			  <li><a href="./index.php">Inicio</a> <span class="divider">/</span></li>
			  <li class="active">
			    	Formulario
			  </li>
		</ul>
		<!-- Contenido -->
		<h1>Resultado</h1>
		<?php
		if(!isset($_POST['names'])){
			?><div class="alert alert-error">Ha ocurrido un error</div><?php
		}else{
			$nombres = $_POST['names'];
			
		}
		
		
		?>
		
  	</div>

	<!-- Cargamos las librerias javascript al final para que la pagina cargue mas rapido -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>
