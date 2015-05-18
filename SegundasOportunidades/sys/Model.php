<?php

/**Clase que se encarga de crear de los modelos*/

class Model
{
    protected $_db;
    
    public function __construct() {
        $this->_db = new Database();
    }
}

?>
