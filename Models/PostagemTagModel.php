<?php 
require_once("../Application/Connection.php");
require_once("../Objects/PostagemTag.php");

use Application\Connection;
use Object\PostagemTag;
class PostagemTagModel{
	public function create($object){
		try{
			//criar comando sql
			$sqlCommand = "INSERT INTO PostagemTag(idPostagem,idTag) 
				VALUES ($object->idPostagem,$object->idTag)";
			//abrir conexão
			$mysqli = Connection::Open();
			mysqli_set_charset($mysqli, 'utf8');
			//executar comando
			$mysqli->query($sqlCommand);
			//fechar conexão
			$mysqli->close();
			//retornar true
			return true;
		}
		catch(Exception $ex){
			throw new Exception("Erro ao criar relação entre postagem e tag. ".$ex->getMessage());
		}
	}
}
?>