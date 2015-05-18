<?php

	class administradorModel extends Model{
		
		public function __construct(){
			
			parent::__construct();
			
		}
		
		public function getAnuncios(){/**Funcion para listar todos los anuncios de la app*/
        	
			$administrar = $this->_db->query("select * from anuncios");
        
			return $administrar->fetchall();
    	}
		
		public function getUsuarios(){/**Funcion para listar todos los usuarios de la app*/
        	
			$administrar = $this->_db->query("select * from usuarios");
        
			return $administrar->fetchall();
    	}
		
		public function eliminarUsuario($id){/**Funcion para eliminar a un usuario de la app a traves del id que nos pasan por el enlace de la vista*/
			
			$id = (int) $id;
			
			$this->_db->query("DELETE FROM usuarios WHERE id_user = $id");
			
		}
		
		public function eliminarAnuncio($id){/**Funcion para eliminar un anuncio de la app a traves del id que nos pasan por el enlace de la vista*/
			
			$id = (int) $id;
			
			$this->_db->query("DELETE FROM anuncios WHERE id_anuncio = $id");
			
		}
		
		
		
	}
