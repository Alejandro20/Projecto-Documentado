<h2>Registro de Usuarios:</h2>

<form name="form1" method="post" action="">
    <input type="hidden" value="1" name="enviar" />
    
    <table width="50%">
    	
        <tr>
        	
            <td>Nombre: </td>
            <td><input type="text" name="nombre" value="<?php if(isset($this->datos)) echo $this->datos['nombre']; ?>" /></td>
            
        </tr>
        
        <tr>
        	
            <td>Apellidos: </td>
            <td><input type="text" name="apellido" value="<?php if(isset($this->datos)) echo $this->datos['apellido']; ?>" /></td>
            
        </tr>
        
        <tr>
        	
            <td>Email:</td>
            <td> <input type="text" name="email" value="<?php if(isset($this->datos)) echo $this->datos['email']; ?>" /></td>
            
        </tr>
        
        <tr>
        	
            <td>Usuario:</td>
            <td><input type="text" name="usuario" value="<?php if(isset($this->datos)) echo $this->datos['usuario']; ?>" /></td>
            
        </tr>
        
        <tr>
        	
            <td>Password:</td>
            <td> <input type="password" name="pass" /></td>
            
        </tr>
        
        <tr>
        	
            <td>Confirmar:</td>
            <td><input type="password" name="confirmar" /></td>
            
        </tr>
        
        <tr>
        	
            <td colspan="2"><input type="submit" value="enviar" class="button" /></td>
        
        </tr>
    
    </table>

</form>