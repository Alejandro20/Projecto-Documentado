<h2>Edita tu Perfil:</h2>
	
    
    <form name="form1" method="post" action="" >
         <input type="hidden" name="guardar" value="1" />
        
        <table width="50%">
            
            <tr>
                
                <td>Nombre: </td>
                <td><input type="text" name="nombre" value="<?php if(isset($this->datos['Nombre'])) echo $this->datos['Nombre']; ?>" /></td>
                
            </tr>
            
            <tr>
                
                <td>Apellidos: </td>
                <td><input type="text" name="apellido" value="<?php if(isset($this->datos['Apellidos'])) echo $this->datos['Apellidos']; ?>" /></td>
                
            </tr>
            
            <tr>
                
                <td>Email:</td>
                <td> <input type="text" name="email" value="<?php if(isset($this->datos['email'])) echo $this->datos['email']; ?>" /></td>
                
            </tr>
            
            <tr>
                
                <td>Usuario:</td>
                <td><input disabled type="text" name="usuario" value="<?php if(isset($this->datos['Usuario'])) echo $this->datos['Usuario']; ?>" /></td>
                
            </tr>
            
            <tr>
                
                <td>Password:</td>
                <td> <input type="password" name="pass" /></td>
                
            </tr>
            
            <tr>
                
                <td>Confirmar:</td>
                <td><input type="password" name="confirmar" /></td>
                
            </tr>
            
            <?php if(Session::get('level')==1):?>
        
                <tr>
                    
                    <td>Rol Usuario: </td>
                    <td><input type="text" name="rol" value="<?php if(isset($this->datos['Rol'])) echo $this->datos['Rol']; ?>" /></td>
                
                </tr>
        
        <?php endif ?>
            
            <tr>
                
                <td colspan="2"><input type="submit" value="Guardar" class="button" /></td>
            
            </tr>
        
        </table> 
       
            
    </form>

