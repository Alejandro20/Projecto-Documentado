<?php

class Request
{
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    
    public function __construct() {
        if(isset($_GET['url'])){/**Comprobamos que nos pasan una url*/
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);/**Filtramos la url*/
            $url = explode('/', $url);/**Separamos la url a partir de la / */
            $url = array_filter($url);/**Filtramos el array*/
            
            $this->_controlador = strtolower(array_shift($url)); /**Pasamos a minuscula el controlador*/
            $this->_metodo = strtolower(array_shift($url)); /**Pasamos a minuscula el modelo*/
            $this->_argumentos = $url; /**Pasamos a minuscula los argumentos*/
        }       
        
        if(!$this->_controlador){/**Si el controlador esta vacio se carga el controlador por defecto*/
            $this->_controlador = DEFAULT_CONTROLLER;
        }
        
        if(!$this->_metodo){/**Si el metodo esta vacio el por defecto sera el index*/
            $this->_metodo = 'index';
        }
        
        if(!isset($this->_argumentos)){/**Si no hay argumentos el array estara vacio*/
            $this->_argumentos = array();
        }
    }
    
    public function getControlador()/**Funcion para pasar el controlador*/
    {
        return $this->_controlador;
    }
    
    public function getMetodo()/**Funcion para pasar los argumentos*/
    {
        return $this->_metodo;
    }
    
    public function getArgs()/**Funcion para pasar el controlador*/
    {
        return $this->_argumentos;
    }
}

?>