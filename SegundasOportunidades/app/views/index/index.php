<!--<h1>Bienvenido a Segundas Oportunidades:</h1>-->

	<?php if(Session::get('autenticado')):?>
        
		<h1>Bienvenido a Segundas Oportunidades:</h1>
        
		<?php if(isset($this->anuncios) && count($this->anuncios)) : ?>
    
            <table width="100%">
            
                <tr>
                
                    <th>Fecha</th>
                    <th width="14%">Imagen</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    
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
                    
                    
                </tr>
                
                <?php endfor;?>
                
            </table>
    
        <?php else: ?>
    
            <p><strong>No hay Anuncios!</strong></p>
    
    	<?php endif;?>
   	
    <?php else: ?>
    
    <div id="contenedor">
    
    	<div id="contenido"> </div>
    
    </div>
         
    
    <?php endif; ?>