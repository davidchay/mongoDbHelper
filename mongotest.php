<?php
	
	//require_once ('DbHelper.php');
	//$mongo= new DbHelper('turboAdmin');
	//$mongo->getCollection('clientes');
	$cliente=array(
		'nombre' => 'pedro',
		'direccion' => 'Las vegas',
	);
	//$cliente2=array('direccion');
	//$mongo->insert($cliente);
	//$datos=$mongo->getOneID('clientes','5881064ae96aa83c0b000029');
	//var_dump($datos);
	//$datos=$mongo->getOne('clientes',$cliente,$cliente2);
	//$mongo->updateID('clientes','5888da51e96aa8b83100002a',$cliente);
	//$mongo->updateW('clientes', $criteria,$new_data);
	$criteria=array(
		'nombre' => 'galvan',
	);
	$new_data=array(
		
		'email' => 'g@mail.com'
	);
	$hero = array(
		'_id' => '5888f79fe96aa8a82600002b',
		'first_name' => 'Eliot ',
		'last_name' => 'Horowitz',
		'address' => '134 Fifth Ave',
		'city' => 'New York',
		'state' => 'NY',
		'zip' => '10010',
		'superpowers' => array( 'agility', 'super human intelligence', 'wall crawling' ),
	);
	//$mongo->save('clientes',$hero);
	//$mongo->getOneID('clientes','5888f79fe96aa8a82600002b');
	
	$mongo = new Mongo();
	$db = $mongo->selectDB('test');
	$collection=$db->selectCollection('numbers');
	$result=$collection->find()->limit(2);
	print_r($result);
	echo "<br>";
	foreach ($result as $document) {
		print_r($document);
	}
	//Libro pagina 21
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
</body>
</html>