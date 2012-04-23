	<?php if($ancho_icono<60 || $ancho_icono >130){
		?><div class="span3"><?php
	}else{
		?><div class="span2"><?php
	} ?>
	<?php if($ancho_icono<60){
		?><div class="span1"><?php
	} ?>
	<div class="icono-<?php echo $nombre; ?>"></div>
	<?php if($ancho_icono<60){
		?></div><?php
	} ?>
	<input type="text" class="span2" name="names[<?php echo $x; ?>][<?php echo $y; ?>]" value="<?php echo $nombre; ?>" />
</div>
