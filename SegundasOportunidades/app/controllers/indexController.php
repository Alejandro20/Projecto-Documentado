<?php

class indexController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()/**Funcion que se encarga de cargar el index*/
    {
        $anuncio = $this->loadModel('anuncios');/**Cargamos el modelo de anuncios para la vista index*/
        
        $this->_view->anuncios = $anuncio->getAnuncios();/**Obtenemos todos los anuncios*/
        
        $this->_view->titulo = 'Portada';/**Indicamos el titulo de la pestaña de la pagina*/
        $this->_view->renderizar('index', 'inicio');/**Mostramos la vista correspondiente*/
    }
}

?>