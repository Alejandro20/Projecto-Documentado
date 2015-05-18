<?php

class Core
{
    public static function iniciar(Request $peticion)/**A esta funcion se le pasa la url*/
    {
        $controller = $peticion->getControlador() . 'Controller';/**El controlador es el resultado de la funcion getControlador()*/
        $rutaControlador = ROOT .'app' . DS . 'controllers' . DS . $controller . '.php';/**Buscamos la ruta del controlador a partir de la variable $controller*/
        $metodo = $peticion->getMetodo(); /**Obtenemos el metodo a traves de la funcion getMetodo()*/ 
        $args = $peticion->getArgs();/**Obtenemos los argumentos a traves de la funcion getArgs()*/ 
        
        if(is_readable($rutaControlador)){/**Comprobamos que la ruta es accesible*/
            require_once $rutaControlador;
            $controller = new $controller;/**Abrimos un nuevo controlador*/
            
            if(is_callable(array($controller, $metodo))){/**Si el controlador es accesible llamamos a los metodos*/
                $metodo = $peticion->getMetodo();/**Obtenemos los metodos que nos pasan*/
            }
            else{
                $metodo = 'index';/**si no nos pasan por defecto sera el index*/
            }
            
            if(isset($args)){/**Si hay argumentos llamaremos a los argumentos*/
                call_user_func_array(array($controller, $metodo), $args);/**Llamamos a los argumentos a partir del controlador i el modelo pertinente*/
            }
            else{
                call_user_func(array($controller, $metodo));
            }
            
        } else {
            throw new Exception('no encontrado');/**Si no exiten, mostraremos un error*/
        }
    }
}

?>