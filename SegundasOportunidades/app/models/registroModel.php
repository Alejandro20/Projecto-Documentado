<?php

class registroModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function verificarUsuario($usuario){/**Funcion para verificar que el usuario existe*/
        
		$id = $this->_db->query("select id_user from usuarios where Usuario = '$usuario'" );
        
        return $id->fetch();
		
    }
    
    public function verificarEmail($email){/**Verificar que existe un usuario con ese email*/
		
        $id = $this->_db->query("select id_user from usuarios where email = '$email'");
        
        if($id->fetch()){
            
			return true;
        
		}
        
        return false;
    }
    
    public function registrarUsuario($nombre,$apellido, $usuario, $password, $email){/**Funcion para registrar a un nuevo usuario*/
    	
		
        $this->_db->prepare(
                "insert into usuarios values" .
                "(null, :nombre, :apellido, :email, :usuario, :password,2,1)"
                )
                ->execute(array(
                    ':nombre' => $nombre,
					':apellido'=>$apellido,
                    ':usuario' => $usuario,
                    ':password' =>$password,
                    ':email' => $email
                    
                ));
				
    }
    
    public function getUsuario($id){/**Obtenemos a un usuario a traves de su id*/
		
		$usuario = $this->_db->query("select * from usuarios where id_user = $id ");
					
		return $usuario->fetch();
		
	}
	
	
}

?>
