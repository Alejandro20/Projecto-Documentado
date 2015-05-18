<?php


class Session
{
    public static function init()/**Funcion para iniciar las vistas*/
    {
        session_start();/**Indicamos que abrimos una nueva session*/
    }
    
    public static function destroy($clave = false)/**Funcion para cerrar session*/
    {
        if($clave){
            if(is_array($clave)){
                for($i = 0; $i < count($clave); $i++){
                    if(isset($_SESSION[$clave[$i]])){
                        unset($_SESSION[$clave[$i]]);
                    }
                }
            }
            else{
                if(isset($_SESSION[$clave])){
                    unset($_SESSION[$clave]);
                }
            }
        }
        else{
            session_destroy();
        }
    }
    
    public static function set($clave, $valor)/**Funcion para pasar parametos a la app*/
    {
        if(!empty($clave))
        $_SESSION[$clave] = $valor;
    }
    
    public static function get($clave)/**Funcion para obtener parametos de la app*/
    {
        if(isset($_SESSION[$clave]))
            return $_SESSION[$clave];
    }
    
    
    public static function tiempo() /** Funcion para pasarle el tiempo de session de usuario a la app*/
    {
        if(!Session::get('tiempo') || !defined('SESSION_TIME')){
            throw new Exception('No se ha definido el tiempo de sesion'); 
        }
        
        if(SESSION_TIME == 0){
            return;
        }
        
        if(time() - Session::get('tiempo') > (SESSION_TIME * 60)){
            Session::destroy();
            header('location:' . BASE_URL . 'error/access/8080');
        }
        else{
            Session::set('tiempo', time());
        }
    }
}

?>