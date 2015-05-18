<?php

class loginController extends Controller
{
    private $_login;
    
    public function __construct(){
        parent::__construct();
        $this->_login = $this->loadModel('login');/**Cargamos el modelo de login para la vista login*/
    }
    
    public function index()/**Funcion que se encarga de cargar el index del login*/
    {
        if(Session::get('autenticado')){ /** Si estas logeado te redirecciona*/
            $this->redireccionar();
        }
        
        $this->_view->titulo = 'Iniciar Sesion';/**Indicamos el titulo de la pestaña de la pagina*/
        
        if($this->getInt('enviar') == 1){/**Comprobamos que se haya seleccionado el boton para comenzar el proceso de login*/
            $this->_view->datos = $_POST;/**Enviamos los datos por $_POST*/
            
            if(!$this->getAlphaNum('usuario')){/*Comprobamos que tenga usuario*/
                $this->_view->_error = 'Debe introducir su nombre de usuario';/**Si no tiene usuario mostraremos el siguiente mensaje*/
                $this->_view->renderizar('index','login');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if(!$this->getSql('pass')){/*Comprobamos que tenga contraseña*/
                $this->_view->_error = 'Debe introducir su password';/**Si no tiene password mostraremos el siguiente mensaje*/
                $this->_view->renderizar('index','login');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            $row = $this->_login->getUsuario( /**Seleccionamos al usuario a partir del usuario y la password que nos pasan*/
                    $this->getAlphaNum('usuario'),
                    $this->getSql('pass')
                    );
            
            if(!$row){/** Si no existe nos mostraran mensajes de error*/
                $this->_view->_error = 'Usuario y/o password incorrectos';
                $this->_view->renderizar('index','login');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if($row['Estado'] != 1/**1 indica que el usuario esta habilitado*/){/**Si el usuario no esta habilitado no mostrara un error*/
                $this->_view->_error = 'Este usuario no esta habilitado';
                $this->_view->renderizar('index','login');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
             
			/**Obtenemos los datos de session del usuario que se ha logeado*/          
            Session::set('autenticado', true);
            Session::set('level', $row['Rol']);
            Session::set('usuario', $row['Usuario']);
            Session::set('id_usuario', $row['id_user']);
            Session::set('tiempo', time());
            
            $this->redireccionar();/**Nos redirecciona al index de la pagina por defecto*/
        }
        
        $this->_view->renderizar('index','login'); /** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
    }
    
    public function cerrar()/**Funcion que se encarga de pasar la orden de cerrar una session*/
    {
        Session::destroy();
        $this->redireccionar();
    }
}

?>
