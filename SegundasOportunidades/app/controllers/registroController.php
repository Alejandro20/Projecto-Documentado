<?php

class registroController extends Controller
{
    private $_registro;
    
    public function __construct() {
        parent::__construct();
        
        $this->_registro = $this->loadModel('registro');/**Cargamos el modelo de registro*/
    }
    
    public function index()
    {
        /*if(Session::get('autenticado')){
            $this->redireccionar();
        }*/
        
        $this->_view->titulo = 'Registro';/**Configuramos el nombre de pestaña de la pagina*/
        
        if($this->getInt('enviar') == 1){/**Si seleccionamos el boton de enviar comienza la subida de datos al controlador*/
            $this->_view->datos = $_POST;/**Todos los datos no los pasan por POST*/
            
            if(!$this->getSql('nombre')){/**Comprobamos que tenga nombre*/
                $this->_view->_error = 'Debe introducir su nombre';/**Si no tiene nombre mostraremos el siguiente mensaje*/
                $this->_view->renderizar('index', 'registro');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if(!$this->getAlphaNum('usuario')){/**Comprobamos que tenga usuario*/
                $this->_view->_error = 'Debe introducir su nombre usuario';/**Si no tiene usuario mostraremos el siguiente mensaje*/
                $this->_view->renderizar('index', 'registro');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if($this->_registro->verificarUsuario($this->getAlphaNum('usuario'))){/**Verificamos que el nombre se usuario no este repetido*/
                $this->_view->_error = 'El usuario ' . $this->getAlphaNum('usuario') . ' ya existe';/**Si esta repetido nos mostrar un error*/
                $this->_view->renderizar('index', 'registro');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if(!$this->validarEmail($this->getPostParam('email'))){/**Comprobamos que el email sea valido*/
                $this->_view->_error = 'La direccion de email es inv&aacute;lida';/**Si el email no es valido, nos mostrar un error*/
                $this->_view->renderizar('index', 'registro');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if($this->_registro->verificarEmail($this->getPostParam('email'))){/**Verificamos que el email no este repetido*/
                $this->_view->_error = 'Esta direccion de correo ya esta registrada';/**Si esta repetido nos mostrar un error*/
                $this->_view->renderizar('index', 'registro');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if(!$this->getSql('pass')){/**Comprobamos que pasamos una contraseña*/
                $this->_view->_error = 'Debe introducir su password';/**Si la contraseña esta vacia nos mostrara un error*/
                $this->_view->renderizar('index', 'registro');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if($this->getPostParam('pass') != $this->getPostParam('confirmar')){/**Comprobamos que la contraseña y la confirmacion, sean iguales*/
                $this->_view->_error = 'Los passwords no coinciden';/**Si no son iguales nos mostrara un mensaje de error*/
                $this->_view->renderizar('index', 'registro');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
			$this->getLibrary('class.phpmailer');
			$mail = new PHPMailer();
			
            $this->_registro->registrarUsuario(/**Pasamos los datos del registro al modelo*/
                    $this->getSql('nombre'),
					$this->getSql('apellido'),
                    $this->getAlphaNum('usuario'),
                    $this->getSql('pass'),
                    $this->getPostParam('email')
                    );
            
			$usuario = $this->_registro->verificarUsuario($this->getAlphaNum('usuario'));/***/
			
            if(!$usuario){/** Si el campo uussario esta vacio nos mostrara un error*/
                $this->_view->_error = 'Error al registrar el usuario';
                $this->_view->renderizar('index', 'registro');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }else{
				
				header("Location:index.php");/**Nos redirije al index despues del registro*/
			
			}
			
        }        
        
        $this->_view->renderizar('index', 'registro');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
		
		
    }

}

?>
