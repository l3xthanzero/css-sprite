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
		<h1>Formulario para subir nuestra(s) imagenes</h1>
		<form action="./renombrar.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="span4">
					<label>Número de iconos en horizontal</label>
					<select name="iconos_horizontal">
						<?php for($i=1; $i<25; $i++){
							?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php
						} ?>
					</select>
				</div>
				<div class="span4">
					<label>Número de iconos en vertical</label>
					<select name="iconos_vertical">
						<?php for($i=1; $i<25; $i++){
							?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php
						} ?>
					</select>
				</div>
				<div class="span4">
					<label>¿Son los iconos cuadrados?</label>
					<select name="iconos_cuadrados">
						<option value="1">Sí</option>
						<option value="2">No</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<label>Elige la imagen</label>
					<input id="maxfiles" type="file" name="files[]" multiple max="100" />
				</div>
			</div>
			<div class="row">
				<div class="span2 pull-right">
					<button class="btn btn-success">Siguiente</button>
				</div>
			</div>
		</form>
		<div class="alert alert-info">
			Puedes subir una única imagen con todos los iconos o prueba a subir todos los iconos separados a la vez para crear tanto la imagen conjunta como el código css.<br>
			<br>
			Para subir más de 20 imagenes debes modificar el fichero php.ini de tu servidor (en la carpeta etc de xampp) y añadir max_file_uploads = 100 o la cantidad que queramos y reiniciar apache.
		</div>
  	</div>

	<!-- Cargamos las librerias javascript al final para que la pagina cargue mas rapido -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>
