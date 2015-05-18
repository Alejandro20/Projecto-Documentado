<h2>Inserta un Anuncio</h2>

<form id="form1" method="post" action="">
    <input type="hidden" name="guardar" value="1" />
    <table width="50%">
    
    	<tr>
            <td>Titulo:</td>
        	<td><input type="texto" name="titulo" value="<?php if(isset($this->datos)) echo $this->datos['Titulo']; ?>" /></td>
        </tr>
        
        <tr>
            <td>Descripcion:</td>
        	<td><textarea name="descripcion"><?php if(isset($this->datos)) echo $this->datos['Descripcion']; ?></textarea></td>
        </tr>
        
        <tr>
            <td>Precio:</td>
            <td><input type="texto" name="precio" value="<?php if(isset($this->datos)) echo $this->datos['Precio']; ?>" /></td>
        </tr>
            <td>Imagen:</td>
        	<td><input type="file" name="imagen" value="<?php if(isset($this->datos)) echo $this->datos['Imagen']; ?>" /></td>
        <tr>
        </tr>
        
        <tr>
        	<td colspan="2"><input type="submit" class="button" value="Guardar" /></td>
        </tr>
     
     </table>
    
</form>
