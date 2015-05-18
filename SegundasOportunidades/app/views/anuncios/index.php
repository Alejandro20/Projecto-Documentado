<h2>Mis Objetos a la venta:</h2>

	<?php if(Session::get('autenticado')):
    
	 	if(isset($this->anuncios) && count($this->anuncios)) : ?>
    
        <table width="100%">
        
            <tr>
                <th>Fecha</th>
                <th width="14%">Imagen</th>
                <th >Titulo</th>
                <th>Descripcion</th>
                <th>Precio</th>
               
                <th width="20%">Acciones</th>
            </tr>
            
            <?php for($i = 0; $i < count($this->anuncios); $i++): ?>
            
            <tr>
                <td><?php echo $this->anuncios[$i]['Fecha']; ?></td>
                
                <?php if(!$this->anuncios[$i]['Imagen']): ?>
                
                <td><img id="img_anun" src="<?php echo BASE_URL.IMG_ANUNICIOS.NO_IMAGEN?>"></td>
                <?php else: ?>
                
                 <td><img id="img_anun" src="<?php echo BASE_URL.IMG_ANUNICIOS.$this->anuncios[$i]['Imagen']?>"></td>
                 
                 <?php endif ?>
                <td><?php echo $this->anuncios[$i]['Titulo']; ?></td>
                <td><?php echo $this->anuncios[$i]['Descripcion']; ?></td>
                <td><?php echo $this->anuncios[$i]['Precio'].'€'; ?></td>
                
                
                <td><a class="button" href="<?php echo BASE_URL.'anuncios/editar/'.$this->anuncios[$i]['id_anuncio'];?>">Editar</a>  <a class="button" href="<?php echo BASE_URL.'anuncios/vendido/'.$this->anuncios[$i]['id_anuncio'];?>">Vendido</a></td>                                
            </tr>
            
            <?php endfor;?>
        
        </table>
        
        <?php else: ?>
        
        <p><strong>No tienes Anuncios!</strong></p>
        
        <?php endif; ?>
        
        <p align="center"><a  class="button" href="<?php BASE_URL; ?>anuncios/nuevo">Agregar Anuncio</a></p>
        
     <?php else: ?>
     
     	<p>Inicia Session para ver tus Anuncios</p>
       
	 <?php endif; ?> 
     
<h2>Mis Objetos Vendidos:</h2>

	<?php if(Session::get('autenticado')):
    
	 	if(isset($this->anunciosVendidos) && count($this->anunciosVendidos)) : ?>
    
        <table width="100%">
        
            <tr>
                <th>Fecha</th>
                <th width="14%">Imagen</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Precio</th>
               
                
            </tr>
            
            <?php for($i = 0; $i < count($this->anunciosVendidos); $i++): ?>
            
            <tr>
                <td><?php echo $this->anunciosVendidos[$i]['Fecha']; ?></td>
                <td><img id="img_anun" src="<?php echo BASE_URL.IMG_ANUNICIOS.$this->anunciosVendidos[$i]['Imagen']?>"></td>
                <td><?php echo $this->anunciosVendidos[$i]['Titulo']; ?></td>
                <td><?php echo $this->anunciosVendidos[$i]['Descripcion']; ?></td>
                <td><?php echo $this->anunciosVendidos[$i]['Precio'].'€'; ?></td>
                
                
            
            <?php endfor;?>
        
        </table>
        
        <?php else: ?>
        
        <p><strong>No tienes Anuncios!</strong></p>
        
        <?php endif; ?>
        
        
     <?php else: ?>
     
     	<p>Inicia Session para ver tus Anuncios</p>
       
	 <?php endif; ?>  
  
 