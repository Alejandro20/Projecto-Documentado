<?php

class anunciosController extends Controller
{
    private $_anuncio;
    
    public function __construct() {
        parent::__construct();
        $this->_anuncio = $this->loadModel('anuncios');/** Esta sentencia hace que el controlador del administrador carge su model*/
    }
    
    public function index(){/**Esta funcion del controlador carga la vista del index*/
		
		if(Session::get('autenticado')){/**Con este if se mostraran los anuncios disponibles y anuncios vendidos del sistema solo si estas logeado*/
        
			$this->_view->anuncios = $this->_anuncio->getAnunciosPropios();/**Con esta linia llamaremos a la funcion que se encarga de obtener los anuncios de ese usuario*/
			$this->_view->anunciosVendidos = $this->_anuncio->getAnunciosPropiosVendidos();/**Con esta linia llamaremos a la funcion que se encarga de obtener los anuncios vendidos de ese usuario*/
			$this->_view->titulo = 'Anuncio';/** Esto define el titulo de la pestaña de la pagina*/
			$this->_view->renderizar('index', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/ 
		
		}else{
			
			$this->_view->anuncios = $this->_anuncio->getAnuncios();/**Con esta linia llamamos a la funcion que se encarga de mostrar todos los anuncios del sistema cuando no haya usuarios logeados*/
        	$this->_view->titulo = 'Anuncio';/** Esto define el titulo de la pestaña de la pagina*/
        	$this->_view->renderizar('index', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
		
		}
    }
    
    public function nuevo(){/** Esta es la funcion que se encarga de controlar los datos que se pasaran para insetar un nuevo usuario*/
        
        $this->_view->titulo = 'Nuevo Anuncio';/** Esto define el titulo de la pestaña de la pagina*/
        
        
        if($this->getInt('guardar') == 1){ /**Si desde el formulario clican el boton guardar se comienzan a pasar los datos*/
            $this->_view->datos = $_POST;/**Pasamos los datos por el metodo POST*/
            
            if(!$this->getTexto('titulo')){ /*Comprobamos que tenga nombre*/
                $this->_view->_error = 'Debe introducir el titulo del anuncio';/**Si no tiene titulo mostraremos el siguiente mensaje*/
                $this->_view->renderizar('nuevo', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if(!$this->getTexto('descripcion')){/*Comprobamos que tenga descripcion*/
                $this->_view->_error = 'Debe introducir la descripcion del anuncio';/**Si no tiene descripcion mostraremos el siguiente mensaje*/
                $this->_view->renderizar('nuevo', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
			
			if(!$this->getTexto('precio')){/*Comprobamos que tenga precio*/
                $this->_view->_error = 'Debe introducir el precio del producto';/**Si no tiene precio mostraremos el siguiente mensaje*/
                $this->_view->renderizar('nuevo', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
			
			if(!$this->getTexto('imagen')){/*Comprobamos que tenga imagen*/
                $this->_view->_error = 'Debe introducir la imagen del anuncio';/**Si no tiene imagen mostraremos el siguiente mensaje*/
                $this->_view->renderizar('nuevo', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
			//$ruta = BASE_URL.IMG_ANUNICIOS;
            //$imagen = $_FILES['imagen']['name'];
			//move_uploaded_file($_FILES["imagen"]["tmp_name"], 'imgs/'.$_FILES['imagen']['name']);
            
            /*if(isset(){
				
                $ruta = BASE_URL.RUTA_IMG_ANUNICIOS.DS;
                
				
			}*/
            
            $this->_anuncio->insertarAnuncio(/**Aqui le pasaremos los datos al modelo*/
                    $this->getTexto('titulo'),
                    $this->getTexto('descripcion'),
					$this->getTexto('precio'),
					$this->getTexto('imagen')
					//$imagen
                    );
            
            $this->redireccionar('anuncios');/**Nos redirije a la vista anterior*/
        }       
        
        $this->_view->renderizar('nuevo', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
    }
    
    public function editar($id){
        
		if(!$this->filtrarInt($id)){
            $this->redireccionar('anuncios');
        }
        
        if(!$this->_anuncio->getAnuncio($this->filtrarInt($id))){
            $this->redireccionar('anuncios');
        }
        
        $this->_view->titulo = 'Editar Anuncio';
        $this->_view->setJs(array('nuevo'));
        
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getTexto('titulo')){/*Comprobamos que tenga nombre*/
                $this->_view->_error = 'Debe introducir el titulo del anuncio';/**Si no tiene titulo mostraremos el siguiente mensaje*/
                $this->_view->renderizar('editar', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            if(!$this->getTexto('descripcion')){/*Comprobamos que tenga descripcion*/
                $this->_view->_error = 'Debe introducir la descripcion del anuncio';/**Si no tiene descripcion mostraremos el siguiente mensaje*/
                $this->_view->renderizar('editar', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
			
			if(!$this->getInt('precio')){/*Comprobamos que tenga precio*/
                $this->_view->_error = 'Debe introducir el precio del producto';/**Si no tiene precio mostraremos el siguiente mensaje*/
                $this->_view->renderizar('editar', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
                exit;
            }
            
            /*if(!$this->getTexto('imagen')){
                $this->_view->_error = 'Debe introducir la imagen del anuncio';
                $this->_view->renderizar('editar', 'anuncios');
                exit;
            }*/
            
            $this->_anuncio->editarAnuncio(/**Aqui le pasaremos los datos al modelo*/
                    
					$this->filtrarInt($id),
                    $this->getTexto('titulo'),
                    $this->getTexto('descripcion'),
					$this->getTexto('precio'),
					$this->getTexto('imagen')
					
					
                    );
            
            $this->redireccionar('anuncios');/**Nos redirije a la vista anterior*/
        }
        
        $this->_view->datos = $this->_anuncio->getAnuncio($this->filtrarInt($id));/**Con esta linia haremos que solo se modifique el anuncio que nos pasan desde la vista*/
        $this->_view->renderizar('editar', 'anuncios');/** Esta linia es la que se encarga de ejecutar i mostrar la pantalla de la vista que controla esta funcion*/
    }
	
	public function vendido($id){/** Esta funcion se encarga de que el anuncio seleccionado tenga el valor "Vendido" en la base de datos"*/
	
		if(!$this->filtrarInt($id)){/**Comprobamos que nos pasan la id del anuncio*/
            	$this->redireccionar('anuncios');/**Si no la pasan nos devuelve atras*/
        	}
						
			 $this->_anuncio->AnuncioVendido(/**Pasamos el id a la funcion para que se encarge de cambiar el valor del campo vendido*/
                    
					$this->filtrarInt($id)
			);
			
			$this->redireccionar('anuncios');/**Nos devuelve a la vista anterior*/
	
	
	}
    
}

?>

