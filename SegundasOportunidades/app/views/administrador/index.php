<h2> Administrador de Usuarios:</h2>

	<?php if(Session::get('autenticado')):
        
        if(isset($this->administradorUsuarios) && count($this->administradorUsuarios)) : ?>
    
            <table width="100%">
            
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>email</th>
                    <th>Usuario</th>
                    <th>Password</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                
                <?php for($i = 0; $i < count($this->administradorUsuarios); $i++): ?>
                
                <tr>
                    <td><?php echo $this->administradorUsuarios[$i]['Nombre']; ?></td>
                    <td><?php echo $this->administradorUsuarios[$i]['Apellidos']; ?></td>
                    <td><?php echo $this->administradorUsuarios[$i]['email']; ?></td>
                    <td><?php echo $this->administradorUsuarios[$i]['Usuario']; ?></td>
                    <td><?php echo $this->administradorUsuarios[$i]['Password']; ?></td>
                    <td><?php echo $this->administradorUsuarios[$i]['Rol']; ?></td>
                    <td><a class="button" href="<?php echo BASE_URL.'perfil/editar/'.$this->administradorUsuarios[$i]['id_user'];?>">Editar Usuario</a>  <a class="button" href="<?php echo BASE_URL.'administrador/eliminarUsuario/'.$this->administradorUsuarios[$i]['id_user'];?>">Eliminar Usuario</a></td> 
                    
                </tr>
                
                <?php endfor;?>
                
            </table>
            
            
            
    
        <?php else: ?>
    
            <p><strong>No hay Usuarios!</strong></p>
    
    	<?php endif;?> 
        
        <p align="center"><a  class="button" href="<?php BASE_URL; ?>registro">Agregar Usuario</a></p>
    
    <?php endif; ?>


<h2>Administrador de Anuncios:</h2>
	
    <?php if(Session::get('autenticado')):
        
        if(isset($this->administradorAnuncios) && count($this->administradorAnuncios)) : ?>
    
            <table width="100%">
            
                <tr>
                    <th>Fecha</th>
                    <th <th width="14%">Imagen</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
                
                <?php for($i = 0; $i < count($this->administradorAnuncios); $i++): ?>
                
                <tr>
                    <td><?php echo $this->administradorAnuncios[$i]['Fecha']; ?></td>
                    <?php if(!$this->administradorAnuncios[$i]['Imagen']): ?>
                
                <td><img id="img_anun" src="<?php echo BASE_URL.IMG_ANUNICIOS.NO_IMAGEN?>"></td>
                <?php else: ?>
                
                 <td><img id="img_anun" src="<?php echo BASE_URL.IMG_ANUNICIOS.$this->administradorAnuncios[$i]['Imagen']?>"></td>
                 
                 <?php endif ?>
                    <td><?php echo $this->administradorAnuncios[$i]['Titulo']; ?></td>
                    <td><?php echo $this->administradorAnuncios[$i]['Descripcion']; ?></td>
                    <td><?php echo $this->administradorAnuncios[$i]['Precio'].'€'; ?></td>
                    <td><a class="button" href="<?php echo BASE_URL.'anuncios/editar/'.$this->administradorAnuncios[$i]['id_anuncio'];?>">Editar</a> <a class="button" href="<?php echo BASE_URL.'administrador/eliminarAnuncio/'.$this->administradorAnuncios[$i]['id_anuncio'];?>">Eliminar Anuncio</a> </td> 
                    
                </tr>
                
                <?php endfor;?>
                
            </table>
    
        <?php else: ?>
    
            <p><strong>No hay Anuncios!</strong></p>
    
    	<?php endif;?>
        
        <p align="center"><a  class="button" href="<?php BASE_URL; ?>anuncios/nuevo">Agregar Anuncio</a></p> 
    
    <?php endif; ?>