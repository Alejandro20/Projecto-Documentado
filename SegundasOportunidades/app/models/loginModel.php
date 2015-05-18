<?php

class loginModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getUsuario($usuario, $password)/**Funcion que se encarga de obtener y comprobar que el usuario y contraseña son correctos para loguear*/
    {
        $datos = $this->_db->query(
                "select * from usuarios " .
                "where Usuario = '$usuario' " .
                "and Password = '$password'"
                );
        
        return $datos->fetch();
    }
}

?>
