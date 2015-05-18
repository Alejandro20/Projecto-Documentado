<h2>Iniciar Session:</h2>

<form name="form1" method="post" action="">
    
    <input type="hidden" value="1" name="enviar" />
    
    <table width="30%" style="margin-top:-2.5%;">
    
        <tr>
            
            <td>Usuario: </td>
            <td><input type="text" name="usuario" value="<?php if(isset($this->datos)) echo $this->datos['usuario']; ?>" /></td>
            
        </tr>
    
    <tr>
        
        <td>Password: </td>
        <td><input type="password" name="pass" /></td>
    
    </tr>
    
    <tr>
        
        <td colspan="2"><input type="submit" value="enviar" class="button"/></td>
        
    </tr>
</form>
