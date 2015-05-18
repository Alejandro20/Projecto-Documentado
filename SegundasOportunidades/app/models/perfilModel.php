<?php

	class perfilModel extends Model{
		
		public function __construct(){
			
			parent::__construct();
			
		}
		
		public function verificarUsuario($usuario){/**Funcion para verificar que el usuario existe*/
			
        	$id = $this->_db->query(
                
				"select id_user from usuarios where Usuario = '$usuario'"
            );
        
        return $id->fetch();
    	}
		
		public function verificarEmail($email){/**Verificar que existe un usuario con ese email*/
			
			$id = $this->_db->query(
					"select id_user from usuarios where email = '$email'"
			);
			
			if($id->fetch()){
				
				return true;
			}
        
        	return false;
    	}
		
		public function getUsuario($id){/**Obtenemos a un usuario a traves de su id*/
			
			$id = (int) $id;
			$perfil = $this->_db->query("select * from usuarios where id_user = $id");
			return $perfil->fetch();
    	
		}
		
		
		
			public function editarPerfil($id, $nombre, $apellidos,$email,$Password,$rol){/**Funcion para poder actualizar a un usuario desde la vista Perfil*/
				
				if(Session::get('level')==1){/**Si eres admin pasas todos los campos que nos pasan de la vista del editar del perfil*/
				
					$id = (int) $id;
					//$user = Session::get('id_usuario');	
					//$id = $user;
					$this->_db->prepare("UPDATE usuarios SET Nombre = :nombre, Apellidos = :apellidos, email = :email, Password = :password, Rol = :rol WHERE id_user = :id")
							->execute(
							
									array(
									   ':id' => $id,
									   ':nombre' => $nombre,
									   ':apellidos' => $apellidos,
									   ':email'=>$email,
									   ':password'=>$Password,
									   ':rol' =>$rol
									));
				}else{/**Si eres usuario normal pasas todos los campos excepto el de rol que estara precargado con el valor 2 de usuario normal*/
					
					$id = (int) $id;
					$rol = Session::get('level');	
					//$id = $user;
					$this->_db->prepare("UPDATE usuarios SET Nombre = :nombre, Apellidos = :apellidos, email = :email, Password = :password, Rol = :rol WHERE id_user = :id")
							->execute(
							
									array(
									   ':id' => $id,
									   ':nombre' => $nombre,
									   ':apellidos' => $apellidos,
									   ':email'=>$email,
									   ':password'=>$Password,
									   ':rol' =>$rol
									));
				
				
				
				}
			}
		
		
		
	}
?>