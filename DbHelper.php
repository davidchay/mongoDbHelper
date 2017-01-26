<?php 
class DbHelper {
	public $connection;
	public $db;
	public $collection;
	public function __construct($db)
	{
		try 
		{
			$this->connection = new Mongo();
			$this->db = $this->connection->selectDB($db);

		} 
		catch (MongoConnectionException $e) 
		{
  			die ("Fallo en la conexion de la base de datos" . $e->getMessage());
		}

	}// contruct
	public function gets ($nameCollection)
	{
		$this->collection=$this->db->selectCollection($nameCollection);
		var_dump( $this->collection->find());
		
	} //getCollection
	public function insert ($collection, $arr)
	{
		try 
		{
			$this->db->selectCollection($collection)->insert($arr,array('safe'=>true));
         	echo "Operación de inserción completada";
        } 
        catch (MongoCursorException $e) {
          die("Insert ha fallado ".$e->getMessage());
        }
	}//insert
	public function save ($collection, $obj)
	{
		/**
		* save es simplemente un contenedor para insertar y actualizar. Si se proporciona un _id, se actualizará;
		* al actualizarse se puede borrar la informacion ya almacenada en el documento y esribir la nueva informacion
		*/
		try 
		{
			$this->db->selectCollection($collection)->save($obj, array('safe'=>true));
         	echo "Operación de inserción completada";
        } 
        catch (MongoCursorException $e) {
          die("Insert ha fallado ".$e->getMessage());
        }
	}//save
	public function getOneID ($collection,$id)
	{
		/**
		* getOneID devuelve un documento de una coleccion
		* recibe como parametro dos valores el nombre de la coleccion y el id del documento. 
		*/
		$datos = $this->db->selectCollection($collection)->findOne(array('_id' => new MongoId($id))) ;
		var_dump ($datos);
	}//getOneID
	public function getOne($collection, $arr, $arr2=array())
	{
		/**
		* El metodo getOne devuelve el primer docuemnto que coincida con los varoles buscados
		* recibe tres parametros el primer valor el es nombre de la colecion, 
		* el segundo es un array donde separa el campo a buscar y el valor
		* el tercer valor es un array opcional si solo desea determinado campo  
		* Ejemplos:
			$mongo= new DbHelper('turboAdmin'); //coneccion a la base de datos
			$mongo->getOne('clientes',array('nombre'=>'pedro'));
			 		-> devuelve todos los datos del primer docuemtno donde encuentra a nombre=pedro
			$mongo->getOne('clientes',array('nombre'=>'pedro'),array('direccion');
					-> devuelve solo el campo direccion del docuemnto donde se encuentra pedro 
			

		*/
		$datos = $this->db->selectCollection($collection)->findone($arr,$arr2);
		return $datos;
		
	}//getOne

	public function updateID($collection, $id, $data)
	{
		/**
		* Esta funcion actualiza un docuemento 
		* como parametros esta la collecion el id del documento a actualizar un array con los nuevos valores
		* Si los nuevo valores nose encuentran en el documento los agrega
		*/
		$this->db->selectCollection($collection)->update(array('_id' => new MongoId($id)), array('$set' => $data), array('safe'=>true));
	}//updateID 
	public function update($collection,$criteria,$new_object)
	{
		/**
		* Esta funcion actualiza datos de documentos que coinciden con los valores pasados como criteria
		* como parametro recibe la coleccion un array que sirve como criteria y un tercer valor que es un array con los nuevos datos que se modificaran o se agregaran
		*/
		try 
		{
			$this->db->selectCollection($collection)->update($criteria, array('$set' => $new_object), array('multiple' => true,'safe'=>true));
			
         	//echo "Operación de actualizacion completada";
        } 
        catch (MongoCursorException $e) {
          die("No se pudo actualizar el documento: ".$e->getMessage());
        }
	}//update
	public function updateW($collection,$criteria,$new_object)
	{
		/**
		* Esta funcion actualiza datos de documentos que coinciden con los valores pasados como criteria
		* como parametro recibe la coleccion un array que sirve como criteria y un tercer valor que es un array con los nuevos datos que se modificaran o se agregaran
		* si no encuentra coincidencias crea ara un nuevo documento
		*/
		try 
		{
			$this->db->selectCollection($collection)->update($criteria, array('$set' => $new_object), array('multiple' => false,'safe'=>true,'upsert' => true));
			
         	//echo "Operación de actualizacion completada";
        } 
        catch (MongoCursorException $e) {
          die("No se pudo actualizar el documento: ".$e->getMessage());
        }
	}//updateW

	public function pushID($collection, $id, $new_object)
	{
		/**
		* El metodo pushID agrega un registro a un dato de tipo objeto o array dentro del documento.
		* los parametros que se pasan son la colleccion, el id y un array con los datos nuevos 
		*
		*/
		try 
		{
			$this->db->selectCollection($collection)->update(array('_id' => new MongoId($id)), array('$push' => $new_object), array('safe'=>true));
			
         	//echo "Operación de actualizacion completada";
        } 
        catch (MongoCursorException $e) {
          die("No se pudo actualizar el documento: ".$e->getMessage());
        }
	}//pushID
	public function push($collection, $criteria, $new_object)
	{
		/**
		* El metodo push agrega un registro a un docuemnto de tipo objeto o array dentro del documento.
		* los parametros que se pasan son la colleccion, el criteria y un array con los datos nuevos 
		*
		*/
		try 
		{
			$this->db->selectCollection($collection)->update($criteria, array('$push' => $new_object), array('multiple'=>true,'safe'=>true));
			
         	//echo "Operación de actualizacion completada";
        } 
        catch (MongoCursorException $e) {
          die("No se pudo actualizar el documento: ".$e->getMessage());
        }
	}//push



}