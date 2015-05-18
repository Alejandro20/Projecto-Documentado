<?php

class anunciosModel extends Model
{
	
    public function __construct() {
        parent::__construct();
		
    }
    
    public function getAnuncios()/**Funcion para listar todos los anuncios de la app*/
    {
        $anuncio = $this->_db->query("select * from anuncios");
        return $anuncio->fetchall();
    }
	
	public function getAnunciosPropios()/**Funcion para listar los anuncios de un usuario a trabes del id de session*/
    {
		$user = Session::get('id_usuario');	/*Obtenemos el id del usuario de ese momento*/					
        $anuncio = $this->_db->query("select * from anuncios where usuario = $user and vendido !='Vendido'");
        return $anuncio->fetchall();
    }
	
	public function getAnunciosPropiosVendidos()/**Funcion para listar los anuncios que ha vendido un usuario a trabes del id de session*/
    {
		$user = Session::get('id_usuario');	/*Obtenemos el id del usuario de ese momento*/						
        $anuncio = $this->_db->query("select * from anuncios where usuario = $user and vendido = 'Vendido'");
        return $anuncio->fetchall();
    }
    
    public function getAnuncio($id)/**Obtenemos los datos de un anuncio especifico a partir de un id*/
    {
        $id = (int) $id;
        $anuncio = $this->_db->query("select * from anuncios where id_anuncio = $id");
        return $anuncio->fetch();
    }
    
    public function insertarAnuncio($titulo, $descripcion,$precio,$imagen)/**Funcion para insertar un anuncio en la app*/
    {
        
		$user = Session::get('id_usuario');	
		$this->_db->prepare("INSERT INTO anuncios VALUES
							(null, :titulo, :descripcion,:precio,:imagen,now(),$user,' ')")
                ->execute(
                        array(
                           ':titulo' => $titulo,
                           ':descripcion' => $descripcion,
						   ':precio'=>$precio,
						   ':imagen'=>$imagen
                        ));
									
    }
    
    public function editarAnuncio($id, $titulo, $descripcion,$precio,$imagen)/**Funcion para editar un anuncio de la app a partir del id del anuncio que nos pasan por el enlace de la vista*/
    {
		$id = (int) $id;
        //$user = Session::get('id_usuario');	
        $this->_db->prepare("UPDATE anuncios SET Titulo = :titulo, Descripcion = :descripcion, Precio = :precio, Imagen = :imagen, Fecha = now() WHERE id_anuncio = :id")
                ->execute(
                        array(
                           ':id' => $id,
                           ':titulo' => $titulo,
                           ':descripcion' => $descripcion,
						   ':precio'=>$precio,
						   ':imagen'=>$imagen,
						   
                        ));
    }
	
	public function AnuncioVendido($id){/**Funcion para indicar que un anuncio se ha vendido a partir del id del anuncio que nos pasan por el enlace de la vista*/
	
		$id = (int) $id;
		$vendido = "Vendido";
		
		 $this->_db->prepare("UPDATE anuncios SET Vendido = :vendido WHERE id_anuncio = :id")
		 					->execute(
									array(
									
										':id'=>$id,
										':vendido' =>$vendido
									
									)
							   );
									
	}
    
}

?>
