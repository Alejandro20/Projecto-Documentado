<?php


abstract class Controller
{
    protected $_view;
    
    public function __construct() {
        $this->_view = new View(new Request);
    }
    
    abstract public function index();
    
    protected function loadModel($modelo)/**En esta funcion nos pasan el nombre del modelo */
    {
        $modelo = $modelo . 'Model';/**Indicamos que el nombre de modelo es lo que nos pasan en la funcion, concadenado con "Model" y se genera el nombre completo del modelo*/ 
        $rutaModelo = ROOT . 'app' . DS.  'models' . DS . $modelo . '.php';/**Indicamos la ruta donde se encuentra el modelo*/
        
        if(is_readable($rutaModelo)){/**Comprobamos que la ruta es valida*/
            require_once $rutaModelo;
            $modelo = new $modelo;
            return $modelo;
        }
        else {
            throw new Exception('Error de modelo');
        }
    }
	
	protected function getLibrary($libreria)
    {
        $rutaLibreria = ROOT . 'libs' . DS . $libreria . '.php';
        
        if(is_readable($rutaLibreria)){
            require_once $rutaLibreria;
        }
        else{
            throw new Exception('Error de libreria');
        }
    }
    
    
    protected function getTexto($clave)/**Funcion que controla que se pasa texto*/
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
            return $_POST[$clave];
        }
        
        return '';
    }
    
    protected function getInt($clave)/**Funcion que controla que se pasan numeros*/
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
            return $_POST[$clave];
        }
        
        return 0;
    }
    
    protected function redireccionar($ruta = false)/**Funcion que se encarga de redireccionar por defecto no le pasamos nada, es decir se pasara un valor cuando se llama*/
    {
        if($ruta){/**Si hay ruta nos redirije a ella*/
            header('location:' . BASE_URL . $ruta);
            exit;
        }else{
            header('location:' . BASE_URL);/**Si no hay nos redirije al index*/
            exit;
        }
    }

    protected function filtrarInt($int)
    {
        $int = (int) $int;
        
        if(is_int($int)){
            return $int;
        }
        else{
            return 0;
        }
    }
    
    protected function getPostParam($clave)
    {
        if(isset($_POST[$clave])){
            return $_POST[$clave];
        }
    }
    
    protected function getSql($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = strip_tags($_POST[$clave]);
            
            if(!get_magic_quotes_gpc()){
                $_POST[$clave] = mysql_escape_string($_POST[$clave]);
            }
            
            return trim($_POST[$clave]);
        }
    }
    
    protected function getAlphaNum($clave)
    {
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }
        
    }
    
    public function validarEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        
        return true;
    }
    
}

?>
