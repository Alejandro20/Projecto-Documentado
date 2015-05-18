<?php

class perfilController extends Controller
{
	private $_perfil;
	
    public function __construct(){
        parent::__construct();
		$this->_perfil = $this->loadModel('perfil');/**Cargamos el modelo de perfil para la vista perfil*/
    }
    
    public function index(){
		
		if(Session::get('autenticado')){
			
            $this->_view->titulo = 'Perfil';/**Indicamos el titulo de la pestaña de la pagina*/
			$this->_view->renderizar('index', 'perfil');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
        
		}
	}
		
	public function editar($id){
		        
		if(!$this->filtrarInt($id)){/**Comprobamos que nos pasan un id desde la vista*/
            $this->redireccionar('perfil');/**Nos redirecciona a la vista anterior*/
        }
        
        if(!$this->_perfil->getUsuario($this->filtrarInt($id))){ /**Si no existe el usuario nos redirije a la vista anterior*/
            $this->redireccionar('perfil');
        }
        
        $this->_view->titulo = 'Editar Perfil';/**Indicamos el titulo de la pestaña de la pagina*/
       
        
        if($this->getInt('guardar') == 1){/**Si clican el boton de guardar se comenzaran a subir los datos de la vista editar*/
            
			$this->_view->datos = $_POST;/**Pasamos los datos por el metodo POST*/
        
				if(!$this->getSql('nombre')){/**Comprobamos que tenga nombre*/
					$this->_view->_error = 'Debe introducir su nuevo nombre';/**Si no tiene nombre mostraremos el siguiente mensaje*/
					$this->_view->renderizar('editar', 'perfil');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
					exit;
				}
				
				 if(!$this->getSql('apellido')){/**Comprobamos que tenga apellido*/
					$this->_view->_error = 'Debe introducir su nuevo nombre';/**Si no tiene apellido mostraremos el siguiente mensaje*/
					$this->_view->renderizar('editar', 'perfil');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
					exit;
				}
				
				if(!$this->validarEmail($this->getPostParam('email'))){/**Comprobamos que tenga email*/
					$this->_view->_error = 'La direccion de email es invalida';/**Si no tiene email mostraremos el siguiente mensaje*/
					$this->_view->renderizar('editar', 'perfil');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
					exit;
				}
				
				
				
				
				if(!$this->getSql('pass')){/**Comprobamos que tenga contraseña*/
					$this->_view->_error = 'Debe introducir su  nueva password';/**Si no tiene password mostraremos el siguiente mensaje*/
					$this->_view->renderizar('editar', 'perfil');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
					exit;
				}
				
				if($this->getPostParam('pass') != $this->getPostParam('confirmar')){/**Comprobamos que la contraseña y la confirmacion sean iguales*/
					$this->_view->_error = 'Los passwords no coinciden';/**Si no son iguales mostrara un mensaje de error*/
					$this->_view->renderizar('editar', 'perfil');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
					exit;
				}
				
				if(Session::get('level')==1){/**Si es administrador se subira un campo adicional que es el de rol*/
					
				if(!$this->getPostParam('rol')){/**Comprobamos que nos pasan el rol*/
					$this->_view->_error = 'Indica el Rol';/**Si no se indica, nos mostara mensaje de error*/
					$this->_view->renderizar('editar', 'perfil');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
					exit;
				}
				
					$this->_perfil->editarPerfil(/**Pasamos todos los datos de la vista al modelo*/
						
						$this->filtrarInt($id),
						$this->getSql('nombre'),
						$this->getSql('apellido'),
						$this->getPostParam('email'),
						$this->getSql('pass'),
						$this ->getPostParam('rol')					
						
						);
				
				}else{
				
					$this->_perfil->editarPerfil(/**Pasamos todos los datos de la vista al modelo menos el rol por que no sera admin el usuario que solicita la edicion de su perfil*/
							
							$this->filtrarInt($id),
							$this->getSql('nombre'),
							$this->getSql('apellido'),
							$this->getPostParam('email'),
							$this->getSql('pass')					
							
							);
				}
				
				 
				
				$usuario = $this->_perfil->verificarUsuario($this->getAlphaNum('usuario'));/**Verificamos que existe el usuario al que estamos editando*/
				
				if(Session::get('level')==1){/** Si eres administrador no redirije a la vista de administrador*/
				
					$this->redireccionar('administrador');
				
				}else{/**Si es usuario normal nos redirije a la vista de perfil*/
				
					$this->redireccionar('perfil');
				
				}
				
				if(!$usuario){/**Si el usuario esta vacio mostrara un error**/
					$this->_view->_error = 'Error al actualizar el usuario';
					$this->_view->renderizar('editar', 'perfil');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
					exit;
		
				}
        
    	}
		
        $this->_view->datos = $this->_perfil->getUsuario($this->filtrarInt($id));
        $this->_view->renderizar('editar', 'perfil');

	}
}

?>