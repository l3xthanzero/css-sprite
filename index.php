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
			  <li class="active">
			    	Inicio
			  </li>
		</ul>
		<!-- Contenido -->
		<h1>Bienvenido al proyecto css-sprite</h1>
		<div class="row">
			<div class="span12">
				<p>Este es el resultado final del proyecto "css-sprite" creado en <a href="dediez.es">dediez.es</a>.</p>
				<p>La idea detrás de este proyecto es ayudarnos a agilizar nuestras páginas usando la técnica de css-sprite para tener todos los iconos de nuestra página en una misma imagen.</p>
				<p>La aplicación trata de ahorrarnos el trabajo de crear el código css necesario para aplicar esta técnica.</p>
				<a href="./formulario.php" class="btn btn-primary">Empezar</a>
			</div>
		</div>
  	</div>

	<!-- Cargamos las librerias javascript al final para que la pagina cargue mas rapido -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>
