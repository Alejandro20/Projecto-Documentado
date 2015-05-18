<?php

	class administradorController extends Controller{
		
		private $_administrador;
		
		public function __construct(){
			
			parent::__construct();
			
			$this->_administrador = $this->loadModel('administrador'); /** Esta sentencia hace que el controlador del administrador carge su model*/
			
		}
		
		/**
		
		*
		
		
		*/
		
		public function index(){/**Esta funcion del controlador carga la vista del index*/
			
			if(Session::get('autenticado')){ /**Con este if se mostraran los usuarios y anuncios del sistema solo si estas logeado*/
			
				$this->_view->administradorUsuarios = $this->_administrador->getUsuarios();/**Esta funcion carga todos los usuarios del sistema*/
				$this->_view->administradorAnuncios = $this->_administrador->getAnuncios();/**Esta funcion carga todos los anuncios del sistema*/
				$this->_view->titulo = 'Anuncio'; /** Esto define el titulo de la pestaña de la pagina*/
				$this->_view->renderizar('index', 'administrador'); /** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/ 
			
			}
    	}
		
		public function eliminarUsuario($id){/** Funcion que controla la eliminacion de usuarios desde la vista administrador*/
			
			if(!$this->filtrarInt($id)){/**Comprobamos que nos pasan un id desde la vista*/
            	$this->redireccionar('administrador');/**Si no lo pasan, nos devuelve a la pantalla administrador*/
        	}
						
			 $this->_administrador->eliminarUsuario(/**Si nos pasan el id desde la vista, llamamos a la funcion del modelo para eliminar el usuario*/
                    
					$this->filtrarInt($id)/** Con esta linia le pasamos a la funcion el id del usuario que se borrara*/
			);
			
			$this->redireccionar('administrador');/**Cuando se haya borrado, nos devolvera a la vista del administrador*/
		
		}
		
		public function eliminarAnuncio($id){/** Funcion que controla la eliminacion de anuncios desde la vista administrador*/
			
			if(!$this->filtrarInt($id)){/**Comprobamos que nos pasan un id desde la vista*/
            	$this->redireccionar('administrador');/**Si no lo pasan, nos devuelve a la pantalla administrador*/
        	}
						
			 $this->_administrador->eliminarAnuncio(/**Si nos pasan el id desde la vista, llamamos a la funcion del modelo para eliminar el usuario*/
                    
					$this->filtrarInt($id)/** Con esta linia le pasamos a la funcion el id del usuario que se borrara*/
			);
			
			$this->redireccionar('administrador');/**Cuando se haya borrado, nos devolvera a la vista del administrador*/
		
		}
	}
	
