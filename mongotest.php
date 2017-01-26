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
		'_id' => new MongoId('5888f79fe96aa8a82600002b'),
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
	$db = $mongo->selectDB('turboAdmin');
	$collection=$db->selectCollection('numbers');
	/*Limite*/
	//$result=$collection->find()->limit(2);
	/*Ordenamiento inverso*/
	//$result=$db->numbers->find()->limit(2)->skip(20)->sort(array('num'=>-1));
	/*mayor que $gt(>),$lt(<),$gte(>=),$lte(<=)*/
	//$result=$db->numbers->find(array('num'=>array('$lt'=>15)));
	/*Array $in(coincidiencias de valor) $nin(diferente) $all (similar a $in)*/
	//$result=$db->clientes->find(array('colonia'=>array('$in'=>array('centro'))));
	//$result=$db->clientes->find(array('colonia'=>array('$nin'=>array('centro','las vegas','reforma','5 de febrero'))));
	$result=$db->clientes->find(array('colonia'=>array('$all'=>array('centro'))));
	foreach ($result as $document) {
		echo "<pre>";
		print_r($document);
		echo "</pre>";
	}
	//Libro pagina 25 Matchets array
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		pre{
			background-color: #f1f1f1;
		}
	</style>
</head>
<body>
	
</body>
</html>