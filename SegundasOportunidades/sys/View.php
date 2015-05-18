<?php

class View
{
    private $_controlador;
    private $_js;
    
    public function __construct(Request $peticion) {
        $this->_controlador = $peticion->getControlador();/**Obtenemos el controlador en el que estamos a partir de la url*/
        $this->_js = array();
    }
    
    public function renderizar($vista, $item = false)/**Funcion que se carga de ejecutar la vistas, por defecto no le pasamos nada se lo pasaremos en los controladores de las vistas*/
    {
        $menu = array(/**Array de los elementos de menu*/
            array(/*El primer elemento de menu sera el index*/ 
                'id' => 'inicio',
                'titulo' => 'Inicio',
                'enlace' => BASE_URL
                ),
        );
        
        if(Session::get('autenticado')){/*Si el usuario se ha logueado vera estas acciones*/
			
			if(Session::get('level') == 1){/**Si el usuario es admin vera esta acciones*/
				
				$menu[] = array(/**El unico elemento de solo admins sera el de la vista asministrar*/
                'id' => 'administrador',
                'titulo' => 'Administrar',
                'enlace' => BASE_URL . 'administrador'
                );
				
			}else{
				
				$menu[] = array(/**Si estas logueado veras la vista de tus anuncios*/
					'id' => 'anuncios',
					'titulo' => 'Mis Anuncios',
					'enlace' => BASE_URL . 'anuncios'
					);
					
			}
				
            $menu[] = array(/**Si estas logueado tendras la funcion para cerrar session*/
                'id' => 'login',
                'titulo' => 'Cerrar Sesion',
                'enlace' => BASE_URL . 'login/cerrar'
                );
			
			$menu[] = array(/**Si estas logueado veras la vista de tu Perfil*/
                'id' => 'Perfil',
                'titulo' => 'Mi Perfil',
                'enlace' => BASE_URL . 'perfil'
                );
				
        }else{
							
            $menu[] = array(/**Si no estas logueado veras la vista para hacer login*/
                'id' => 'login',
                'titulo' => 'Iniciar Sesion',
                'enlace' => BASE_URL . 'login'
                );

			$menu[] = array(/**Si no estas logueado veras la vista para registrarse*/
			'id' => 'registro',
			'titulo' => 'Registrar',
			'enlace' => BASE_URL . 'registro'
			);
        }
        
        $js = array();
        
        if(count($this->_js)){
            $js = $this->_js;
        }
        
        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'Templates/' . DEFAULT_LAYOUT . '/css/',/**Indicamos la ruta del css de la app*/
            'ruta_img' => BASE_URL . 'Templates/' . DEFAULT_LAYOUT . '/img/',/**Indicamos la ruta de las imagenes de la app*/
            'ruta_js' => BASE_URL . 'Templates/' . DEFAULT_LAYOUT . '/js/',/**Indicamos la ruta de los javascripts de la app*/
            'menu' => $menu,/**indicamos que el menu es el array menu*/
            'js' => $js/**Indicamos que los js es la variable $js*/
        );
        
        $rutaView = ROOT . 'app' . DS. 'views' . DS . $this->_controlador . DS . $vista . '.php';/**Indicamos donde se encuentra la ruta de la vista seleccionada a partir del controlador que nos pasan*/ 
        
        if(is_readable($rutaView)){/**Si la ruta es valida y existe, contruiremos la vista a partir del fichero header+fichero_vista_correspondiente+footer.*/
            include_once ROOT . 'Templates' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once $rutaView;
            include_once ROOT . 'Templates' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        } 
        else {
            throw new Exception('Error de vista');/**Si no existe la ruta mostramos un error*/
        }
    }
    
    public function setJs(array $js)
    {
        if(is_array($js) && count($js)){
            for($i=0; $i < count($js); $i++){
                $this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js');
        }
    }
}

?>
