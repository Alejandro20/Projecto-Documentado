
<?php 

	$usuario = Session::get('usuario');
	$id_user = Session::get('id_usuario');
	
	echo "<h1>Perfil de ". $usuario.":</h1>";
	
	echo "<h3>Estas son tus acciones disponibles:</h3>";
	
?>

<div class="contenedor">
    <div id="edit_perfil"><a href="<?php echo BASE_URL.'Perfil/editar/'.$id_user;?>"><input type="button" value="Editar Perfil"></a></div>
    <div id="hist"><a href="<?php echo BASE_URL.'anuncios';?>"><input type="button" value="Historial de Anuncios"></a></div>
    
    <?php if(Session::get('level')==1):?>
    	
        <div id="admin"><a href="<?php echo BASE_URL.'administrador';?>"><input type="button" value="Administrador"></a></div>
    
	<?php endif ?>
    	
</div>	
	


