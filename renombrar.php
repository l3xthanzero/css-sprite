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
			  <li><a href="./formulario.php">Formulario</a> <span class="divider">/</span></li>
			  <li class="active">
			    	Renombrar
			  </li>
		</ul>
		<!-- Contenido -->
		<h1>Renombrar clases</h1>
		<?php
		//Comprobamos si se han subido correctamente los datos
		
		if(isset($_POST['names'])){
			$nombres = $_POST['names'];
			$iconos_horizontal = $_POST['iconos_horizontal'];
			$iconos_vertical = $_POST['iconos_vertical'];
			$iconos_cuadrados = $_POST['iconos_cuadrados'];
		}else if(!isset($_POST['iconos_horizontal']) || !isset($_POST['iconos_vertical']) || !isset($_POST['iconos_cuadrados'])){
			 ?><div class="alert alert-error">Debes de enviar el <a href="./formulario.php">formulario</a> para acceder a esta pantalla</div><?php
		}else if(!is_array($_FILES['files']['name']) || count($_FILES['files']['name']) == 0){
			//Si no hemos subido ningun archivo
			?><div class="alert alert-error">Debes subir al menos una imagen</div><?php
		}else{
			//Si el formulario esta correcto comprobamos los datos enviados
			$imagenes = array(); //almacenaremos las imagenes correctas
			
			for($i=0; $i<count($_FILES['files']['name']); $i++){
				//Comprobamos si hay errores
			    if($_FILES['files']['error'][$i] != 0){
			        //Si hay algun error pasamos a la siguiente
			        ?><div class="alert alert-error">La imagen <?php echo $_FILES['files']['name'][$i]; ?> no se ha subido correctamente</div><?php
			        continue;
			    }
			    
			    //Realizamos las comprobaciones necesarias para nuestra aplicacion
			    //Solo para el caso de ser una imagen
			    $info = @getimagesize($_FILES['files']['tmp_name'][$i]);    
			    
			    //Si no podemos obtener la informacion de la imagen es incorrecta
			    if($info == FALSE){
			    	?><div class="alert alert-error">El archivo <?php echo $_FILES['files']['name'][$i]; ?> no es una imagen correcta</div><?php
			        continue;
			    }
			    
			    //Comprobamos el tamaño de la imagen
			    $ancho = $info[0];
			    $alto = $info[1];
			    
			    if($ancho < 1 && $alto < 1){
			    	?><div class="alert alert-error">La imagen <?php echo $_FILES['files']['name'][$i]; ?> es demasiado pequeña</div><?php
			        continue;
			    }
			    
			    //Comprobamos el tipo de la imagen
			    switch($info['mime']){
			        case 'image/png':
			            $image = imagecreatefrompng($_FILES['files']['tmp_name'][$i]);
			            break;
			        case 'image/jpeg':
			            $image = imagecreatefromjpeg($_FILES['files']['tmp_name'][$i]);
			            break;
			        case 'image/gif':
			            $image = imagecreatefromgif($_FILES['files']['tmp_name'][$i]);
			            break;
			        default:
			            //Para cualquier tipo distinto
			           	$image = FALSE;
			            break;
			    }
			    
			    //Si no se ha creado la imagen 
			    if($image == FALSE){
			    	?><div class="alert alert-error">La imagen <?php echo $_FILES['files']['name'][$i]; ?> contiene errores</div><?php
			        continue;
			    }
			    
				$aux = explode('.',$_FILES['files']['name'][$i]);
				
				//Sustituimos la extension original por .png
				$aux[count($aux)-1] = 'png';
				
				$nombre_imagen = implode('.', $aux);
				
			    //Si hemos llegado hasta aqui tenemos una imagen correcta y podemos hacer
			    //con ella lo que necesitemos por ejemplo la grabamos como jpg
			    if(imagepng($image, './upload/' . $nombre_imagen)){
			    	$imagenes[] = $nombre_imagen;
			    }else{
			    	?><div class="alert alert-error">La imagen <?php echo $_FILES['files']['name'][$i]; ?> no se ha grabado correctamente</div><?php
			    }
			}

			//Una vez tenemos todas las imagenes subidas comprobamos su numero
			if(count($imagenes) == 0){
				?><div class="alert alert-error">No se ha podido subir correctamente ninguna imagen</div><?php
			}else{
				if(count($_FILES['files']['name'])>1){
					//Se han subido mas de una imagen creamos la imagen css-sprite
					//Calculamos el tamaño total
					$tamx = 0; //tamaño maximo de icono en horizontal
					$tamy = 0; //tamaño maximo de icono en vertical
					foreach($imagenes as $imagen){
						$r = getimagesize('./upload/' . $imagen);
						
						if($r[0]>$tamx){
							$tamx = $r[0];
						}
						
						if($r[1]>$tamy){
							$tamy = $r[1];
						}
					}
					$tamx += 2;//Añadimos dos pixels de espacio para no solapar iconos horizontalmente
					$tamy += 2;//Añadimos dos pixels de espacio para no solapar iconos verticalmente
					
					$n_iconos = count($imagenes); //numero de iconos disponibles
					
					//Obtenemos el numero de imagenes
					$iconos_horizontal = ceil(sqrt($n_iconos));
					$iconos_vertical = floor(sqrt($n_iconos));
					$iconos_cuadrados = 0;
					
					$ancho_imagen = $iconos_horizontal * $tamx;
					$alto_imagen = $iconos_vertical * $tamy;
					
					//Creamos una imagen grande para contenerlas a todas 
					$image = imagecreatetruecolor($ancho_imagen, $alto_imagen);
					
					//Fondo transparente
					$negro = imagecolorallocate($image, 0, 0, 0);
					imagecolortransparent($image, $negro);
					
					$nombres = array(); //Almacenaremos los nombres de los iconos para usarlos como base
					
					$x = 0;
					$y = 0;
					foreach($imagenes as $i => $nombre_imagen){
						$image_cp = imagecreatefrompng('./upload/' . $nombre_imagen);
						
						$posx = $x * $tamx; //donde copiamos coordenada horizontal
						$posy = $y * $tamy; //donde copiamos coordenada vertical
						
						imagecopy($image,$image_cp,$posx,$posy,0,0,$tamx,$tamy);
						
						//Añadimos los nombres quitando acentos, ñ, extension, ... para que valga para nombre de clase
						$nombres[$x][$y] = str_replace(explode(';',' ;ñ;Ñ;á;Á;é;É;í;Í;ó;Ó;ú;Ú;.png'), explode(';','_;n;N;a;A;e;E;i;I;o;O;u;U;'), $nombre_imagen);

						//Borramos la imagen del icono que acabamos de añadir
						unlink('./upload/' . $nombre_imagen);

						//Recorremos las columnas o saltamos a la siguiente fila
						if($x>0 && ((($x+1)%$iconos_horizontal) == 0)){
							$x = 0;
							$y++;
						}else{
							$x++;
						}		
					}
					
					//Ya tenemos nuestra imagen global
					imagepng($image,'./upload/css-sprite.png');					
				}else{
					$image = imagecreatefrompng('./upload/'.$imagenes[0]);
					
					imagepng($image,'./upload/css-sprite.png');
					
					//Creamos los nombres a partir de los indices
					$iconos_horizontal = $_POST['iconos_horizontal'];
					$iconos_vertical = $_POST['iconos_vertical'];
					$iconos_cuadrados = $_POST['iconos_cuadrados'];
					
					$nombres = array();
					for($i = 0; $i<$iconos_horizontal; $i++){
						for($j = 0; $j<$iconos_vertical; $j++){
							$nombres[$i][$j] = "{$i}_{$j}";
						}
					}
				}
			}
		}

		if(isset($nombres) && count($nombres)>0){
			$nombre_fichero = 'css-sprite.png';
			$ruta_fichero = './upload/' . $nombre_fichero;
			
			$info = getimagesize($ruta_fichero);
			$image = imagecreatefrompng($ruta_fichero);
			
			$ancho = $info[0];
			$alto = $info[1];
			
			//Calculamos numero de iconos en horizontal y vertical
			$ancho_icono = $ancho/$iconos_horizontal;
			$alto_icono = $alto/$iconos_vertical;
			
			//Si los iconos son cuadrados corregimos posibles errores
			$recorte_v = 0;
		    $recorte_h = 0;
			
			if($iconos_cuadrados){
			    if($ancho_icono>$alto_icono){
			        //Recortar horizontalmente
			        $ancho_icono = $alto_icono;
			        
			        $recorte_h = $ancho-($ancho_icono*$iconos_horizontal);
			        $recorte_v = 0;
			    }else if($alto_icono>$ancho_icono){
			        //Recortar verticalmente
			        $alto_icono = $ancho_icono;
			        
			        $recorte_v = $alto-($alto_icono*$iconos_vertical);
			        $recorte_h = 0;
			    }
			}
			
			//Icono de salto de linea
			$salto_linea = "\r\n";
			
			//Capturamos la siguiente salida para
			$css = '';
			$css .= '[class^="icono-"], [class*=" icono-"] {' . $salto_linea;
			$css .= "display: inline-block;{$salto_linea}";
			$css .= "width: {$ancho_icono}px;{$salto_linea}";
			$css .= "height: {$alto_icono}px;{$salto_linea}";
			$css .= "background-image: url(\"{$ruta_fichero}\");{$salto_linea}";
			$css .= "background-repeat: no-repeat; }{$salto_linea}";
			
			foreach($nombres as $x => $array){
				foreach($array as $y => $nombre){
					$posx = ($recorte_h/2)+($ancho_icono*$x);
	                $posy = ($recorte_v/2)+($alto_icono*$y);
			        $css .= ".icono-{$nombres[$x][$y]}{ background-position: -{$posx}px -{$posy}px; }{$salto_linea}";
				}
			}
			
			?><style><?php echo $css; ?></style>
			
			<form name="renombrar" action="./renombrar.php" method="POST">
				<input type="hidden" name="iconos_cuadrados" value="<?php echo $iconos_cuadrados; ?>" />
				<input type="hidden" name="iconos_horizontal" value="<?php echo $iconos_horizontal; ?>" />
				<input type="hidden" name="iconos_vertical" value="<?php echo $iconos_vertical; ?>" />
				<div class="row">
				<?php
				foreach($nombres as $x => $array){
					foreach($array as $y => $nombre){
						include('icono.php');
					}
				}
				?>
				</div>
				<div style="display:none;" id="codigo"><textarea style="width: 100%; height: 200px;background: #666; color: white;"><?php echo $css; ?></textarea></div>
				<div class="row">
					<div class="span5 pull-right">
						<a href="./upload/css-sprite.png" target="_blank" class="btn btn-warning">Ver Imagen</a>
						<a href="#" onclick="$('#codigo').toggle(); $('#codigo textarea').select(); return false;" class="btn btn-info">Ver codigo</a>
						<button class="btn btn-success">Renombrar</button>
					</div>
				</div>
			</form>
			<?php
		}
		?>
		
  	</div>

	<!-- Cargamos las librerias javascript al final para que la pagina cargue mas rapido -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>
